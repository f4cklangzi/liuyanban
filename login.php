<?php
header('Content-Type: text/html;charset=utf-8');
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2016年1月22日
*===================================================
**/
	@session_start();
	//验证码防外部调用
	$_SESSION['checkcode']='code';
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'login');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//防止COOKIES伪造使页面提示已经登录，清除所有cookies
	setcookie('username','',time()-1);
	setcookie('uniqid','',time()-1);
	//获取来源页
	if (empty($_SERVER["HTTP_REFERER"])) {
		$_referer="member.php";
	}else{
		$_referer=$_SERVER["HTTP_REFERER"];
	}
	// print_r($_SERVER);
	//开始处理登录状态
	if (@$_GET['action']=='login') {
		//判断验证码是否正确,核心函数库
        if ($_system['code']==1){
            @_check_code($_POST['code'],$_SESSION['code']);
        }
		//引入验证文件
		require ROOT_PATH.'includes/login.func.php';
		//接收数据
		$_clean=array();
		$_clean['referer']=$_POST['referer'];
		$_clean['username']=_check_username($_POST['username'],2,20);
		$_clean['password']=_check_password($_POST['password'],6);
		$_clean['time']=_check_time($_POST['time']);
		//查询数据库
		if (!!$_rows=_fetch_array("SELECT tg_username,tg_uniqid,tg_level FROM tg_user WHERE tg_username='{$_clean['username']}' and tg_password='{$_clean['password']}' and tg_active='' LIMIT 1")) {
			//登录成功后记录登录数据
			$_uniqid=_sha1_uniqid();
			_query("UPDATE tg_user SET	tg_uniqid='{$_uniqid}',
										tg_flower=tg_flower+1,
										tg_last_time=NOW(),
										tg_last_ip='{$_SERVER["REMOTE_ADDR"]}',
										tg_login_count=tg_login_count+1
									WHERE
										tg_username='{$_rows['tg_username']}'
				");
			_close();
			if ($_rows['tg_level']==1) {
				$_SESSION['admin']=$_rows['tg_username'];
			}
			$_SESSION['admin']=intval($_rows['tg_level']);
			_setcookies($_rows['tg_username'],$_uniqid,$_clean['time']);
			_location(null,$_clean['referer']);
		}elseif(!!$_rows=_fetch_array("SELECT tg_username,tg_uniqid FROM tg_user WHERE tg_username='{$_clean['username']}' AND tg_password='{$_clean['password']}' AND tg_active!='' LIMIT 1")) {
			_close();
			_location('用户未激活！','login.php');
		}else{
			_close();
			_location('用户名与密码不匹配！','login.php');
		}

	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--登录</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="login">
	<h2>登录</h2>
	<form action="?action=login" name="login" method="post">
	<input type="hidden" name="referer" value="<?php echo $_referer?>" />
		<dl>
			<dt><br /></dt>
			<dd><span>用 户 名：</span><input type="text" name="username" class="text" /></dd>
			<dd><span>密    码：</span><input type="password" name="password" class="text" /></dd>
			<dd><span class="auto">自动登录：</span><input type="radio" name="time" value="0" checked="checked" />无<input type="radio" name="time" value="1"/>一天内<input type="radio" name="time" value="2"/>一周内<input type="radio" name="time" value="3"/>一个月内</dd>
			<dd class="codetext" >
				<?php
					if ($_system['code']==1){
						echo '<span>验 证 码：<input type="text" name="code" class="text code"/><img id="code" src="code.php" alt="验证码" /></span>';
					}
				?>
			</dd>
			<dd class="position"><input type="submit" value="登录" class="button" /><a href="register.php" class="reg">注册</a></dd>
		</dl>
	</form>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>