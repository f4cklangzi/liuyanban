<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2016年3月22日
	*===================================================
	**/
	session_start();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'post');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//登录验证
	//获取COOKIES数据,判断是否登录,这里不使用_check_username函数是因为当COOKIES中无数据时的情况不提示用户名长度限制而是提示未登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_last_post_time FROM tg_user WHERE tg_username='{$_cookie_username}'")) {
		_location('请登录！','login.php');
	}
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	//将帖子写入数据库
	if (@$_GET['action']=='post') {
		//验证发帖时间间隔
		global $_system;
		$_time_space=time()-$_rows['tg_last_post_time'];
		if ($_time_space<$_system['post']) {
			_alert_back('请休息'.($_system['post']-$_time_space).'秒！');
		}
		//引入验证文件
		require ROOT_PATH.'includes/check.func.php';
		//接收内容
		$_clean=array();
		$_clean['username']=@_check_username($_COOKIE['username']);
		$_clean['type']=$_POST['type'];
		$_clean['title']=_check_content($_POST['title'],5,40);
		$_clean['content']=_check_content($_POST['content'],10,10000);
		$_clean=_mysql_string($_clean);
		_query("INSERT INTO tg_article(
									tg_username,
									tg_type,
									tg_title,
									tg_content,
									tg_date
										)
							VALUES
										(
									'{$_clean['username']}',
									'{$_clean['type']}',
									'{$_clean['title']}',
									'{$_clean['content']}',
									NOW()
										)
		");
		if (_mysql_affected_rows()==1) {
			//获取新增ID
			$clean['id']=_insert_id();
			//记录发帖时间
			$_now=time();
			_query("UPDATE tg_user SET
										tg_last_post_time='{$_now}'
									WHERE
										tg_username='{$_cookie_username}'
			");
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，发表成功！','article.php?id='.$clean['id']);
		}else{
			_alert_back('很遗憾，发表失败！');
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--发表帖子</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/post.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="post">
	<h2>发表帖子</h2>
	<form action="?action=post" name="register" method="post">
		<dl>
			<dt>请认真填写以下内容</dt>
			<dd>
				<span>类  型：</span>
				<?php foreach (range(1, 16) as $_num) {
					if ($_num==1) {
						echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'" checked="checked">';
					}else{
						echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'">';
					}
					echo '<img src="image/icon'.$_num.'.gif" alt="类型" />&nbsp;&nbsp;&nbsp;</label>';
				} ?>
			</dd>
			<dd class="title"><span>标  题：</span><input type="text" name="title" class="text" /></dd>
			<dd></dd>
			<span class="pos">内  容：</span>
			<?php include ROOT_PATH.'includes/ubb.inc.php'?>
			<div id="font">
				<strong onclick="font(10)">10px</strong>
				<strong onclick="font(12)">12px</strong>
				<strong onclick="font(14)">14px</strong>
				<strong onclick="font(16)">16px</strong>
				<strong onclick="font(18)">18px</strong>
				<strong onclick="font(20)">20px</strong>
				<strong onclick="font(22)">22px</strong>
				<strong onclick="font(24)">24px</strong>
			</div>
			<div id="color">
				<strong title="黑色" style="background-color: #000;" onclick="showcolor('#000')"></strong>
				<strong title="褐色" style="background-color: #930;" onclick="showcolor('#930')"></strong>	
				<strong title="深绿" style="background-color: #030;" onclick="showcolor('#030')"></strong>	
				<strong title="深蓝" style="background-color: #000080;" onclick="showcolor('#000080')"></strong>
				<em><input type="text" name="t" placeholder="#fff"/></em>
			</div>
			<dd>
				<textarea rows="1" cols="1" name="content" ></textarea>
			</dd>
			<input type="submit" value="发表" class="submit" />
		</dl>
	</form>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>