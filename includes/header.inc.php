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
global $_unread_message;
?>
<div id="header">
	<h1>
		<a href="index.php">凌云网络多用户留言系统</a>
	</h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		
		<?php
			if (isset($_COOKIE['username'])) {
				echo '<li><a href="member.php"><strong>'.$_COOKIE['username'].'</strong>·个人中心</a>'.$_unread_message.'</li>';
				echo "\n";
			}else{
				echo '<li><a href="register.php">注册</a></li>';
				echo "\n";
				echo "\t\t";
				echo '<li><a href="login.php">登录</a></li>';
				echo "\n";
			}
		?>
		<li><a href="blog.php">博友</a></li>
		<li>风格</li>
		<li>管理</li>
		<?php 
		if (isset($_COOKIE['username'])){
			echo '<li><a href="logout.php">退出</a></li>';
		} 
		?>
		
	</ul>
</div>