<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-26 12:39:39
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-26 13:11:29
 */
header("content-type:text/html;charset=utf8");
// print_r($_POST);
// die;
//接收数据
$name=$_POST['site_name'];
$desc=$_POST['site_description'];
$keywords=$_POST['site_keywords'];
$status=isset($_POST['comment_status'])?$_POST['comment_status']:0;
$reviewed=isset($_POST['comment_reviewed'])?$_POST['comment_reviewed']:0;
//接收文件
$uppath="";
if($_FILES['logo']['error']==0){
	$ext=strrchr($_FILES['logo']['name'], '.');
	$uppath="../uploads/".time().rand(100,999).$ext;
	move_uploaded_file($_FILES['logo']['tmp_name'], $uppath);
}
//接收旧图片
$old= include_once 'set.conf.php';
$oldPath=$old['set_logo'];
if($uppath != ""){
	unlink($oldPath);
}else{
	$uppath=$oldPath;
}

$str="<?php
	return array(
	'set_logo'=>'{$uppath}',
	'set_name'=>'{$name}',
	'set_desc'=>'{$desc}',
	'set_keywords'=>'{$keywords}',
	'set_cmts'=>$status,
	'set_allow'=>$reviewed
	);";
echo $str;
//修改文件
$fp=fopen('set.conf.php', 'w');
fwrite($fp,$str);
header("refresh:2;url=settings.php");