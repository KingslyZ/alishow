<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-20 20:18:30
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:47:31
 */
include_once '../include/checksession.php';
//接收数据
$email=$_POST['email'];
$slug=$_POST['slug'];
$nickname=$_POST['nickname'];
$password=md5($_POST['password']);
// echo $password;
//连接数据库
include_once '../include/connect.php';
//编写sql语句
$sql="insert into ali_user values (null,'$email','$slug','$nickname','$password','',1)";
// die($sql);
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
} else{
	echo 2;
}