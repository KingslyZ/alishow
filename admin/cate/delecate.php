<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-20 11:42:17
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:46:10
 */
header("content-type:text/html;charset=utf8");
include_once '../include/checksession.php';

//接收数据
$id=$_GET['id'];
// die($id);
include '../include/connect.php';
$sql="delete from ali_cate where cate_id=$id";
mysql_query($sql);
$num=mysql_affected_rows($link);
if($num>0){
	echo "删除成功";
	header("refresh:2;url=categories.php");
} else{
	echo "删除失败";
	header("refresh:2;url=categories.php");
}