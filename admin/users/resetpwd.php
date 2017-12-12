<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-22 20:03:57
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-23 10:07:20
 */
include_once '../include/checksession.php';
header("content-type:text/html;charset=utf8");
//接收数据
$oldpwd=$_POST['oldpwd'];
// echo $oldpwd;
//判断旧密码
//从session中取出
// session_start();
$id=$_SESSION['id'];
include_once '../include/connect.php';
$sql="select * from ali_user where user_id=$id";
// die($sql);
$res=mysql_query($sql);
$userInfo=mysql_fetch_assoc($res);
if(md5($oldpwd) != $userInfo['user_pwd']){
	echo "旧密码不对";
	header("refresh:2;url=../login.html");
	die;
} else{
	//比对两次新密码
	$newpwd=$_POST['newpwd'];
	$re_newpwd=$_POST['re-newpwd'];
	if(!empty($newpwd) && !empty($re_newpwd)){
			if($newpwd != $re_newpwd){
		echo "两次密码不一致";
		header("refresh:2;url=password-reset.php");
		die;
	} else{
		//两次密码一致，修改数据表
		$newpwd=md5($newpwd);
		$sql="update ali_user set user_pwd='$newpwd' where user_id=$id";
		// die($sql);
		mysql_query($sql);
		$num = mysql_affected_rows($link);
		if($num > 0){
			echo "修改成功";
			header("refresh:2;url=../other/index.php");
			die;
		} else{
			echo "修改失败";
			header("refresh:2;url=password-reset.php");
			die;
		}
		
	}
} else{
	echo "密码不能为空";
	header("refresh:2;url=password-reset.php");
	die;
}
}