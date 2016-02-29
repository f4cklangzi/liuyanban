<?php
header('Content-Type: text/html;charset=utf-8');
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年12月5日
*===================================================
**/
//定义一个常量用来调用includes里面的文件，防止恶意调用
define('IN_TG',true);
//定义一个常量指定本页CSS
define('SCRIPT', 'index');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//连接数据库
include ROOT_PATH.'/includes/conn.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>凌云网络</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="list">
	<h2>帖子列表</h2>
</div>
<div id="user">
	<h2>新进会员</h2>
	<dl>
		<dd class="user">刘邦(男)</dd>
		<dt><img src="image/face/1.png" alt="1" /></dt>
		<dd class="message"><a href="" name="message" title="1">发消息</a></dd>
		<dd class="friend"><a href="" name="friend" title="1">加为好友</a></dd>
		<dd class="guest">写留言</dd>
		<dd class="flower"><a href="" name="flower" title="1">给她送花</a></dd>
		<dd class="email">邮件：admin@admin.com</dd>
		<dd class="url">网址：www.qq.com</dd>
	</dl>
</div>
<div id="pics">
	<h2>最新图片</h2>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>