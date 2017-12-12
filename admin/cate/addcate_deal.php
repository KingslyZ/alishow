<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-20 10:49:53
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:45:48
 */
header("content-type:text/html;charset=utf8");
include_once '../include/checksession.php';

//接收数据
$name=$_POST['name'];
$slug=$_POST['slug'];
$icon=$_POST['icon'];
$status=$_POST['status'];
$show=$_POST['show'];
// var_dump($_POST);
include_once '../include/connect.php';
$sql="insert into ali_cate values(null,'$name','$slug','$icon','$status','$show')";
// die($sql);
mysql_query($sql);
$num= mysql_affected_rows($link);
if($num>0){
	echo "添加成功";
	header("refresh:2;url=categories.php");
}else{
	echo "添加失败";
	header("refresh:2;url=addcate.php");
}