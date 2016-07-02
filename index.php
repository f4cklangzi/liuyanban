<?php
header('Content-Type: text/html;charset=utf-8');
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年12月5日
*===================================================
**/
session_start();
//定义一个常量用来调用includes里面的文件，防止恶意调用
define('IN_TG',true);
//定义一个常量指定本页CSS
define('SCRIPT', 'index');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//连接数据库
include ROOT_PATH.'/includes/conn.php';
//读取XML文件
$_html=@_get_xml('new.xml');
//读取帖子列表
//分页,核心函数库
global $_pagessize,$_pagenum;//可以不要
_page("SELECT tg_id FROM tg_article WHERE tg_reid=0",$_system['article']);
//从数据库提取数据获取结果集
$_result=_query("SELECT 
						tg_id,
						tg_type,
						tg_title,
						tg_readcount,
						tg_commendcount
					FROM 
						tg_article
					WHERE
						tg_reid=0
					ORDER BY 
						tg_date  
					DESC LIMIT 
						$_pagenum,$_pagessize
				");
//显示最新图片
$_result_photo=_query("SELECT tg_id,tg_name,tg_url,tg_sid FROM tg_photo ORDER BY tg_date DESC");
while (!!$_FirstPic=_fetch_array_list($_result_photo)) {
	$_dir=_fetch_array("SELECT tg_type FROM tg_dir WHERE tg_id='{$_FirstPic['tg_sid']}'");
	if ($_dir['tg_type']=='0') {
		break;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_system['webname'] ?></title>
<?php
	require ROOT_PATH.'includes/title.inc.php'
?>
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="list">
	<h2>帖子列表</h2>
	<a href="post.php" class="post"></a>
	<ul class="article">
		<?php 
			while (!!$_rows=_fetch_array_list($_result)) { 
			echo '<li class="icon" style="background: url(image/icon'._html($_rows['tg_type']).'.gif) no-repeat left center;"><em>阅读数(<strong>'._html($_rows['tg_readcount']).'</strong>)<span>评论数(<strong>'._html($_rows['tg_commendcount']).'</strong>)</span></em><a href="article.php?id='._html($_rows['tg_id']).'">'._title(_html($_rows['tg_title']),20).'</a></li>';
			}
		?>
		<?php 
		//销毁结果集
		_free_result($_result);
		//分页函数，用法见核心函数库
		_paging('1');
	 ?>
	</ul>
</div>
<div id="user">
	<h2>新进会员</h2>
	<dl>
		<dd class="user"><?php echo $_html['username'].'('.$_html['sex'].')' ?></dd>
		<dt><img src="<?php echo $_html['face'] ?>" alt="<?php echo $_html['username'] ?>" /></dt>
		<dd class="message"><a name="message" title="<?php echo $_html['id'] ?>">发消息</a></dd>
		<dd class="friend"><a name="friend" title="<?php echo $_html['id'] ?>">加为好友</a></dd>
		<dd class="guest"><a name="guest" title="<?php echo $_html['id'] ?>">写留言</a></dd>
		<dd class="flower"><a name="flower" title="<?php echo $_html['id'] ?>">给她送花</a></dd>
		<dd class="email">邮件：<a href="mailto:<?php echo $_html['email'] ?>"><?php echo $_html['email'] ?></a></dd>
		<dd class="url">网址：<a target="_blank" href="<?php echo $_html['url'] ?>"><?php echo $_html['url'] ?></a></dd>
	</dl>
</div>
<div id="pics">
	<h2>最新图片</h2>
	<a href="photo_detail.php?id=<?php echo $_FirstPic['tg_id'] ?>" title="<?php echo $_FirstPic['tg_name'] ?>">
		<img src="thumb.php?filename=<?php echo $_FirstPic['tg_url'] ?>&keep_scale=200 ?>" alt="<?php echo $_FirstPic['tg_name'] ?>" />
	</a>
</div>
<?php
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>