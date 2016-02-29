<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年2月11日
	*===================================================
	**/
	@session_start();
	//验证码防外部调用
	$_SESSION['checkcode']='code';
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'member_modify');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_username,tg_sex,tg_face,tg_level,tg_email,tg_url,tg_qq FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
		_location('请登录！','login.php');
	}
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	//修改资料
	if (@$_GET['action']=='modify') {
		//判断验证码是否正确,核心函数库
		@_check_code($_POST['code'],$_SESSION['code']);
		//引入验证文件
		require ROOT_PATH.'includes/check.func.php';
		//创建一个数组存放提交的安全数据
		$clean=array();
		$clean['username']=@_check_username($_POST['username'],2,20);
		$clean['password']=@_check_modify_password($_POST['password'],6);
		$clean['sex']=@_check_sex($_POST['sex']);
		$clean['face']=@_check_face($_POST['face']);
		$clean['email']=@_check_email($_POST['email'],6,40);
		$clean['qq']=@_check_qq($_POST['qq']);
		$clean['url']=@_check_url($_POST['url'],40);
		//修改资料
		if (!empty($clean['password'])) {
			_query("UPDATE tg_user SET
										tg_username='{$clean['username']}',
										tg_password='{$clean['password']}',
										tg_sex='{$clean['sex']}',
										tg_face='{$clean['face']}',
										tg_email='{$clean['email']}',
										tg_qq='{$clean['qq']}',
										tg_url='{$clean['url']}'
									WHERE
										tg_username='{$_COOKIE['username']}'
				");
		}else{
			_query("UPDATE tg_user SET
										tg_username='{$clean['username']}',
										tg_sex='{$clean['sex']}',
										tg_face='{$clean['face']}',
										tg_email='{$clean['email']}',
										tg_qq='{$clean['qq']}',
										tg_url='{$clean['url']}'
									WHERE
										tg_username='{$_COOKIE['username']}'
				");
		}
		//判断是否修改成功
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			_session_destroy();
			//重新设置cooki，否则修改后数据库中的用户名和本地cookies中的用户名不同
			setcookie('username',$clean['username']);
			//跳转
			_location('恭喜你，修改成功！','member.php');
		}else{
			_location('很遗憾，未修改任何数据！','member_modify.php');
		}
	}
	$_html = array();
	$_html['uniqid']=$_rows['tg_uniqid'];
	$_html['username']=$_rows['tg_username'];
	$_html['sex']=$_rows['tg_sex'];
	$_html['face']=$_rows['tg_face'];
	$_html['email']=$_rows['tg_email'];
	$_html['url']=$_rows['tg_url'];
	$_html['qq']=$_rows['tg_qq'];
	$_html=_html($_html);
	//性别处理
	if ($_html['sex']=='男') {
		$_html['sex_html']='<input type="radio" name="sex" value="男" checked="checked" />男<input type="radio" name="sex" value="女"/>女';
	}else{
		$_html['sex_html']='<input type="radio" name="sex" value="男" checked="checked" />男<input type="radio" name="sex" value="女" checked="checked"/>女';
	}
	//头像选择
	$_html['face_html']='<select name="face">';
	foreach (range(1,10) as $_num) {
		$_html['face_html'] .='<option value="image/face/'.$_num.'.png">image/face/'.$_num.'.png</option>';
	}
	$_html['face_html'] .='</select>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>凌云网络--个人中心</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/member_modify.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php require ROOT_PATH.'includes/member.inc.php' ?>
	<div id="member_main">
		<h2>会员管理中心</h2>
		<form name="modify" method="post" action="?action=modify">
		<dl>
			<span>用 户 名：</span><dd><input type="text" name="username" value="<?php echo $_html['username'] ?>"/></dd>
			<span>密    码(留空则不修改)：</span><dd><input type="password" name="password" value=""/></dd>
			<span>性    别：</span><dd class="sex"><?php echo $_html['sex_html'] ?></dd>
			<span>头    像：</span><dd><?php echo $_html['face_html'] ?></dd>
			<span>电子邮件：</span><dd><input type="text" name="email" value="<?php echo $_html['email'] ?>"/></dd>
			<span>主    页：</span><dd><input type="text" name="url" value="<?php echo $_html['url'] ?>"/></dd>
			<span>Q      Q：</span><dd><input type="text" name="qq" value="<?php echo $_html['qq'] ?>"/></dd>
			<span class="codetext">验 证 码：<input type="text" name="code" class="code"/><img id="code" src="code.php" alt="验证码" /></span>
			<dd><input type="submit" value="确认修改" class="button" /></dd>
		</dl>
		</form>
	</div>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>