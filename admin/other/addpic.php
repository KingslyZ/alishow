<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-25 18:19:14
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 19:09:17
 */
header("content-type:text/html;charset=utf8");
//接收数据
$text=$_POST['text'];
$lk=$_POST['link'];
//接收图片数据
if($_FILES['image']['error']==0){
	$ext =strrchr($_FILES['image']['name'], '.');
	$upfile_path="../uploads/".time().$ext;
	move_uploaded_file($_FILES['image']['tmp_name'], $upfile_path);
}
//连接数据库
include_once '../include/connect.php';
$sql="insert into ali_pic (pic_id,pic_path,pic_txt,pic_link) values (null,'$upfile_path','$text','$lk')";
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	echo "添加成功";
} else{
	echo "添加失败";
}

header("refresh:2;url=slides.php");