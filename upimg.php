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
define('SCRIPT', 'upimg');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
require dirname(__FILE__).'/includes/conn.php';
//获取个人数据,判断是否登录
$_cookie_username=@_mysql_string($_COOKIE['username']);
if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_level FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
	_location('请登录！','login.php');
}
//防止伪造COOKIE,核心函数库
@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
//执行上传图片操作
if (@$_GET['action']=='up') {
	$_files=array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
	//判断类型是否合法
	if (is_array($_files)) {
		if (!in_array(@$_FILES['userfile']['type'], $_files)) {
			_alert_back('上传图片不合法！');
		}
	}
	//判断错误类型
	if ($_FILES['userfile']['error']>0) {
		switch ($_FILES['userfile']['error']) {
			case '1':
				_alert_back('上传文件超过约定值1');
				break;
			case '2':
				_alert_back('上传文件超过约定值2');
				break;
			case '3':
				_alert_back('部分文件被上传');
				break;
			case '4':
				_alert_back('没有文件被上传');
				break;
			default:
				_alert_back('未知错误');
				break;
		}
	}
	//判断配置文件规定大小
	if ($_FILES['userfile']['size']>1000000) {
		_alert_back('上传文件不得超过1M');
	}
	//移动文件
	$_dir=base64_decode($_POST['dir']);
	if (!is_dir($_dir)) {
		_location('非法上传！','');
	}
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		//获取文件扩展名
		$_filename_array=explode('.', $_FILES['userfile']['name']);
		$_file_path=$_dir.'/'.time().'.'.strtolower(end($_filename_array));
		if (!@move_uploaded_file($_FILES['userfile']['tmp_name'],$_file_path)) {
			_location('非法上传！','');
		}else{
			echo "<script>alert('上传成功！');window.opener.document.getElementById('path').value='{$_file_path}';window.close();</script>";
			die();
		}
	}else{
		_alert_back('临时文件不存在！');
	}
}
//获取DIR值判断相册
if (isset($_GET['dir'])) {
	$_dir_html=_mysql_string($_GET['dir']);
	$_dir_sql=base64_decode($_dir_html);
	if (!!$_rows=_fetch_array("SELECT 
									tg_id
								FROM 
									tg_dir
								WHERE
									tg_dir='{$_dir_sql}'
								LIMIT
									1
		")) {
	}else{
		_location('此相册不存在！','');
	}
}else{
	_location('参数缺失！','');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--头像选择</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
</head>
<body>
	<div id="upimg" style="margin-top: 30px;">
		<form enctype="multipart/form-data" action="?action=up" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<input type="hidden" name="dir" value="<?php echo $_dir_html ?>" />
			选择图片:<input type="file" name="userfile" />
			<input type="submit" value="上传" />
		</form>
	</div>
</body>
</html>