<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年1月30日
	*===================================================
	**/
	session_start();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'manage');
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--后台管理中心</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php require ROOT_PATH.'includes/manage.inc.php' ?>
	<div id="member_main">
		<h2>后台管理中心</h2>
		<dl>
			<dd>服务器主机名称：<?php echo $_SERVER['SERVER_NAME']; ?></dd>
			<dd>通信协议名称/版本：<?php echo $_SERVER['SERVER_PROTOCOL']; ?></dd>
			<dd>服务器IP：<?php echo $_SERVER["SERVER_ADDR"]; ?></dd>
			<dd>客户端IP：<?php echo $_SERVER["REMOTE_ADDR"]; ?></dd>
			<dd>服务器端口：<?php echo $_SERVER['SERVER_PORT']; ?></dd>
			<dd>客户端端口：<?php echo $_SERVER["REMOTE_PORT"]; ?></dd>
			<dd>管理员邮箱：<?php echo $_SERVER['SERVER_ADMIN'] ?></dd>
			<dd>Host头部的内容：<?php echo $_SERVER['HTTP_HOST']; ?></dd>
			<dd>服务器主目录：<?php echo $_SERVER["DOCUMENT_ROOT"]; ?></dd>
			<dd>服务器系统盘：<?php echo $_SERVER["SystemRoot"]; ?></dd>
			<dd>脚本执行的绝对路径：<?php echo $_SERVER['SCRIPT_FILENAME']; ?></dd>
			<dd>Apache及PHP版本：<?php echo $_SERVER["SERVER_SOFTWARE"]; ?></dd>
		</dl>
	</div>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>