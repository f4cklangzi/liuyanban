<?php
header('Content-Type: text/html;charset=utf-8');
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2016年1月19日
*===================================================
**/
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'active');
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include dirname(__FILE__).'/includes/conn.php';
	//开始激活处理
	if (!isset($_GET['active'])) {
		_alert_back('非法操作！');
	}
	if (isset($_GET['action']) && isset($_GET['active']) && $_GET['action']='ok') {
		$_active=_mysql_string($_GET['active']);
		if (_fetch_array("SELECT tg_active FROM tg_user WHERE tg_active='$_active' LIMIT 1")) {
			//将Tg_active清空表示已激活用户
			_query("UPDATE tg_user SET tg_active=NULL WHERE tg_active='$_active' LIMIT 1");
			if (_mysql_affected_rows()==1) {
				_close();
				_location('恭喜你，账户激活成功！','login.php');
			}else{
				_close();
				_location('账户激活失败，请重试！','active.php?active='.$clean['active']);
			}
		}else{
			_alert_back('非法操作！');
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>凌云网络--激活</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="active">
	<h2>激活账户</h2>
	<p>本页面模拟邮箱，点击以下超级链接激活账户</p>
	<p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'?>active.php?action=ok&amp;active=<?php echo $_GET['active']?></a></p>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>