<?php
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2016年1月22日
*===================================================
**/
//数据库连接
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root' );
define('DB_PWD', 'mypassword');
define('DB_NAME','testguest');
//初始化数据库
_connect();
_select_db();
_set_names();
//网站系统初始化
//读取系统表
	if (!!$_rows=_fetch_array("SELECT 
								tg_webname,
								tg_article,
								tg_blog, 
								tg_photo,
								tg_skin, 
								tg_string, 
								tg_post, 
								tg_re, 
								tg_code, 
								tg_register
		 					FROM 
		 						tg_system 
		 					WHERE 
		 						tg_id=1 
		 					LIMIT 1
		 				")) {
		global $_system;
		$_system=array();
		$_system['webname']=$_rows['tg_webname'];
		$_system['article']=$_rows['tg_article'];
		$_system['blog']=$_rows['tg_blog'];
		$_system['photo']=$_rows['tg_photo'];
		if (isset($_COOKIE['skin'])) {
			if ($_COOKIE['skin']>3) {
				setcookie('skin','1');
				_location(NULL,'index.php');
			}
			$_system['skin']=intval($_COOKIE['skin']);
		}else{
			$_system['skin']=$_rows['tg_skin'];
		}
		$_system['string']=$_rows['tg_string'];
		$_system['post']=$_rows['tg_post'];
		$_system['re']=$_rows['tg_re'];
		$_system['code']=$_rows['tg_code'];
		$_system['register']=$_rows['tg_register'];
	}else{
		_alert_back('读取系统配置出错！');
		die();
	}

//短信提醒模块
$_cookie_username=@_mysql_string($_COOKIE['username']);
$_message=_fetch_array("SELECT 
							COUNT(tg_id)
						AS
							count
						FROM 
							tg_message 
						WHERE 
							tg_state=0
						AND
							tg_touser='{$_cookie_username}'
					");
if (empty($_message['count'])) {
	$_unread_message='';
}else{
	$_unread_message='&nbsp;<a class="unread" href="member_message.php"><strong title="'.intval($_message['count']).'条未读短信">('.intval($_message['count']).')</strong></a>';
}
?>