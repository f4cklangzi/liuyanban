<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2016年4月10日
	*===================================================
	**/
	session_start();
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'manage_member');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT 
									tg_uniqid,
									tg_level
								FROM 
									tg_user
		 						WHERE
									tg_username='{$_cookie_username}' 
								LIMIT
		  							1
		")) {
		_location('请登录！','login.php');
	}
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	//管理员权限验证
	if ($_rows['tg_level']!=1) {
		_location('越权操作！','');
	}
	//读取系统表
	//分页,核心函数库
	global $_pagessize,$_pagenum;//可以不要
	_page("SELECT tg_id FROM tg_user",15);
	//从数据库提取数据获取结果集
	$_result=_query("SELECT 
							tg_id,
							tg_username,
							tg_email,
							tg_reg_time
						FROM 
							tg_user 
						ORDER BY 
							tg_reg_time 
						DESC LIMIT 
							$_pagenum,$_pagessize
					");
	//删除模块
	if (@$_GET['action']=='del' && isset($_GET['id'])) {
		//进行删除操作
		$_id=intval($_GET['id']);
		_query("DELETE 	FROM 
							tg_user
						WHERE 
							tg_id='{$_id}'
			");
		//判断是否删除成功
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			//跳转
			_location('用户已删除！','manage_member.php');
		}else{
			_alert_back('很遗憾,删除失败！');
		}
	}
	if (@$_GET['action']=='modify') {
		_alert_back('该功能暂未开通！');
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?>--会员列表</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/manage_member.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php require ROOT_PATH.'includes/manage.inc.php' ?>
	<div id="member_main">
		<h2>会员管理中心</h2>
		<dl>
		<form method="post" action="?action=delete">
			<table cellspacing="1">
				<tr><th>用户ID</th><th>用户名</th><th>注册邮箱</th><th>注册日期</th><th>操作</th></tr>
				<?php while (!!$_rows=_fetch_array_list($_result)) { ?>
					<tr class="line">
						<td>
							<?php echo _html($_rows['tg_id']); ?>
						</td>
						<td>
							<?php echo _html($_rows['tg_username']); ?>
						</td>
						<td>
							<?php echo _html($_rows['tg_email']); ?>
						</td>
						<td>
							<?php echo _html($_rows['tg_reg_time']); ?>
						</td>
						<td>
							<a style="color: blue;" href="?action=modify">修改</a> 
							<a style="color: red;" name="del" href="?action=del&id=<?php echo $_rows['tg_id'] ?>">删除</a>
						</td>
					</tr>
				<?php 
					} 
					//销毁结果集
					_free_result($_result);
				?>
			</table>
				<?php
					//分页函数，用法见核心函数库
					_paging('2');
			 	?>
		</form>
	 	</dl>
	</div>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
