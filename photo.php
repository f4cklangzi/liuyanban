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
	define('SCRIPT', 'photo');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//分页,核心函数库
	global $_pagessize,$_pagenum;//可以不要
	_page("SELECT tg_id FROM tg_dir",$_system['photo']);
	//从数据库提取数据获取结果集
	$_result=_query("SELECT 
							tg_id,
							tg_name,
							tg_type,
							tg_password,
							tg_face
						FROM 
							tg_dir 
						ORDER BY 
							tg_date 
						DESC LIMIT 
							$_pagenum,$_pagessize
					");
	//获取个人数据,判断是否登录
	if (isset($_COOKIE['username'])) {
		$_cookie_username=@_mysql_string($_COOKIE['username']);
		if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_level FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
			_location('请登录！','login.php');
		}
		//防止伪造COOKIE,核心函数库
		@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	}else{
		$_rows['tg_level']=0;
	}
	//删除相册
	if (isset($_GET['id']) && $_GET['action']=='delete' && $_level!=='1') {
		$_id=intval($_GET['id']);
		//代入数据查询以验证ID合法性
		@$_rows=_fetch_array("SELECT 
								tg_dir
							FROM
		 						tg_dir 
		 					WHERE 
		 						tg_id='{$_id}'
		 					LIMIT
		 						1
		 				");
		if (!$_rows) {
			_alert_back('参数错误！');
		}
		//验证通过，进行删除操作
		_query("DELETE 	FROM 
							tg_photo 
						WHERE 
							tg_sid='{$_id}'
						LIMIT 
							1
			");
		_query("DELETE 	FROM 
							tg_dir
						WHERE 
							tg_id='{$_id}'
						LIMIT 
							1
			");
		//判断是否删除成功
		if (_mysql_affected_rows()==1) {
			DelDirAndFile($_rows['tg_dir']);
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，相册删除成功！','photo.php');
		}else{
			_alert_back('很遗憾，相册删除失败！');
		}
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
	<h2>相册列表</h2>
	<?php 
		while (!!$_rows_photo=_fetch_array_list($_result)) { 
			if (empty($_rows_photo['tg_type'])) {
				$_html['type']='(公开)';
			}else{
				$_html['type']='(私密)';
			}
			$_rows_photo['tg_name']=_html($_rows_photo['tg_name']);
	?>
	<dl>
		<dt><a href="photo_show.php?id=<?php echo _html($_rows_photo['tg_id']); ?>"><img src="<?php echo _html($_rows_photo['tg_face']); ?>" alt="暂无封面" /></a></dt>
		<dd><a href="photo_show.php?id=<?php echo _html($_rows_photo['tg_id']); ?>"><?php echo _html($_rows_photo['tg_name'].$_html['type']); ?></a></dd>
		<?php 
			if (@$_rows['tg_level']==1) {
				echo '<dd class="button"><a href="photo_dir_modify.php?id='._html($_rows_photo['tg_id']).'">[修改]</a> <a name="delete" href="?action=delete&id='._html($_rows_photo['tg_id']).'">[删除]</a></dd>'; 
			}
		 ?>
	</dl>
	<?php
		}
		if (@$_rows['tg_level']==1) {
			echo '<p><a href="photo_add_dir.php">添加目录</a></p>'; 
		}
	?>
	<?php 
		//销毁结果集
		_free_result($_result);
		//分页函数，用法见核心函数库
		_paging('1');
	 ?>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
