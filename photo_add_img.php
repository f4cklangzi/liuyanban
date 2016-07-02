<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2016年4月12日
	*===================================================
	**/
	session_start();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'photo_add_img');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_level FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
		_location('请登录！','login.php');
	}
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	//保存图片信息
	if (@$_GET['action']=='addimg') {
		//引入验证文件
		require ROOT_PATH.'includes/check.func.php';
		//接收数据
		$_clean=array();
		$_clean['name']=_check_content($_POST['name'],2,20);
		$_clean['path']=_check_content($_POST['path'],31,40);
		$_clean['content']=_check_content($_POST['content'],0,200);
		$_clean['sid']=_check_content($_POST['sid'],0,20);
		$_clean['username']=$_cookie_username;
		$_clean=_mysql_string($_clean);
		//写入数据库
			_query("INSERT INTO tg_photo(
											tg_name,
											tg_url,
											tg_content,
											tg_sid,
											tg_username,
											tg_date
										)
								VALUES(
											'{$_clean['name']}'	,
											'{$_clean['path']}'	,
											'{$_clean['content']}'	,
											'{$_clean['sid']}'	,
											'{$_clean['username']}'	,
											NOW()	
										)
			");
			if (_mysql_affected_rows()==1) {
				//获取新增ID
				$_clean['id']=_insert_id();
				//关闭连接
				_close();
				//跳转
				_location('恭喜你，照片保存成功！','photo_detail.php?id='.$_clean['id'] );
			}else{
				_alert_back('很遗憾，照片保存失败！');
			}
	}
	//获取ID值判断相册
	if (isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		if (!!$_rows=_fetch_array("SELECT 
										tg_id,
										tg_name,
										tg_dir
									FROM 
										tg_dir
									WHERE
										tg_id='{$_id}'
									LIMIT
										1
			")) {
			$_html=array();
			$_html['id']=$_rows['tg_id'];
			$_html['name']=$_rows['tg_name'];
			$_html['dir']=base64_encode($_rows['tg_dir']);
			$_html=_html($_html);
		}else{
			_alert_back('此相册不存在！');
		}
	}else{
		_alert_back('参数缺失！');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--相册</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/photo_add_img.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="photo_add_dir">
	<h2>上传图片-<?php echo $_html['name']; ?></h2>
	<form action="?action=addimg" method="post">
		<input type="hidden" name="sid" value="<?php echo $_html['id'] ?>" />
		<dd>图片名称 <input type="text" name="name" class="text" /></dd>
		<dd>图片地址 <input id="path" type="text" name="path" readonly="readonly" class="text" /><a title="<?php echo $_html['dir']; ?>" id="up" href="javascript:;">上传</a></dd>
		<dd><span>图片简介 </span><textarea name="content" cols="30" rows="5"></textarea></dd>
		<dd><input class="button" type="submit" value="添加" /></dd>
	</form>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
