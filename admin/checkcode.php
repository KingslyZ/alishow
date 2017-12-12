<?php
header("content-type:text/html;charset=utf8");
/**
 * @Author: Administrator
 * @Date:   2017-10-22 19:02:35
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-23 10:00:05
 */
session_start();
//接收数据
$user_code=$_POST['code'];
//检验验证码
//session中获取
$sys_code=$_SESSION['code'];
// echo $sys_code;
if($user_code != $sys_code){
	echo "验证码错误";
	header("refresh:2;url=login.html");
	die;
}
//检测用户名和密码
$name=$_POST['email'];
$pwd=md5($_POST['pwd']);
//连接数据库
include_once 'include/connect.php';
$sql="select * from ali_user where user_email='$name'";
// die($sql);
$res=mysql_query($sql);
$userInfo=mysql_fetch_assoc($res);
if($userInfo['user_pwd'] != $pwd){
	echo "用户名或密码错误";
	header("refresh:2;url=login.html");
	die;
} else{
	//如果登陆成功 保存用户主要信息到session
	$_SESSION['id']=$userInfo['user_id'];
	$_SESSION['email']=$userInfo['user_email'];
	$_SESSION['nickname']=$userInfo['user_nickname'];
	echo "登陆成功";
	header("refresh:2;url=other/index.php");
	die;
}