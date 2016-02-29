<?php
header('Content-Type: text/html;charset=utf-8');
/**
*===================================================
*Author:f4ck_langzi@foxmail.com
*Date:2016年1月10日
*===================================================
**/
//防止恶意调用
if (!defined('IN_TG')) {
	die('Access Defined!');
}
//连接数据库函数，无参数
function _connect(){
	//因为函数外部不等访问函数内部变量，所以设置全局变量
	global $_conn;
	if (!$_conn=@mysql_connect(DB_HOST,DB_USER,DB_PWD)) {
		exit('数据库连接失败！');
	}
}
//选择一款数据库
function _select_db(){
	if (!mysql_select_db(DB_NAME)) {
		exit('找不到指定数据库！');
	}
}
function _set_names(){
	if (!mysql_query('SET NAMES UTF8')) {
		exit('字符集错误！');
	}
}
//执行SQL语句，参数为要执行的SQL语句string
function _query($_sql){
	if (!$_result=mysql_query($_sql)) {
		exit('SQL执行失败！'.mysql_error());
	}
	return $_result;
}
//返回根据从结果集取得的行生成的数组,参数为SQL语句string,只能获取一条数据组
function _fetch_array($_sql){
	return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}
//返回根据从结果集取得的行生成的数组,参数为SQL语句string,可以返回指定数据集的所有数据
function _fetch_array_list($_result){
	return mysql_fetch_array($_result,MYSQL_ASSOC);
}
//返回结果集中的记录数，参数为结果集
function _num_rows($_result){
	return mysql_num_rows($_result);
}
//表示影响到的记录数
function _mysql_affected_rows(){
	return mysql_affected_rows();
}
//销毁结果集，参数为结果集
function _free_result($_result){
	mysql_free_result($_result);
}
//获取最近插入数据库的ID
function _insert_id(){
	return mysql_insert_id();
}
//判断SQL语句执行是否有结果集，如果有则弹出信息，参数为SQL语句string，信息string
function _is_repeat($_sql,$_info){
	if (_fetch_array($_sql)) {
		_alert_back($_info);
	}
}
//关闭数据库
function _close(){
	if (!mysql_close()) {
		// exit('数据库关闭异常！');
	}
}
?>