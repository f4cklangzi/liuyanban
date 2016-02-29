<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2015年2月20日
	*===================================================
	**/
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'member_flower');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//获取个人数据,判断是否登录
	$_cookie_username=@_mysql_string($_COOKIE['username']);
	if (!@$_rows=_fetch_array("SELECT 
									tg_uniqid,
									tg_flower
								FROM 
									tg_user
		 						WHERE
									tg_username='{$_cookie_username}' 
								LIMIT
		  							1
		")) {
		_location('请登录！','login.php');
	}
	$_flower_all=$_rows['tg_flower'];
	//防止伪造COOKIE,核心函数库
	@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
	//批量删除模块
	if (@$_GET['action']=='delete' && !isset($_POST['ids'])) {
		_alert_back('未选择任何记录！');
	}elseif(@$_GET['action']=='delete' && isset($_POST['ids'])){
		$_clean=array();
		$_clean['id']=implode(',', _intval($_POST['ids']));
		//代入数据查询以验证ID合法性
		@$_rows=_fetch_array("SELECT 
								tg_id
							FROM
		 						tg_flower 
		 					WHERE 
		 						tg_id
		 					In
		 						({$_clean['id']})
		 					AND
		 						tg_touser='{$_cookie_username}'
		 				");
		if (!$_rows) {
			_location('非法操作！','member_flower.php');
		}
		//验证通过，进行删除操作
		_query("DELETE 	FROM 
							tg_flower 
						WHERE 
							tg_id
						In
							({$_clean['id']})
			");
		//判断是否删除成功
		if (!!$_modify=_mysql_affected_rows()) {
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，成功删除'.$_modify.'条记录！','member_flower.php');
		}else{
			_alert_back('很遗憾，记录删除失败！');
		}
	}
	//分页模块,核心函数库
	global $_pagessize,$_pagenum;//可以不要
	_page("SELECT tg_id FROM tg_flower WHERE tg_touser='{$_cookie_username}'",14);
	//从数据库提取数据获取结果集
	$_result=_query("SELECT 
						tg_id,
						tg_fromuser,
						tg_touser,
						tg_content,
						tg_flower,
						tg_date 
					FROM 
						tg_flower
					WHERE
						tg_touser='{$_cookie_username}'
					ORDER BY 
						tg_date DESC 
					LIMIT 
					$_pagenum,$_pagessize
					");
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>凌云网络--花朵查阅</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/member_flower.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php require ROOT_PATH.'includes/member.inc.php' ?>
	<div id="member_main">
		<h2>花朵管理中心</h2>
		<dl>
		<form method="post" action="?action=delete">
			<table cellspacing="1">
				<tr><th>送花人</th><th>祝福内容</th><th>花朵数</th><th>送花日期</th><th>操作</th></tr>
				<?php 
					while ($_rows=_fetch_array_list($_result)) { 
				?>
					<tr class="line"><td><?php echo _html($_rows['tg_fromuser']); ?></td><td><?php echo _title(_html($_rows['tg_content']),20) ?></td><td><img src="image/x4.gif" alt="花朵" />x<?php echo _html($_rows['tg_flower']); ?>朵</td><td><?php echo  _html($_rows['tg_date']); ?></td><td><input name="ids[]" value="<?php echo _html($_rows['tg_id']); ?>" type="checkbox" /></td></tr>
					
				<?php 
					} 
					//销毁结果集
					_free_result($_result);
				?>
				<tr class="line"><td colspan="5">共<?php echo $_flower_all ?> 朵花</td></tr>
				<tr><td class="del" colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all" /></label><input id="delete" type="submit" value="删除" /></td></tr>
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
