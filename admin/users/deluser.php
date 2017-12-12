<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-22 11:08:19
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:47:07
 */
include_once '../include/checksession.php';
//接收数据
$id=$_POST['id'];
include_once '../include/connect.php';

$sql="delete from ali_user where user_id=$id";
// die($sql);
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
} else{
	echo 2;
}