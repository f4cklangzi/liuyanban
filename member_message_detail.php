<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年2月13日
	*===================================================
	**/
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'member_message_detail');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT 
									tg_uniqid
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
	//删除短信模块
	if (@$_GET['action']=='delete' && isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		//代入数据查询以验证ID合法性
		@$_rows=_fetch_array("SELECT 
								tg_id
							FROM
		 						tg_message 
		 					WHERE 
		 						tg_id='{$_id}'
		 					AND
		 						tg_touser='{$_cookie_username}'
		 					LIMIT
		 						1
		 				");
		if (!$_rows) {
			_location('非法操作！','member_message.php');
		}
		//验证通过，进行删除操作
		_query("DELETE 	FROM 
							tg_message 
						WHERE 
							tg_id='{$_id}'
						LIMIT 
							1
			");
		//判断是否删除成功
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，短信删除成功！','member_message.php');
		}else{
			_alert_back('很遗憾，短信删除失败！');
		}
	}
	//判断是否有ID参数传入
	if (!@isset($_GET['id'])) {
		_location('参数缺失！','member_message.php');
	}
	//获取传入的ID参数
	$_id=intval($_GET['id']);
	//获取短信信息
	@$_rows=_fetch_array("SELECT 
								tg_fromuser,
								tg_content,
								tg_state,
								tg_date 
							FROM
		 						tg_message 
		 					WHERE 
		 						tg_id='{$_id}'
		 					AND
		 						tg_touser='{$_cookie_username}'
		 					LIMIT
		 						1
		 				");
	//判断ID是否有效
	if (!$_rows) {
		_location('短信息不存在！','member_message.php');
	}
	//设置短信已读状态
	if (empty($_rows['tg_state'])) {
		_query("UPDATE 
						tg_message 
					SET 
						tg_state=1
					WHERE 
		 				tg_id='{$_id}'
		 			AND
		 				tg_touser='{$_cookie_username}'
		 			LIMIT
		 				1
			");
		if (!_mysql_affected_rows()){
			_alert_back('短信状态异常！');
		}
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>凌云网络--短信详情</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/member_message_detail.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php require ROOT_PATH.'includes/member.inc.php' ?>
	<div id="member_main">
		<h2>短信详情</h2>
		<dl>
			<dd><strong>发信人：</strong><?php echo _html($_rows['tg_fromuser'])?></dd>
			<dd><strong>内容：</strong><?php echo _html($_rows['tg_content'])?></dd>
			<dd><strong>发信时间：</strong><?php echo _html($_rows['tg_date'])?></dd>
			<dd class="button"><input type="button" value="返回列表" id="return" /><input type="button" name="<?php echo $_id ?>" value="删除短信" id="delete" /></dd>
		</dl>
	</div>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
