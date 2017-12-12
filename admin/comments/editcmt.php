<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-25 17:37:18
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 17:40:11
 */
$id=$_POST['id'];
$name=$_POST['name'];
// echo $id;
include_once '../include/connect.php';
$sql="update ali_comment set cmt_state='$name' where cmt_id=$id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num>0){
	echo 1;
}else{
	echo 2;
}