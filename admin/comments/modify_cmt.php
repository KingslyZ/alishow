<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-25 17:57:25
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 18:07:57
 */
//接收数据
$id=$_POST['ids'];
//连接数据库
include_once '../include/connect.php';
$sql="update ali_comment set cmt_state='批准' where cmt_id in ($id)";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo 1;
}else{
	echo 2;
}