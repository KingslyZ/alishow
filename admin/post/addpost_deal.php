<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-23 13:09:15
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-26 15:31:54
 */
header("content-type:text/html;charset=utf8");
include_once '../include/checksession.php';
//接收数据
$title=$_POST['title'];
$content=$_POST['content'];
$slug=$_POST['slug'];
$category=$_POST['category'];
$created=strtotime($_POST['created']);
$status=$_POST['status'];
//其他数据，手动添加
//文章摘要
$desc=substr($content,0,300);
//作者，从session获取
$author=$_SESSION['id'];
//修改时间
$updtime=$created;
//点击次数
$click=rand(300,800);
//赞次数
$good=rand(200,300);
//踩次数
$bad=rand(5,20);
//单独处理文件
$upfile_path="null";
if($_FILES['feature']['error']==0){
	$ext = strrchr($_FILES['feature']['name'],".");
	$upfile_path="../uploads/".time().$ext;
	move_uploaded_file($_FILES['feature']['tmp_name'], $upfile_path);
}
// die($upfile_path);
//连接数据库
include_once '../include/connect.php';
$sql="insert into ali_post values(null,'$title','$slug','$desc','$content',
	$author,$category,'$upfile_path',$created,$updtime,$click,$good,$bad,$status)";
// die($sql);
mysql_query($sql);
$num=mysql_affected_rows($link);
if($num > 0){
	echo "插入成功";
	header("refresh:2;url=posts.php");
}else{
	echo "插入失败";
	header("refresh:2;url=addpost.php");
}