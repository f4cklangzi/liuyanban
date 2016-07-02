<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年1月30日
	*===================================================
	**/
	session_start();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'blog');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//分页,核心函数库
	global $_pagessize,$_pagenum;//可以不要
	_page("SELECT tg_id FROM tg_user",$_system['blog']);
	//从数据库提取数据获取结果集
	$_result=_query("SELECT 
							tg_id,
							tg_username,
							tg_sex,
							tg_face 
						FROM 
							tg_user 
						ORDER BY 
							tg_reg_time 
						DESC LIMIT 
							$_pagenum,$_pagessize
					");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--博友</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="blog">
	<h2>博友列表</h2>
	<?php while (!!$_rows=_fetch_array_list($_result)) { ?>
	<dl>
		<dd class="user"><?php echo _html($_rows['tg_username']);echo '('._html($_rows['tg_sex']).')'?></dd>
		<dt><img src="<?php echo _html($_rows['tg_face']) ?>" alt="<?php echo _html($_rows['tg_username']) ?>" /></dt>
		<dd class="message"><a name="message" title="<?php echo _html($_rows['tg_id']) ?>">发消息</a></dd>
		<dd class="friend"><a name="friend" title="<?php echo _html($_rows['tg_id']) ?>">加为好友</a></dd>
		<dd class="guest"><a name="guest" title="<?php echo _html($_rows['tg_id']) ?>">写留言</a></dd>
		<dd class="flower"><a name="flower" title="<?php echo _html($_rows['tg_id']) ?>">给她送花</a></dd>
	</dl>
	<?php } ?>
	<?php 
		//销毁结果集
		_free_result($_result);
		//分页函数，用法见核心函数库
		_paging('1');
	 ?>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
