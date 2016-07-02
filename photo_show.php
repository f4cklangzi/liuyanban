<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2016年4月12日
	*===================================================
	**/
	session_start();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'photo_show');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	if (isset($_COOKIE['username'])) {
		$_cookie_username=@_mysql_string($_COOKIE['username']);
		if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_level FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
			_location('请登录！','login.php');
		} 
		//防止伪造COOKIE,核心函数库
		@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
		$_level=$_rows['tg_level'];
	}else{
		$_rows['tg_level']='0';
	}
	//删除照片
	if (isset($_GET['id']) && $_GET['action']=='delete') {
		$_id=intval($_GET['id']);

		//代入数据查询以验证ID合法性
		@$_rows=_fetch_array("SELECT 
								tg_id,
								tg_username,
								tg_sid,
								tg_url
							FROM
		 						tg_photo 
		 					WHERE 
		 						tg_id='{$_id}'
		 					LIMIT
		 						1
		 				");
		$_html=array();
		$_html['username']=$_rows['tg_username'];
		$_html['sid']=$_rows['tg_sid'];
		$_html['url']=$_rows['tg_url'];
		//再次验证身份合法性
		if ($_html['username']!==$_cookie_username && $_level!=='1') {
			_location('非法操作！','');
		}
		if (!$_rows) {
			_alert_back('参数错误！');
		}
		//验证通过，进行删除操作
		_query("DELETE 	FROM 
							tg_photo 
						WHERE 
							tg_id='{$_id}'
						LIMIT 
							1
			");
		//判断是否删除成功
		if (_mysql_affected_rows()==1) {
			if (file_exists($_html['url'])) {
				@unlink($_html['url']);
			}else{
				_alert_back('异常！');
			}
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，图片删除成功！','photo_show.php?id='.$_html['sid']);
		}else{
			_alert_back('很遗憾，图片删除失败！');
		}
	}
	//获取图片ID值判断相册
	if (isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		if (!!$_rows=_fetch_array("SELECT 
										tg_id,
										tg_type,
										tg_password
									FROM 
										tg_dir
									WHERE
										tg_id='{$_id}'
									LIMIT
										1
			")) {
			$_html=array();
			$_html['sid']=$_rows['tg_id'];
			$_html['type']=$_rows['tg_type'];
			$_html['true_password']=sha1($_rows['tg_password']);
			$_html['password']=sha1(sha1(_mysql_string($_POST['password'])));
			$_html=_html($_html);
			//对比密码
			if (!empty($_POST['password'])) {
					if ($_html['true_password'] != $_html['password']) {
						_alert_back('密码不正确！');
					}else{
						//密码正确，设置cookie
						setcookie('photo'.$_html['sid'],$_html['password'],time()+86400);
						header('Location:photo_show.php?id='.$_id);
					}
			}
			//分页,核心函数库
			global $_pagessize,$_pagenum,$_page_id;//可以不要
			$_page_id='id='.$_html['sid'].'&';
			_page("SELECT tg_id FROM tg_photo WHERE tg_sid='{$_id}'",$_system['photo']);
			//从数据库提取数据获取结果集
			$_result=_query("SELECT 
									*
								FROM 
									tg_photo
								WHERE
									tg_sid='{$_id}' 
								ORDER BY 
									tg_date 
								DESC LIMIT 
									$_pagenum,$_pagessize
							");
				}else{
					_alert_back('此相册不存在！');
				}
			}else{
				_alert_back('参数缺失！');
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--相册</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/photo_show.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="photo">
	<h2>图片展示</h2>
	<?php 
	if (empty($_html['type']) || $_html['true_password']==$_COOKIE['photo'.$_html['sid']] || $_level==1) {
		while (!!$_rows=_fetch_array_list($_result)) { 
			$_html['id']=$_rows['tg_id'];
			$_html['name']=$_rows['tg_name'];
			$_html['url']=$_rows['tg_url'];
			$_html['content']=$_rows['tg_content'];
			$_html['sid']=$_rows['tg_sid'];
			$_html['username']=$_rows['tg_username'];
			$_html['readcount']=$_rows['tg_readcount'];
			$_html['commendcount']=$_rows['tg_commendcount'];
			$_html['date']=$_rows['tg_date'];
			$_html=_html($_html);
			echo '<dl>'; 
			echo '<dt><a title="'.$_html['name'].'" href="photo_detail.php?id='.$_html['id'].'"><img src="thumb.php?filename='.$_html['url'].'&keep_scale=150" alt="'.$_html['name'].'" /></a></dt>';
			echo '<dd>'.$_html['name'].'</dd>';
			echo '<dd title="'.$_html['username'].'">阅('.$_html['readcount'].') 评('.$_html['commendcount'].') 上传者:'.$_html['username'].'</dd>';
			if ($_html['username']==$_cookie_username || $_level=='1') {
				echo '<dd><a name="delete" href="?action=delete&id='.$_html['id'].'">[删除]</a></dd>';
			}
			echo '</dl>';
			}
			if (isset($_COOKIE['username'])) {
				echo '<p><a href="photo_add_img.php?id='.$_html['sid'].'">上传图片</a></p>'; 
			}
	?>

	<?php 
		//销毁结果集
		_free_result($_result);
		//分页函数，用法见核心函数库
		_paging('1');
	}else{
		$_form='<form action="photo_show.php?id='.$_html['sid'].'" method="post">';
		$_form.='<p>请输入密码: <input type="password" name="password"/> <input type="submit" value="确认"/></p>';
		$_form.='</form>';
		echo $_form;
	}
	 ?>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
