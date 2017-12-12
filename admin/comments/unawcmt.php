<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-25 19:23:31
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 19:26:47
 */
//接收数据
$id=$_POST['id'];
// echo $id;
//连接数据库
include_once '../include/connect.php';
$sql="update ali_comment set cmt_state='驳回' where cmt_id in ($id)";
// die($sql);
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
} else{
	echo 2;
}