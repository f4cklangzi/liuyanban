<?php
header('Content-Type: text/html;charset=utf-8');
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
//验证唯一标识符，参数为表单提交值string，页面生成值string
function _check_uniqid($_frist_uniqid,$_end_uniqid){
	if ((strlen($_frist_uniqid)!=40) || ($_frist_uniqid!=$_end_uniqid)) {
		_alert_back('验证信息出错，禁止非法提交！');
	}
	return _mysql_string($_frist_uniqid);
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
	$_char_pattern='/[<>\'\"\ ]/';
	if (preg_match($_char_pattern, $_username)) {
		_alert_back('用户名不得包含敏感字符！');
	}
	//限制敏感用户名
    global $_system;
    $_mg=explode('|',$_system['string']);
	//采用绝对匹配
    foreach ($_mg as $_key){
        if (preg_match('/'.$_key.'/',$_username)){
            _alert_back('禁止使用敏感用户名！');
        }
    }
	//转义
	return _mysql_string($_username);
}
//验证密码，参数分别为密码string、确认密码string、密码最小长度int
function _check_password($_first_pass,$_end_pass,$min=6){
	//去掉空格
	$_first_pass=trim($_first_pass);
	$_end_pass=trim($_end_pass);
	//判断密码长度
	if (strlen($_first_pass)<$min) {
		_alert_back('密码不得小于'.$min.'位！');
	}
	//密码和密码确认必须一致
	if ($_first_pass!=$_end_pass) {
		_alert_back('两次输入的密码必须一致！');
	}
	//返回加密后的密码
	return sha1($_first_pass);
}
//验证密码，参数分别为密码string、密码最小长度int
function _check_modify_password($_pass,$min=6){
	if (!empty($_pass)) {
		//去掉空格
		$_pass=trim($_pass);
		//判断密码长度
		if (strlen($_pass)<$min) {
		_alert_back('密码不得小于'.$min.'位！');
	}
	//返回加密后的密码
	return sha1($_pass);
	}
}
//密码提问验证，参数分别为密码提示string、最小长度int、最大长度int
function _check_question($_question,$min=4,$max=20){
	//去掉空格
	$_question=trim($_question);
	//长度小于4位或者大于20位不通过
	if (mb_strlen($_question,'utf-8')<$min || mb_strlen($_question,'utf-8')>$max) {
		_alert_back('密码提示长度必须在'.$min.'和'.$max.'之间！');
	}
	//转义
	return _mysql_string($_question);
}
//密码回答验证
function _check_answer($_question,$_answer,$min=4,$max=20){
	//去掉空格
	$_question=trim($_question);
	$_answer=trim($_answer);
	//长度小于4位或者大于20位不通过
	if (mb_strlen($_answer,'utf-8')<$min || mb_strlen($_answer,'utf-8')>$max) {
		_alert_back('密码回答长度必须在'.$min.'和'.$max.'之间！');
	}
	//密码提示和密码回答确认不得一致
	if ($_question==$_answer) {
		_alert_back('密码提示和密码回答不得相同！');
	}
	//加密返回
	return sha1($_answer);
}
//验证性别,参数为性别值
function _check_sex($sex){
	return _mysql_string($sex);
}
//验证头像取值,参数为头像值
function _check_face($face){
	return _mysql_string($face);
}
//验证邮件,参数为邮件地址string,最小位数int,最多位数int
function _check_email($email,$min,$max){
	//去掉空格
	$email=trim($email);
	if (!preg_match("/^[\w\-\.]+@[\w-.]+(\.\w+)+$/", $email)) {
		_alert_back('邮箱地址不合法！');
	}
	if (strlen($email)<$min || strlen($email)>$max) {
		_alert_back('邮件长度不合法！');
	}
	return _mysql_string($email);
}
//QQ验证,参数为QQ号码int
function _check_qq($qq){
	//去掉空格
	$qq=trim($qq);
	if (empty($qq)) {
		return null;
	}
	if (!preg_match("/^[1-9]{1}[\d]{4,10}$/", $qq)) {
		_alert_back('QQ不合法！');
	}
	return _mysql_string($qq);
}
//url验证，参数为url
function _check_url($url,$max){
	//去掉空格
	$url=trim($url);
	if (empty($url) || ($url=='http://')) {
		return null;
	}
	if (!preg_match("/^((http|ftp|https):\/\/)?[\w\-_]+(\.[\w\-_\/]+)+$/", $url)) {
		_alert_back('网址不合法！');
	}
	if (strlen($url)>$max) {
		_alert_back('网址太长！');
	}
	return _mysql_string($url);
}
//验证发信内容
function _check_content($_content,$min=1,$max=200){
	//去掉空格
	$_content=trim($_content);
	//长度小于1位或者大于200位不通过
	if (mb_strlen($_content,'utf-8')<$min || mb_strlen($_content,'utf-8')>$max) {
		_alert_back('信息长度必须在'.$min.'和'.$max.'之间！');
	}
	return _mysql_string($_content);
}
?>