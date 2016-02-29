<?php
	session_start();
	//防止恶意调用
	function check(){
		if ($_SESSION['checkcode']!=='code') {
			die('Access Defined!');
		}
	}
	@check();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//运行验证码函数
	_code();
?>