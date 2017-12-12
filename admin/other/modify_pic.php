<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-25 19:04:14
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 19:08:22
 */
//接收数据
$id=$_POST['id'];
$name=$_POST['name'];
// echo $id;
//连接数据库
include_once '../include/connect.php';
$sql="update ali_pic set pic_state='$name' where pic_id=$id";
// die($sql);
mysql_query($sql);
$num=mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}