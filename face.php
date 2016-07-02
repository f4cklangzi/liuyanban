<?php
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年12月5日
*===================================================
**/
//定义一个常量用来调用includes里面的文件，防止恶意调用
define('IN_TG',true);
//定义一个常量指定本页CSS
define('SCRIPT', 'face');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--头像选择</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/opener.js"></script>
</head>
<body>
	<div id="face">
		<h3>选择头像</h3>
		<dl>
			<?php foreach(range(1, 10) as $picnum){ ?>
			<dd><img src="image/face/<?php echo $picnum;?>.png" alt="image/face/<?php echo $picnum;?>.png" title="头像<?php echo $picnum;?>" /></dd>
			<?php } ?>
			
		</dl>
	</div>
</body>
</html>