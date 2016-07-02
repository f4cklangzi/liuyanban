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
	//添加目录操作
	if (@$_GET['action']=='adddir') {
		//引入验证文件
		require ROOT_PATH.'includes/check.func.php';
		//接收数据
		$_clean=array();
		$_clean['name']=_check_content($_POST['name'],2,20);
		$_clean['type']=intval($_POST['type']);
		$_clean['password']=sha1($_POST['password']);
		$_clean['content']=_check_content($_POST['content'],0,200);
		$_clean['dir']='photo/'.time();
		$_clean=_mysql_string($_clean);
		//检查主目录是否存在
		if (!is_dir('photo')) {
			mkdir('photo',0777);
		}
		//创建相册目录
		if (!is_dir($_clean['dir'])) {
			mkdir($_clean['dir'],0777);
		}
		//把当前目录信息写入数据库
		if (empty($_clean['type'])) {
			_query("INSERT INTO tg_dir (
										tg_name,
										tg_type,
										tg_content,
										tg_dir,
										tg_date
										) 
								VALUE(
										'{$_clean['name']}',
										'{$_clean['type']}',
										'{$_clean['content']}',
										'{$_clean['dir']}',
										NOW()
										)"
			);
		}else{
			_query("INSERT INTO tg_dir (
										tg_name,
										tg_type,
										tg_password,
										tg_content,
										tg_dir,
										tg_date
										) 
								VALUE(
										'{$_clean['name']}',
										'{$_clean['type']}',
										'{$_clean['password']}',
										'{$_clean['content']}',
										'{$_clean['dir']}',
										NOW()
										)"
			);
		}
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，相册创建成功！','photo.php');
		}else{
			_alert_back('很遗憾，相册创建失败！');
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
<script type="text/javascript" src="js/photo_add_dir.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="photo_add_dir">
	<h2>添加相册目录</h2>
	<form action="?action=adddir" method="post">
	<dd>相册名称 <input type="text" name="name" class="text" /></dd>
	<dd class="type">相册类型 <input type="radio" name="type" value="0" checked="checked" />公开<input type="radio" name="type" value="1"/>私密</dd>
	<dd id="pass">相册密码 <input type="password" name="password" class="text" /></dd>
	<dd><span>相册简介 </span><textarea name="content" cols="30" rows="5"></textarea></dd>
	<dd><input class="button" type="submit" value="创建" /></dd>
	</form>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
