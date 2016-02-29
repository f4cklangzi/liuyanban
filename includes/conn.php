<?php
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2016年1月22日
*===================================================
**/
//数据库连接
define('DB_HOST', SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT);
define('DB_USER', SAE_MYSQL_USER );
define('DB_PWD', SAE_MYSQL_PASS);
define('DB_NAME',SAE_MYSQL_DB);
echo DB_HOST;
//初始化数据库
_connect();
_select_db();
_set_names();
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