<?php
header('Content-Type: text/html;charset=utf-8');
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年12月5日
*===================================================
**/
//获取执行耗时函数，返回当前时间
function _runtime(){
	$_mtime=explode(' ',microtime());
	return $_mtime[1]+$_mtime[0];
}
//弹窗函数，参数为信息内容string
function _alert_back($_alert_info){
	echo "<script type='text/javascript'>alert('$_alert_info');history.back();</script>";
	exit();
}
//跳转函数，参数为信息内容string，跳转地址string
function _location($_alert_info,$_url){
	if (empty($_alert_info)) {
		header('Location:'.$_url);
	}elseif(empty($_url)){
		echo "<script type='text/javascript'>alert('$_alert_info');window.close();</script>";
		die('非法操作！');
	}else{
		echo "<script type='text/javascript'>alert('$_alert_info');location.href='$_url';</script>";
		die('非法操作！');
	}
	
}
//对比uniqid,防止cookie伪造,参数分别为数据库中的uniqid(string),本地cookie中的cookie(string)
function _cmpuniqid($_mysql_uniqid,$_cookie_uniqid){
	if ($_mysql_uniqid !== $_cookie_uniqid) {
		setcookie('username','',time()-1);
		_location('非法操作！','');
	}
}
//创建XML文件，参数为文件名string，写入内容数组
function _set_xml($_xml_file,$_clean){
	$_fp=@fopen('new.xml', 'w');
	if (!$_fp) {
		die('文件不存在！');
	}
	flock($_fp, LOCK_EX);
	$_string='<?xml version="1.0" encoding="utf-8"?>'."\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string='<vip>'."\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<id>{$_clean['id']}</id>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<username>{$_clean['username']}</username>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<sex>{$_clean['sex']}</sex>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<face>{$_clean['face']}</face>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<email>{$_clean['email']}</email>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string="\t<url>{$_clean['url']}</url>\r\n";
	fwrite($_fp, $_string,strlen($_string));
	$_string='</vip>';
	fwrite($_fp, $_string,strlen($_string));
	flock($_fp, LOCK_UN);
	fclose($_fp);
}
//验证码生成函数，参数分别为验证码图像长度int，宽度int，位数int，是否显示黑色边框bool
function _code($_width=75,$_height=25,$_rnd_code=4,$_flag=true){
	//创建随机码,要先给$_nmsg赋值初始化，不然在部分ＰＨＰ版本中会报错
	$_nmsg='';
	for ($i=0; $i < $_rnd_code; $i++) { 
		$_nmsg.=dechex(mt_rand(0,15));
	}
	//保存在session中
	$_SESSION['code']=$_nmsg;
	//创建一张图像
	$_img=imagecreatetruecolor($_width, $_height);
	//白色
	$_white=imagecolorallocate($_img, 255, 255, 255);
	//填充
	imagefill($_img, 0, 0, $_white);
	//黑色,边框
	if ($_flag) {
		$_black=imagecolorallocate($_img, 0, 0, 0);
		imagerectangle($_img, 0, 0, $_width-1, $_height-1, $_black);
	}
	//随机画出6根线条
	for ($i=0; $i < 6; $i++) { 
		$_rnd_color=imagecolorallocate($_img, mt_rand(100,255), mt_rand(100,255), mt_rand(100,255));
		imageline($_img, mt_rand(1,$_width), mt_rand(1,$_height), mt_rand(1,$_width-1), mt_rand(1,$_height-1), $_rnd_color);
		}
	//随机雪花
	for ($i=0; $i < 50; $i++) { 
		$_rnd_color=imagecolorallocate($_img, mt_rand(200,255), mt_rand(200,255), mt_rand(100,255));
		imagestring($_img, 1, mt_rand(5,$_width-5), mt_rand(5,$_height-10), '*', $_rnd_color);
	}
	//输出验证码
	for ($i=0; $i < strlen($_SESSION['code']); $i++) { 
		$_rnd_color=imagecolorallocate($_img, mt_rand(0,100), mt_rand(0,150), mt_rand(0,200));
		imagestring($_img, mt_rand(3,5), $i*$_width/$_rnd_code+mt_rand(1,10), mt_rand(1,$_height/2), $_SESSION['code'][$i], $_rnd_color);
	}
	//输出图形
	header('Content-Type:image/png');
	imagepng($_img);
	//销毁图像
	imagedestroy($_img);
}

