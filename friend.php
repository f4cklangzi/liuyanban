<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年2月13日
	*===================================================
	**/
	@session_start();
	//验证码防外部调用
	$_SESSION['checkcode']='code';
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'friend');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//引入验证文件
	require ROOT_PATH.'includes/check.func.php';
	//获取COOKIES数据,判断是否登录,这里不使用_check_username函数是因为当COOKIES中无数据时的情况不提示用户名长度限制而是提示未登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_cookie_username}'")) {
		//跳转地址留空表示弹窗后不跳转直接关闭窗口
		_location('请登录！','');
	}
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	//判断是否有参数传入
	if (!@isset($_GET['id'])) {
		//添加好友
		if (@$_GET['action']=='add') {
			//判断验证码是否正确,核心函数库
			if ($_system['code']==1){
				@_check_code($_POST['code'],$_SESSION['code']);
			}
			$_clean = array();
			$_clean['touser']=@_check_username($_POST['touser']);
			$_clean['content']=@_check_content($_POST['content'],$min=1,$max=200);
			$_clean=@_html(_mysql_string($_clean));
			//写入数据库
			_query("INSERT INTO tg_friend
											(
												tg_touser,
												tg_fromuser,
												tg_content,
												tg_date
											)
									 VALUES (
									 			'{$_clean['touser']}',
									 			'{$_cookie_username}',
									 			'{$_clean['content']}',
									 			NOW()
											)
			");
			if (_mysql_affected_rows()==1) {
				//关闭连接
				_close();
				//跳转
				_location('恭喜你，验证信息发送成功！','');
			}else{
				_alert_back('很遗憾，验证信息发送失败！');
			}
		}else{
			_location('参数缺失！','blog.php');
		}
	}
	//获取传入的ID参数
	$_id=intval($_GET['id']);
	//获取被添加人用户名
	@$_rows=_fetch_array("SELECT 
								tg_username 
							FROM
		 						tg_user 
		 					WHERE 
		 						tg_id='{$_id}'
		 					LIMIT
		 						1
		 				");
	//判断ID是否有效
	if (!$_rows) {
		_location('用户不存在！','');
	}
	//禁止添加自己
	if ($_cookie_username==@$_rows['tg_username']) {
		_location('不允许添加自己为好友！','');
	}
	//判断是否已经添加过
	@$_is_friend=_fetch_array("SELECT 
								tg_id 
							FROM
		 						tg_friend 
		 					WHERE 
		 						(tg_fromuser='{$_cookie_username}' AND tg_touser='{$_rows['tg_username']}')
		 					OR
								(tg_fromuser='{$_rows['tg_username']}' AND tg_touser='{$_cookie_username}')
		 					LIMIT
		 						1
		 				");
		if ($_is_friend) {
			_location('你们已经是好友关系或者有好友请求未处理！','');
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--添加好友</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<div id="friend">
	<h3>添加好友</h3>
	<form action="?action=add" method="post">
	<input type="hidden" name="touser" value="<?php echo $_rows['tg_username'] ?>" />
		<dl>
			<dd><input type="text" disabled="disabled" value="TO:<?php echo $_rows['tg_username'] ?>" class="text" /></dd>
			<dd><textarea rows="1" name="content" id="" cols="30">我是<?php echo $_cookie_username ?>，希望和你成为朋友！</textarea></dd>
			<dd class="codetext">
				<?php
					if ($_system['code']==1){
						echo '验证码：<input type="text" name="code" class="code"/><img id="code" src="code.php" alt="验证码" />';
					}
				?>
				<input type="submit" value="发送" class="button" />
			</dd>
			
		</dl>
	</form>
</div>
</body>
</html>