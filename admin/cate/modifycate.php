<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-20 12:46:17
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:46:23
 */
header("content-type:text/html;charset=utf8");
include_once '../include/checksession.php';
//接收数据
// $id=$_GET['id'];
$id=$_POST['id'];
$name=$_POST['name'];
$slug=$_POST['slug'];
$icon=$_POST['icon'];
$status=$_POST['status'];
$show=$_POST['show'];
// die($id);
include_once '../include/connect.php';
$sql="update ali_cate set cate_name='$name',cate_slug='$slug',cate_class='$icon',
cate_status='$status',cate_show='$show' where cate_id = $id";
// die($sql);
mysql_query($sql);
$num=mysql_affected_rows($link);
if($num > 0){
	echo '修改成功';
	header("refresh:2;url=categories.php");
} else{
	echo '修改失败';
	header("refresh:2;url=editcate.php?id=".$id);
}
