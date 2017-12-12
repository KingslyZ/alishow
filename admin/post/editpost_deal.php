<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-25 12:42:02
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 14:13:03
 */
header("content-type:text/html;charset=utf8");
include_once '../include/checksession.php';
include_once '../include/connect.php';
//接收数据
$id=$_POST['id'];
$title=$_POST['title'];
$content=$_POST['content'];
$slug=$_POST['slug'];
$category=$_POST['category'];
$created=$_POST['created'];
$status=$_POST['status'];
//单独接收文件
$upfile_path="";
$oldFile='';
if($_FILES['feature']['error']==0){
	$ext = strrchr($_FILES['feature']['name'], '.');
	$upfile_path="../uploads/".time().rand(100,999).$ext;
	move_uploaded_file($_FILES['feature']['tmp_name'], $upfile_path);

	//注意需要删除旧文件  上传新文件才删除旧文件
	$fileSql="select post_file from ali_post where post_id=$id";
	// die($fileSql);
	$fileRes=mysql_query($fileSql);
	// die($fileRes);
	$file=mysql_fetch_assoc($fileRes);
	$oldFile=$file['post_file'];
	// die($oldFile);
}
$upfile="";
if($upfile_path != ""){
	$upfile=",post_file='$upfile_path'";
}
//修改
$sql="update ali_post set post_title='$title',post_slug='$slug',post_content='$content',post_cateid='$category',
	post_updtime='$created',post_state='$status' $upfile where post_id=$id";
	// die($sql);
mysql_query($sql);
$num = mysql_affected_rows($link);
if($num > 0){
	if($oldFile != ''){
		unlink($oldFile);
	}	
	echo "修改文章成功";
	header("refresh:2;url=posts.php");
} else{
	echo "修改文章失败";
	header("refresh:2;url=editpost.php");
}