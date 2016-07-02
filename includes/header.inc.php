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
<script src="js/skin.js"></script>
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
		<li><a href="photo.php">相册</a></li>
		<li><a href="blog.php">博友</a></li>
		<li class="skin" onmouseover="inskin()" onmouseout="outskin()">
			<a href="">风格</a>
			<dl id="skin">
				<dd><a href="skin.php?id=1">简洁商务</a></dd>
				<dd><a href="skin.php?id=2">粉色诱惑</a></dd>
				<dd><a href="skin.php?id=3">绿色森林</a></dd>
			</dl>
		</li>
		<?php 
		if (isset($_COOKIE['username'])) {
			if (@$_rows['tg_level']==1) {
				echo '<li><a class="manage" href="manage.php">管理 </a></li>';
			}
		}
		if (isset($_COOKIE['username'])){
			echo '<li><a href="logout.php">退出</a></li>';
		} 
		?>
		
	</ul>
</div>