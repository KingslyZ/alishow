<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-23 19:23:47
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 14:14:18
 */
//接收数据
$id=$_POST['id'];
// echo $id;
include '../include/connect.php';
$seSql="select post_file from ali_post where post_id=$id";
// die($seSql);
$seRes=mysql_query($seSql);
$post_file=mysql_fetch_assoc($seRes)['post_file'];
$sql="delete from ali_post where post_id=$id";
// die($sql);
mysql_query($sql);
$num=mysql_affected_rows($link);
if($num > 0){
	echo 1;
	unlink($post_file);
} else{
	echo 2;
}