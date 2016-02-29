<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年1月30日
	*===================================================
	**/
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'member');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_username,tg_sex,tg_face,tg_level,tg_email,tg_url,tg_qq,tg_reg_time,tg_last_ip FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
		_location('请登录！','login.php');
	}
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	$_html = array();
	$_html['uniqid']=$_rows['tg_uniqid'];
	$_html['username']=$_rows['tg_username'];
	$_html['sex']=$_rows['tg_sex'];
	$_html['face']=$_rows['tg_face'];
	$_html['email']=$_rows['tg_email'];
	$_html['url']=$_rows['tg_url'];
	$_html['qq']=$_rows['tg_qq'];
	$_html['reg_time']=$_rows['tg_reg_time'];
	$_html['last_ip']=$_rows['tg_last_ip'];
	switch ($_rows['tg_level']) {
		case '0':
			$_html['level']='普通会员';
			break;
		
		case '1':
			$_html['level']='管理员';
			break;
	}
	$_html=_html($_html);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>凌云网络--个人中心</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php require ROOT_PATH.'includes/member.inc.php' ?>
	<div id="member_main">
		<h2>会员管理中心</h2>
		<dl>
			<dd>用 户 名：<?php echo $_html['username'] ?></dd>
			<dd>性    别：<?php echo $_html['sex'] ?></dd>
			<dd>头    像：<?php echo $_html['face'] ?></dd>
			<dd>电子邮件：<?php echo $_html['email'] ?></dd>
			<dd>主    页：<?php echo $_html['url'] ?></dd>
			<dd>Q      Q：<?php echo $_html['qq'] ?></dd>
			<dd>注册时间：<?php echo $_html['reg_time'] ?></dd>
			<dd>身    份：<?php echo $_html['level'] ?></dd>
			<dd>登  录IP：<?php echo $_html['last_ip'] ?></dd>
		</dl>
	</div>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>