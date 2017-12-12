<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-22 19:38:03
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 08:19:18
 */
//防跳墙访问
session_start();
// var_dump($_SESSION);//有验证码
if(empty($_SESSION['id'])){
	echo "您尚未登陆,请先登录";
	header("refresh:2;url=../login.html");
	die;
}
