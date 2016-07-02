<?php
	header('Content-Type: text/html;charset=utf-8');
	/**
	*===================================================
	*Author:f4ck_langzi@foxmail.com
	*Date:2016年3月29日
	*===================================================
	**/
	session_start();
	//验证码防外部调用
	$_SESSION['checkcode']='code';
	//定义一个常量用来调用includes里面的文件，防止恶意调用
	define('IN_TG',true);
	//定义一个常量指定本页CSS
	define('SCRIPT', 'article');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
	//引入验证文件
	require ROOT_PATH.'includes/check.func.php';
	//获取个人数据,判断是否登录
	if (isset($_COOKIE['username'])) {
		$_cookie_username=@_mysql_string($_COOKIE['username']);
		if (!@$_rows=_fetch_array("SELECT tg_uniqid,tg_level FROM tg_user WHERE tg_username='{$_cookie_username}' LIMIT 1")) {
			_location('请登录！','login.php');
		} 
		//防止伪造COOKIE,核心函数库
		@_cmpuniqid($_COOKIE['uniqid'],$_rows['tg_uniqid']);
		$_level=$_rows['tg_level'];
	}else{
		$_rows['tg_level']='0';
	}
	//加精
	if ($_GET['action']=='nice' && isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		_query("UPDATE tg_article SET
									tg_nice=1
							WHERE
									tg_id='{$_id}'
		");
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，加精成功！','article.php?id='.$_id);
		}else{
			_alert_back('很遗憾，加精失败！');
		}
	}
	//取消加精
	if ($_GET['action']=='nice_del' && isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		_query("UPDATE tg_article SET
									tg_nice=0
							WHERE
									tg_id='{$_id}'
		");
		if (_mysql_affected_rows()==1) {
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，取消加精成功！','article.php?id='.$_id);
		}else{
			_alert_back('很遗憾，取消加精失败！');
		}
	}
	//删除文章
	if (isset($_GET['id']) && $_GET['action']=='delete') {
		$_id=intval($_GET['id']);
		//代入数据查询以验证ID合法性
		@$_rows=_fetch_array("SELECT 
								tg_id,
								tg_username
							FROM
		 						tg_article 
		 					WHERE 
		 						tg_id='{$_id}'
		 					LIMIT
		 						1
		 				");
		//再次验证身份合法性
		if ($_rows['tg_username']!==$_cookie_username && $_level!=='1') {
			_location('非法操作！111','');
		}
		if (!$_rows) {
			_alert_back('参数错误！');
		}
		//验证通过，进行删除操作
		//删除回复
		_query("DELETE 	FROM 
							tg_article 
						WHERE 
							tg_reid='{$_id}'
			");
		_query("DELETE 	FROM 
							tg_article 
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
			_location('恭喜你，文章删除成功！','index.php');
		}else{
			_alert_back('很遗憾，文章删除失败！');
		}
	}
	//处理回帖
	if (@$_GET['action']=='rearticle') {
		//判断验证码是否正确,核心函数库
        if ($_system['code']==1){
            @_check_code($_POST['code'],$_SESSION['code']);
        }
		//验证回帖时间间隔
		$_time_space=time()-$_rows['tg_last_rearticle_time'];
		if ($_time_space<$_system['re'] && $_level!=='1') {
			_alert_back('请休息'.($_system['re']-$_time_space).'秒！');
		}
		//接受数据
		$_clean=array();
		$_clean['reid']=intval($_POST['reid']);
		$_clean['type']=intval($_POST['type']);
		$_clean['title']=_check_content($_POST['title'],1,40);
		$_clean['content']=_check_content($_POST['content'],1,200);
		$_clean['username']=_check_username($_COOKIE['username']);
		$_clean=_mysql_string($_clean);
		//写入数据库
		_query("INSERT INTO tg_article(
										tg_reid,
										tg_username,
										tg_title,
										tg_type,
										tg_content,
										tg_date
										) 
								VALUES(
										'{$_clean['reid']}',
										'{$_clean['username']}',
										'{$_clean['title']}',
										'{$_clean['type']}',
										'{$_clean['content']}',
										NOW()
										)"
		);
		if (_mysql_affected_rows()==1) {
			//增加评论数
			_query("UPDATE tg_article SET tg_commendcount=tg_commendcount+1 WHERE tg_reid=0 AND tg_id='{$_clean['reid']}'");
			//记录发帖时间
			$_now=time();
			_query("UPDATE tg_user SET
										tg_last_rearticle_time='{$_now}'
									WHERE
										tg_username='{$_cookie_username}'
			");
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，回帖成功！','article.php?id='.$_clean['reid']);
		}else{
			_alert_back('很遗憾，回帖失败！');
		}
	die('未知错误！');
	}
	//读取主题帖数据
	if (isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		//代入数据查询以验证ID合法性
		if (!@$_rows=_fetch_array("SELECT 
								tg_id,
								tg_username,
								tg_title,
								tg_type,
								tg_content,
								tg_nice,
								tg_readcount,
								tg_commendcount,
								tg_last_modify_date,
								tg_last_modify_username,
								tg_date
							FROM
		 						tg_article 
		 					WHERE 
		 						tg_reid=0
		 					AND
		 						tg_id='{$_id}'
		 					LIMIT
		 						1
		 				")) {
			_alert_back('帖子不存在！');
		}
		$_html=array();
		$_html['reid']=$_rows['tg_id'];
		$_html['username']=$_rows['tg_username'];
		$_html['title']=$_rows['tg_title'];
		$_html['type']=$_rows['tg_type'];
		$_html['content']=$_rows['tg_content'];
		$_html['nice']=$_rows['tg_nice'];
		$_html['readcount']=$_rows['tg_readcount'];
		$_html['commendcount']=$_rows['tg_commendcount'];
		$_html['last_modify_date']=$_rows['tg_last_modify_date'];
		$_html['last_modify_username']=$_rows['tg_last_modify_username'];
		$_html['date']=$_rows['tg_date'];
		//累计阅读量
		_query("UPDATE tg_article SET	
										tg_readcount=tg_readcount+1
									WHERE
										tg_id='{$_id}'
				");
		//拿出用户名去查找楼主用户信息
		if (!!$_rows=_fetch_array("SELECT 
								tg_id,
								tg_sex,
								tg_face,
								tg_switch,
								tg_autograph,
								tg_email,
								tg_url
							FROM
		 						tg_user 
		 					WHERE 
		 						tg_username='{$_html['username']}'
		 					LIMIT
		 						1
		 				")) {
			//提取信息
			$_html['userid']=$_rows['tg_id'];
			$_html['sex']=$_rows['tg_sex'];
			$_html['face']=$_rows['tg_face'];
			$_html['switch']=$_rows['tg_switch'];
			$_html['autograph']=$_rows['tg_autograph'];
			$_html['email']=$_rows['tg_email'];
			$_html['url']=$_rows['tg_url'];
			$_html=_html($_html);
			//创建一个全局变量做带参分页
			global $_page_id;
			$_page_id='id='.$_html['reid'].'&';
			//修改删除主题帖
			if ($_html['username']==$_cookie_username) {
				$_html['subject_modify']='[<a href="article_modify.php?id='.$_html['reid'].'">修改</a>] [<a name="delete" href="article.php?action=delete&id='.$_html['reid'].'">删除</a>]';
			}elseif($_level=='1' && $_html['nice']==0){
				$_html['subject_modify']='[<a href="article_modify.php?id='.$_html['reid'].'">修改</a>] [<a href="article.php?action=nice&id='.$_html['reid'].'">设置加精</a>] [<a name="delete" href="article.php?action=delete&id='.$_html['reid'].'">删除</a>]';
			}elseif($_level=='1' && $_html['nice']==1){
				$_html['subject_modify']='[<a href="article_modify.php?id='.$_html['reid'].'">修改</a>] [<a href="article.php?action=nice_del&id='.$_html['reid'].'">取消加精</a>] [<a name="delete" href="article.php?action=delete&id='.$_html['reid'].'">删除</a>]';
			}
			//读取最后修改时间
			if ($_html['last_modify_username']==NULL) {
				$_html['last_modify_date']='';
			}else{
				$_html['last_modify_date']='本帖最后由 <span>['.$_html['last_modify_username'].']</span> '.'于'.$_html['last_modify_date'].'编辑';
			}
			//楼主个性签名判断
			if ($_html['switch']==1) {
				$_html['switch_html']='<p class="autograph">'.$_html['autograph'].'</p>';
			}elseif($_html['switch']==0){
				$_html['switch_html']='';
			}
			//判断是否为热帖或者精华贴
			if ($_html['readcount']>=200 && $_html['commendcount']>=20) {
				$_tag='<img class="taghot" src="image/hot.gif" alt="热帖" title="热帖"/>';
			}
			if($_html['nice']==1){
				$_tag .='<img class="tagnice" src="image/nice.gif" alt="精华" />';
			}
			//分页,核心函数库
			global $_pagessize,$_pagenum,$_page;//可以不要
			_page("SELECT tg_id FROM tg_article WHERE tg_reid='{$_html['reid']}'",9);
			//读取回帖列表
			//从数据库提取数据获取结果集
			$_result=_query("SELECT 
								tg_username,
								tg_type,
								tg_title,
								tg_content,
								tg_date
							FROM 
								tg_article 
							WHERE
								tg_reid='{$_html['reid']}'
							ORDER BY 
								tg_date 
							ASC LIMIT 
								$_pagenum,$_pagessize
			");

		}else{
			//该用户被删除
		}

	}else{
		_alert_back('非法操作！');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title><?php echo $_system['webname'] ?>--帖子详情</title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/article.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="article">
	<h2>帖子详情</h2>
	<?php echo $_tag; if ($_page==1) { ?>
	<div id="subject">
		<dl>
			<dd class="user"><?php echo $_html['username'].'('.$_html['sex'].')' ?></dd>
			<dt><img src="<?php echo $_html['face'] ?>" alt="头像" /></dt>
			<dd class="message"><a name="message" title="<?php echo $_html['userid'] ?>">发消息</a></dd>
			<dd class="friend"><a name="friend" title="<?php echo $_html['userid'] ?>">加为好友</a></dd>
			<dd class="guest"><a name="guest" title="<?php echo $_html['userid'] ?>">写留言</a></dd>
			<dd class="flower"><a name="flower" title="<?php echo $_html['userid'] ?>">给她送花</a></dd>
			<dd class="email">邮件：<a href="mailto:<?php echo $_html['email'] ?>"><?php echo $_html['email'] ?></a></dd>
			<dd class="url">网址：<a target="_blank" href="<?php echo $_html['url'] ?>"><?php echo $_html['url'] ?></a></dd>
		</dl>
		<div class="content">
			<div class="user">
				<span><?php echo $_html['subject_modify'] ?> &nbsp;楼主</span><?php echo $_html['username'] ?> | 发表于：<?php echo $_html['date'] ?>
			</div>
			<h3> <?php echo $_html['title'] ?><img src="image/icon<?php echo $_html['type'] ?>.gif" alt="" /><span>[<a href="#re" name="reclick" title="回复楼主<?php echo $_html['username'] ?>">回复</a>]</span></h3>
			<div class="detial">
				<?php echo _ubb($_html['content']) ?>
			</div>
		</div>
	</div>
	<?php echo $_html['switch_html']?>
	<p class="last_modify_date"><?php echo $_html['last_modify_date'] ?></p>
	<p class="line">阅读量:(<?php echo $_html['readcount']+1 ?>) 评论量:(<?php echo $_html['commendcount'] ?>)</p>
	<?php } ?>
	<?php 
		$_i=2;
		while (!!$_rows=_fetch_array_list($_result)) { 
		$_html['username']=$_rows['tg_username'];
		$_html['type']=$_rows['tg_type'];
		$_html['retitle']=$_rows['tg_title'];
		$_html['content']=$_rows['tg_content'];
		$_html['date']=$_rows['tg_date'];
		//拿出用户名去查找回帖用户信息
		if (!!$_rows=_fetch_array("SELECT 
								tg_id,
								tg_sex,
								tg_face,
								tg_switch,
								tg_autograph,
								tg_email,
								tg_url
							FROM
		 						tg_user 
		 					WHERE 
		 						tg_username='{$_html['username']}'
		 					LIMIT
		 						1
		 				")) {
			//提取信息
			$_html['userid']=$_rows['tg_id'];
			$_html['sex']=$_rows['tg_sex'];
			$_html['face']=$_rows['tg_face'];
			$_html['switch']=$_rows['tg_switch'];
			$_html['autograph']=$_rows['tg_autograph'];
			$_html['email']=$_rows['tg_email'];
			$_html['url']=$_rows['tg_url'];
			$_html=_html($_html);
			//楼层主个性签名判断
			if ($_html['switch']==1) {
				$_html['switch_html_1']='<p class="autograph">'.$_html['autograph'].'</p>';
			}elseif($_html['switch']==0){
				$_html['switch_html_1']='';
			}
		}else{
			//用户被删除
		}
	?>
	<!-- 回复显示区 -->
	<div class="re">
		<dl>
			<dd class="user"><?php echo $_html['username'].'('.$_html['sex'].')' ?></dd>
			<dt><img src="<?php echo $_html['face'] ?>" alt="头像" /></dt>
			<dd class="message"><a name="message" title="<?php echo $_html['userid'] ?>">发消息</a></dd>
			<dd class="friend"><a name="friend" title="<?php echo $_html['userid'] ?>">加为好友</a></dd>
			<dd class="guest"><a name="guest" title="<?php echo $_html['userid'] ?>">写留言</a></dd>
			<dd class="flower"><a name="flower" title="<?php echo $_html['userid'] ?>">给她送花</a></dd>
			<dd class="email">邮件：<a href="mailto:<?php echo $_html['email'] ?>"><?php echo $_html['email'] ?></a></dd>
			<dd class="url">网址：<a target="_blank" href="<?php echo $_html['url'] ?>"><?php echo $_html['url'] ?></a></dd>
		</dl> 
		<div class="content">
			<div class="user">
				<span>
				<?php 
					$_floor=$_i+(($_page-1)*$_pagessize).'楼';
					if($_floor==2){
						$_floor='沙发';
					}
					echo $_floor;
				?>
				</span><?php echo $_html['username'] ?> | 发表于：<?php echo $_html['date'] ?>
			</div>
			<h3> <?php echo $_html['retitle'] ?><img src="image/icon<?php echo $_html['type'] ?>.gif" alt="" /><span>[<a href="#re" name="reclick" title="回复<?php echo $_i+(($_page-1)*$_pagessize) ?>楼的<?php echo $_html['username'] ?>">回复</a>]</span></h3>
			<div class="detial">
				<?php echo _ubb($_html['content']); ?>
			</div>
		</div>
	</div>
	<?php echo $_html['switch_html_1'] ?>
	<p class="line"></p>
	<?php 
		$_i++;
		}
		//销毁结果集
		_free_result($_result);
		//分页函数，用法见核心函数库
		_paging('1');
	?>
	<?php if (isset($_COOKIE['username'])) { ?>
	<div id="message">
		<h3>评论</h3>
		<form action="?action=rearticle" method="post">
			<input type="hidden" name="reid" value="<?php echo $_html['reid'] ?>" />
			<input type="hidden" name="type" value="<?php echo $_html['type'] ?>" />
			<dl>
				<dd><span>标题:</span><input type="text" name="title" value="RE:<?php echo $_html['title'] ?>" class="text" /></dd>
				<span class="content_title">内容:</span>
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
				<dd><textarea cols="1" rows="1" name="content"></textarea></dd>
				<dd class="codetext">
                    <?php
                        if ($_system['code']){
                            echo '验证码:<input type="text" name="code" class="code"/><img id="code" src="code.php" alt="验证码" />';
                        }
                    ?>
                    <input type="submit" value="提交" class="button" />
                </dd>
			</dl>
		<a id="re"></a>
		</form>
	</div>
	<?php }else{
		echo '<div class="tologin">回复请<a href="login.php">登录</a></div>';
		} ?>
</div>

<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
