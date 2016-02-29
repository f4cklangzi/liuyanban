<?php
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年1月27日
*===================================================
**/
	@session_start();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	include dirname(__FILE__).'/includes/common.inc.php';
	//退出
	_unsetcookies();
?>