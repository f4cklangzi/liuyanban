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
	define('SCRIPT', 'photo_detail');
	//引入公共文件
	include dirname(__FILE__).'/includes/common.inc.php';
	//连接数据库
	include ROOT_PATH.'/includes/conn.php';
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
		$_rows['tg_level']=0;
	}
	//评论处理
	if (@$_GET['action']=='rephoto') {
		//判断验证码是否正确,核心函数库
        if ($_system['code']==1){
            @_check_code($_POST['code'],$_SESSION['code']);
        }
        //引入验证文件
		require ROOT_PATH.'includes/check.func.php';
        //接受数据
		$_clean=array();
		$_clean['sid']=intval($_POST['sid']);
		$_clean['title']=_check_content($_POST['title'],1,40);
		$_clean['content']=_check_content($_POST['content'],1,200);
		$_clean['username']=_check_username($_COOKIE['username']);
		$_clean=_mysql_string($_clean);
		//写入数据库
		_query("INSERT INTO tg_photo_commend(
										tg_title,
										tg_content,
										tg_sid,
										tg_username,
										tg_date
										) 
								VALUES(
										'{$_clean['title']}',
										'{$_clean['content']}',
										'{$_clean['sid']}',
										'{$_clean['username']}',
										NOW()
										)"
		);
		if (_mysql_affected_rows()==1) {
			//增加评论数
			_query("UPDATE tg_photo SET tg_commendcount=tg_commendcount+1 WHERE tg_id='{$_clean['sid']}'");
			//关闭连接
			_close();
			//跳转
			_location('恭喜你，评论成功！','photo_detail.php?id='.$_clean['sid']);
		}else{
			_alert_back('很遗憾，评论失败！');
		}
	}
	//获取ID值判断相册
	if (isset($_GET['id'])) {
		$_id=intval($_GET['id']);
		if (!!$_rows=_fetch_array("SELECT 
										tg_id,
										tg_sid,
										tg_name,
										tg_url,
										tg_username,
										tg_readcount,
										tg_commendcount,
										tg_content,
										tg_date
									FROM 
										tg_photo
									WHERE
										tg_id='{$_id}'
									LIMIT
										1
			")) {
			$_html=array();
			$_html['id']=$_rows['tg_id'];
			$_html['sid']=$_rows['tg_sid'];
			$_html['name']=$_rows['tg_name'];
			$_html['image_url']=$_rows['tg_url'];
			$_html['username']=$_rows['tg_username'];
			$_html['readcount']=$_rows['tg_readcount']+1;
			$_html['commendcount']=$_rows['tg_commendcount'];
			$_html['content']=$_rows['tg_content'];
			$_html['date']=$_rows['tg_date'];
			$_html=_html($_html);
			//防止绕过权限访问
			if (!!$_dir=_fetch_array("SELECT tg_type,tg_password FROM tg_dir WHERE tg_id='{$_html['sid']}'")) {
				$_html['true_password']=sha1($_dir['tg_password']);
				if ($_dir['tg_type']=='1') {
					if ($_level!='1') {
						if ($_html['true_password']!=$_COOKIE['photo'.$_html['sid']]) {
							_alert_back('非法访问！');
						}
					}
				}
			}
			//累计浏览量
			_query("UPDATE tg_photo SET	
										tg_readcount=tg_readcount+1
									WHERE
										tg_id='{$_id}'
				");
			$_image_info=getimagesize($_html['image_url']);
			if ($_image_info['0']>750) {
				$_image_width=750;
			}
			//上一页和下一页ID获取
			$_preid=_fetch_array("SELECT 
										min(tg_id) 
									AS 
										id 
									FROM
				 						tg_photo
				  					WHERE
				   						tg_sid='{$_html['sid']}' 
				   					AND 
				   						tg_id>'{$_id}'
				   				");
			$_pre=empty($_preid['id'])?'<a class="page">到顶了</a>':'<a class="page" href="photo_detail.php?id='.$_preid['id'].'">上一页</a>';
			$_nextid=_fetch_array("SELECT 
										max(tg_id) 
									AS 
										id 
									FROM
				 						tg_photo
				  					WHERE
				   						tg_sid='{$_html['sid']}' 
				   					AND 
				   						tg_id<'{$_id}'
				   				");
			$_next=empty($_nextid['id'])?'<a class="page">到底了</a>':'<a class="page" href="photo_detail.php?id='.$_nextid['id'].'">下一页</a>';
			//拿出用户名去查找楼主用户信息
			if (!!$_rows=_fetch_array("SELECT 
											*
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
				$_page_id='id='.$_html['id'].'&';
				//楼主个性签名判断
				if ($_html['switch']==1) {
					$_html['switch_html']='<p class="autograph">'.$_html['autograph'].'</p>';
				}elseif($_html['switch']==0){
					$_html['switch_html']='';
				}
				//分页,核心函数库
				global $_pagessize,$_pagenum,$_page;//可以不要
				_page("SELECT tg_id FROM tg_photo_commend WHERE tg_sid='{$_html['id']}'",9);
				//读取回帖列表
				//从数据库提取数据获取结果集
				$_result=_query("SELECT 
									*
								FROM 
									tg_photo_commend 
								WHERE
									tg_sid='{$_html['id']}'
								ORDER BY 
									tg_date 
								ASC LIMIT 
									$_pagenum,$_pagessize
				");
			}else{
				//用户被删除
			}
		}else{
			_alert_back('此图片不存在！');
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
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/photo_detail.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="photo_detail">
 	<h2>图片详情</h2>
 	<dl class="detail">
 		<dt><?php echo $_html['name'] ?></dt>
 		<dd><?php echo $_pre ?><img width="<?php echo @$_image_width ?>px" src="<?php echo $_html['image_url'] ?>" alt="<?php echo $_html['name'] ?>" /><?php echo $_next ?></dd>
 		<dd><a href="photo_show.php?id=<?php echo $_html['sid'] ?>">[返回列表]</a></dd>
 		<dd>浏览量(<?php echo $_html['readcount']?>) 评论量(<?php echo $_html['commendcount'] ?>) 上传者:<?php echo $_html['username'] ?> 上传时间:<?php echo $_html['date'] ?></dd>
 		<dd>简介:<?php echo $_html['content'] ?></dd>
 	</dl>
 	<?php 
		$_i=2;
		while (!!$_rows=_fetch_array_list($_result)) { 
			$_html['username']=$_rows['tg_username'];
			$_html['retitle']=$_rows['tg_title'];
			$_html['content']=$_rows['tg_content'];
			$_html['date']=$_rows['tg_date'];
			//拿出用户名去查找回帖用户信息
			if (!!$_rows=_fetch_array("SELECT 
											*
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
 	<p class="line"></p>
 	<?php if (isset($_COOKIE['username'])) { ?>
	<div id="message">
		<h3>评论</h3>
		<form action="?id=<?php echo $_html['id'] ?>&action=rephoto" method="post">
			<input type="hidden" name="sid" value="<?php echo $_html['id'] ?>" />
			<input type="hidden" name="username" value="<?php echo $_cookie_username ?>" />
			<dl>
				<dd><span>标题:</span><input type="text" name="title" value="RE:<?php echo $_html['name'] ?>" class="text" /></dd>
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
		echo '<div class="tologin">评论请<a href="login.php">登录</a></div>';
		} ?>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>