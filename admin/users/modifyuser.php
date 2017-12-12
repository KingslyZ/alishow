<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-22 12:39:53
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:47:41
 */
include_once '../include/checksession.php';
//接收edituser.php传来的数据
$id=$_POST['id'];
$email=$_POST['email'];
$slug=$_POST['slug'];
$nickname=$_POST['nickname'];
$password=md5($_POST['password']);
// echo $slug;
include_once '../include/connect.php';
$sql="update ali_user set user_email='$email',user_slug='$slug',user_nickname='$nickname' where user_id=$id";
// die($sql);
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
} else{
	echo 2;
}