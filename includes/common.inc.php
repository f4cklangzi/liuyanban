<?php
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年12月5日
*===================================================
**/
//防止恶意调用
if (!defined('IN_TG')) {
	die('Access Defined!');
}
//转换硬路径
define('ROOT_PATH',substr(dirname(__FILE__), 0,-8)) ;
//创建一个自动转义状态的常量
define('GPC', get_magic_quotes_gpc());
//拒绝PHP低版本
if (PHP_VERSION<'4.1.0') {
	die('Version is too Low!');
}
//引入函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';
//执行耗时函数
define('START_TIME', _runtime());
?>
