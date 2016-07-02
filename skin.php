<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2016年5月7日
	*===================================================
	**/
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'photo');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//验证referer和ID
	$_referer=$_SERVER["HTTP_REFERER"];
	if (empty($_referer) || !isset($_GET['id'])) {
		_alert_back('非法操作！');
	}
	//生成COOKIE
	$_id=intval($_GET['id']);
	setcookie('skin',$_id);
	_location(NULL,$_referer);
?>