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
	define('SCRIPT', 'thumb');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//生成缩略图
	if (isset($_GET['filename'])) {
		_thumb($_GET['filename'],$_GET['percent'],$_GET['keep_scale']);
	}else{
		_alert_back('参数缺失！');
	}
	
?>