//判断验证码是否正确
function _check_code($_first_code,$_end_code){
	//防止恶意注册和跨站攻击
	if (!(strtolower($_first_code)==$_end_code)) {
		_alert_back('验证码输入错误！');
	}
}
//生成sha1加密的唯一标识符,无参数，返回转义后的标识符
function _sha1_uniqid(){
	return sha1(uniqid(rand(),true));
}
//标题截取函数，参数为待截取的字符串string,截取长度int
function _title($_content,$_len=14){
	if (mb_strlen($_content,'utf-8')>$_len) {
		$_content=mb_substr($_content, 0,$_len,'utf-8').'...';
	}
	return $_content;
}
//对字符串进行HTML过滤显示，可以处理字符串和数组
function _html($_string){
	if (is_array($_string)) {
		foreach ($_string as $_key=>$_value) {
			$_string[$_key]=_html($_value);
		}
	}else{
		return htmlspecialchars($_string);
	}
	return $_string;
}
//对数据进行转数字处理，可以处理字符串和数组
function _intval($_string){
	if (is_array($_string)) {
		foreach ($_string as $_key=>$_value) {
			$_string[$_key]=_intval($_value);
		}
	}else{
		return intval($_string);
	}
	return $_string;
}
//判断表单数据是否需要转义，参数为数据库资源Resource，表单数据string，返回转以后的数据
function _mysql_string($_string){
	if (!GPC) {
		if (is_array($_string)) {
			foreach ($_string as $_key=>$_value) {
				$_string[$_key]=_mysql_string($_value);
			}
		}else{
		return addslashes($_string);
		}
	}
	return $_string;
}
//分页逻辑代码，参数为获取总记录数的SQL语句string，每页数量int
function _page($_sql,$_size=10){
	//分页模块
	//取出所有变量，外部可以访问
	global $_page,$_pagessize,$_pagenum,$_pageabsolute,$_num;
	if (isset($_GET['page'])) {
		$_page=$_GET['page'];
		if (empty($_page) || $_page<0 || !is_numeric($_page)) {
			$_page=1;
		}else{
			$_page=intval($_page);
		}
	}else{
		$_page=1;
	}
	$_pagessize=$_size;
	$_num = _num_rows(_query($_sql));
	if ($_num==0) {
		$_pageabsolute=1;
	}else{
		$_pageabsolute=ceil($_num/$_pagessize);
	}
	if ($_page>$_pageabsolute) {
		$_page=$_pageabsolute;
	}
	$_pagenum=($_page-1)*$_pagessize;
}
//分页函数参数为1或者2,1表示数字分页，表示文本分页
function _paging($_type){
	global $_page,$_pageabsolute,$_num;
	if ($_type==1) {
		echo '<div id="page_num">';
			echo '<ul>';
				for ($i=0; $i <$_pageabsolute ; $i++) { 
					if ($_page==($i+1)) {
						echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
					}else{
						echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'">'.($i+1).'</a></li>';
					}
				}
			echo '</ul>';
		echo '</div>';
	}elseif($_type==2){
		echo '<div id="page_text">';
			echo '<ul>';
				echo '<li>'.$_page.'/'.$_pageabsolute.'页 | </li>';
				echo '<li>共有<strong>'.$_num.'</strong>条数据 | </li>';
					if ($_page==1) {
						echo '<li>首页 | </li>';
						echo '<li>上一页 | </li>';
					}else{
						echo '<li><a href="'.SCRIPT.'.php">首页</a> | </li>';
						echo '<li><a href="'.SCRIPT.'.php?page='.($_page-1).'">上一页</a> | </li>';
					}
					if ($_page==$_pageabsolute) {
						echo '<li>上一页 | </li>';
						echo '<li>尾页 | </li>';
					}else{
						echo '<li><a href="'.SCRIPT.'.php?page='.($_page+1).'">下 一页</a> | </li>';
						echo '<li><a href="'.SCRIPT.'.php?page='.$_pageabsolute.'">尾页</a> | </li>';
					}
			echo '</ul>';
		echo '</div>';
	}
}
//清除session
function _session_destroy(){
	session_destroy();
}
//清除cookies
function _unsetcookies(){
	setcookie('username','',time()-1);
	setcookie('uniqid','',time()-1);
	@_session_destroy();
	_location(null,'index.php');
}
?>
