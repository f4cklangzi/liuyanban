<?php
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2015年12月5日
*===================================================
**/
//防止恶意调用
if (!defined('IN_TG')) {
	die('Access Defined!');
}
//设置cookie
function _setcookies($_username,$_uniqid,$_time){
	switch ($_time) {
		case '0'://浏览器进程
			setcookie('username',$_username);
			setcookie('uniqid',$_uniqid);
			break;
		case '1'://1天
			setcookie('username',$_username,time()+86400);
			setcookie('uniqid',$_uniqid,time()+86400);
			break;
		case '2'://1周
			setcookie('username',$_username,time()+604800);
			setcookie('uniqid',$_uniqid,time()+604800);
			break;
		case '3'://1月
			setcookie('username',$_username,time()+2592000);
			setcookie('uniqid',$_uniqid,time()+2592000);
			break;	
	}
}
//验证用户名，参数分别为原始值string,最小长度int，最大长度int
function _check_username($_username,$min=2,$max=20){
	//去掉空格
	$_username=trim($_username);
	//长度小于两位或者大于二十位不通过
	if (mb_strlen($_username,'utf-8')<$min || mb_strlen($_username,'utf-8')>$max) {
		_alert_back('用户名长度必须在'.$min.'和'.$max.'之间！');
	}
	//限制敏感字符
	$_char_pattern='/[<>\'\"\ \　]/';
	if (preg_match($_char_pattern, $_username)) {
		_alert_back('用户名不得包含敏感字符！');
	}
	//转义
	return _mysql_string($_username);
}
//验证密码，参数分别为密码string、密码最小长度int
function _check_password($_pass,$min=6){
	if (is_array($_pass)) {
		_location('非法参数！','');
	}
	//去掉空格
	$pass=trim($_pass);
	//判断密码
	if (strlen($_pass)<$min) {
		_alert_back('密码不得小于'.$min.'位！');
	}
	//返回加密后的密码
	return sha1($_pass);
}
//验证保留时间
function _check_time($_time){
	//采用绝对匹配
	$_time_clean = array('0','1','2','3');
	if (!in_array($_time, $_time_clean)) {
		_alert_back('禁止提交非法参数！');
	}
	return _mysql_string($_time);
}
?>