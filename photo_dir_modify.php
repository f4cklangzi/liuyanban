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
	define('SCRIPT', 'photo_add_dir');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_level FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
		_location('请登录！','login.php');
	}
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	//管理员权限验证
	if ($_rows['tg_level']!=1) {
		_location('越权操作！','');
	}
	//修改
	if (@$_GET['action']=='modify') {
		//引入验证文件
		require ROOT_PATH.'includes/check.func.php';
		$_clean=array();
		$_clean['id']=intval($_POST['id']);
		$_clean['name']=_check_content($_POST['name'],2,20);
		$_clean['type']=intval($_POST['type']);
		if (!empty($_clean['type'])) {
			$_clean['password']=sha1($_POST['password']);
		}
		$_clean['face']=_check_content($_POST['face'],0,200);
		$_clean['content']=_check_content($_POST['content'],0,200);
		$_clean=_mysql_string($_clean);
		//修改目录
		if (empty($_clean['type'])) {
			_query("UPDATE 
							tg_dir 
						SET
							tg_name='{$_clean['name']}',
							tg_type='{$_clean['type']}',
							tg_password=NULL,
							tg_face='{$_clean['face']}',
							tg_content='{$_clean['content']}'
						WHERE
							tg_id='{$_clean['id']}'
						LIMIT
							1
			");
		}else{
			_query("UPDATE 
							tg_dir 
						SET
							tg_name='{$_clean['name']}',
							tg_type='{$_clean['type']}',
							tg_password='{$_clean['password']}',
							tg_face='{$_clean['face']}',
							tg_content='{$_clean['content']}'
						WHERE
							tg_id='{$_clean['id']}'
						LIMIT
							1
			");
		}
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，相册修改成功！','photo.php');
		}else{
			_alert_back('很遗憾，相册修改失败！');
		}
	}
	if (isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		//代入数据查询以验证ID合法性
		if (!@$_rows=_fetch_array("SELECT 
								tg_id,
								tg_name,
								tg_type,
								tg_face,
								tg_content
							FROM
		 						tg_dir 
		 					WHERE 
		 						tg_id='{$_id}'
		 					LIMIT
		 						1
		 				")) {
			_alert_back('相册不存在！');
		}
		$_html=array();
		$_html['id']=$_rows['tg_id'];
		$_html['name']=$_rows['tg_name'];
		$_html['type']=$_rows['tg_type'];
		$_html['face']=$_rows['tg_face'];
		$_html['content']=$_rows['tg_content'];
		$_html=_html($_html);
	}else{
		_alert_back('参数缺失！');
	}
		// if (_mysql_affected_rows()==1) {
		// 	//关闭连接
		// 	_close();
		// 	//跳转
		// 	_location('恭喜你，相册创建成功！','photo.php');
		// }else{
		// 	_alert_back('很遗憾，相册创建失败！');
		// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--相册</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/photo_dir_modify.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="photo_add_dir">
	<h2>修改相册目录</h2>
	<form action="?action=modify" method="post">
	<input type="hidden" name="id" value="<?php echo $_html['id'] ?>" />
	<dd>相册名称 <input type="text" name="name" class="text" value="<?php echo $_html['name'] ?>" /></dd>
	<dd class="type">相册类型 <input type="radio" name="type" value="0" <?php if (empty($_html['type'])) {echo 'checked="checked"';} ?>/>公开<input type="radio" name="type" value="1"<?php if (!empty($_html['type'])) {echo 'checked="checked"';} ?>/>私密</dd>
	<dd id="pass" <?php if (!empty($_html['type'])) {echo 'style="display:block;"';} ?>>相册密码 <input type="password" name="password" class="text" />*(不填写则为公开)</dd>
	<dd>相册封面 <input type="text" name="face" class="text" value="<?php echo $_html['face'] ?>" />*(网络地址)</dd>
	<dd><span>相册简介 </span><textarea name="content" cols="30" rows="5"><?php echo $_html['content'] ?></textarea></dd>
	<dd><input class="button" type="submit" value="修改" /></dd>
	</form>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
