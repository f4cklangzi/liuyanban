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
//防止非HTML页面调用
if (!defined('SCRIPT')) {
	die('Script Error!');
}
?>
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="style/<?php echo $_system['skin'] ?>/basic.css" />
<link rel="stylesheet" type="text/css" href="style/<?php echo $_system['skin'] ?>/<?php echo SCRIPT ?>.css" />
