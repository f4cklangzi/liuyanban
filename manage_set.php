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
	define('SCRIPT', 'manage_set');
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
	//管理员权限验证
	if ($_rows['tg_level']!=1) {
		_location('越权操作！','');
	}
	//修改系统表
	if (@$_GET['action']=='set') {
		//判断验证码是否正确,核心函数库
        if ($_system['code']==1){
            @_check_code($_POST['viry_code'],$_SESSION['code']);
        }
		//引入验证文件
		require ROOT_PATH.'includes/check.func.php';
		$_clean=array();
		$_clean['webname']=_check_content($_POST['webname'],1,20);
		$_clean['article']=intval($_POST['article']);
		$_clean['blog']=intval($_POST['blog']);
		$_clean['photo']=intval($_POST['photo']);
		$_clean['skin']=intval($_POST['skin']);
		$_clean['string']=_check_content($_POST['string'],0,200);
		$_clean['post']=intval($_POST['post']);
		$_clean['re']=intval($_POST['re']);
		$_clean['code']=intval($_POST['code']);
		$_clean['register']=intval($_POST['register']);
		_query("UPDATE tg_system SET
										tg_webname='{$_clean['webname']}',
										tg_article='{$_clean['article']}',
										tg_blog='{$_clean['blog']}',
										tg_photo='{$_clean['photo']}',
										tg_skin='{$_clean['skin']}',
										tg_string='{$_clean['string']}',
										tg_post='{$_clean['post']}',
										tg_re='{$_clean['re']}',
										tg_code='{$_clean['code']}',
										tg_register='{$_clean['register']}'
									WHERE
										tg_id=1
				");
		//判断是否修改成功
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			//跳转
			_location('配置已更新！','manage_set.php');
		}else{
			_alert_back('很遗憾，未修改任何数据！');
			die();
		}
	}
		//文章数
		if ($_system['article']==10) {
			$_system['article_html']='<select name="article"><option value="10" selected="selected">每页10篇</option><option value="12">每页12篇</option></select></select>';
		}elseif ($_system['article']==12) {
			$_system['article_html']='<select name="article"><option value="10">每页10篇</option><option value="12" selected="selected">每页12篇</option></select>';
		}
		//博友数
		if ($_system['blog']==10) {
			$_system['blog_html']='<select name="blog"><option value="10" selected="selected">每页显示10名</option><option value="15">每页显示15名</option></select></select>';
		}elseif ($_system['blog']==15) {
			$_system['blog_html']='<select name="blog"><option value="10">每页显示10名</option><option value="15" selected="selected">每页显示15名</option></select>';
		}
		//照片数
		if ($_system['photo']==10) {
			$_system['photo_html']='<select name="photo"><option value="10" selected="selected">每页显示10张</option><option value="15">每页显示15张</option></select></select>';
		}elseif ($_system['photo']==15) {
			$_system['photo_html']='<select name="photo"><option value="10">每页显示10张</option><option value="15" selected="selected">每页显示15张</option></select>';
		}
		//皮肤选择
		if ($_system['skin']==1) {
			$_system['skin_html']='<select name="skin"><option value="1" selected="selected">简洁商务</option><option value="2">粉色诱惑</option><option value="3">绿色森林</option></select></select>';
		}elseif ($_system['skin']==2) {
			$_system['skin_html']='<select name="skin"><option value="1">简洁商务</option><option value="2" selected="selected">粉色诱惑</option><option value="3">绿色森林</option></select>';
		}elseif ($_system['skin']==3){
			$_system['skin_html']='<select name="skin"><option value="1">简洁商务</option><option value="2">粉色诱惑</option><option value="3" selected="selected">绿色森林</option></select>';
		}
		//验证码开关
		if ($_system['code']==1) {
			$_system['code_html']='<span><input type="radio" name="code" value="1" checked="checked" />开启</span><span><input type="radio" name="code" value="0"/>关闭</span>';
		}elseif($_system['code']==0) {
			$_system['code_html']='<span><input type="radio" name="code" value="1" checked="checked" />开启</span><span><input type="radio" name="code" value="0" checked="checked"/>关闭</span>';
		}
		//注册开关
		if ($_system['register']==1) {
			$_system['register_html']='<span><input type="radio" name="register" value="1" checked="checked" />开启</span><span><input type="radio" name="register" value="0"/>关闭</span>';
		}elseif($_system['register']==0) {
			$_system['register_html']='<span><input type="radio" name="register" value="1" checked="checked" />开启</span><span><input type="radio" name="register" value="0" checked="checked"/>关闭</span>';
		}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--后台管理中心</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/manage_set.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php require ROOT_PATH.'includes/manage.inc.php' ?>
	<div id="member_main">
		<h2>系统设置中心</h2>
		<form action="?action=set" method="post">
		<dl>
			<span>网站名称</span><dd><input type="text" name="webname" value="<?php echo $_system['webname'] ?>" /></dd>
			<span>每页文章列表数</span><dd><?php echo $_system['article_html']; ?></dd>
			<span>每页博友列表数</span><dd><?php echo $_system['blog_html']; ?></dd>
			<span>每页相册列表数</span><dd><?php echo $_system['photo_html']; ?></dd>
			<span>网站皮肤选择</span><dd><?php echo $_system['skin_html']; ?></dd>
			<span>非法字符过滤</span><dd><input type="text" name="string" value="<?php echo $_system['string'] ?>" /> *多个请用"|"隔开</dd>
			<span>发帖时间间隔</span><dd><input type="text" name="post" value="<?php echo $_system['post'] ?>" /> 秒</dd>
			<span>回帖时间间隔</span><dd><input type="text" name="re" value="<?php echo $_system['re'] ?>" /> 秒</dd>
			<span>是否启用验证码</span><dd class="code"><?php echo $_system['code_html']; ?></dd>
			<span>是否开放注册</span><dd class="register"><?php echo $_system['register_html']; ?></dd>
			<dd class="botton">
                <?php
                    if ($_system['code']==1){
                        echo '				<span class="codetext">验 证 码:<input type="text" name="viry_code" class="code"/><img src="code.php" alt="验证码" /></span>';
                    }
                ?>
			<input type="submit" value="保存" class="button" />
			</dd>
		</dl>
		</form>
	</div>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>