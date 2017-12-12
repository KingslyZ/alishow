<?php
header("content-type:image/png");
/**
 * @Author: Administrator
 * @Date:   2017-10-22 16:37:06
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:10:06
 */
//生成验证码
$str='2345678abcdefhklmnpqrstuvwxyz';
$code="";
$len=strlen($str);
for($i=0;$i<4;$i++){
	$code.=$str[rand(0,$len-1)];
}
//保存在session内
session_start();
$_SESSION['code']=$code;
// echo $code; 
//绘制验证码
//1.创建画布
$img = imagecreatetruecolor(100,50);
//2.创建画笔
$red = imagecolorallocate($img,255,0,0);
$green = imagecolorallocate($img,0,255,0);
$blue = imagecolorallocate($img,0,0,255);
$rand1 = imagecolorallocate($img,110,119,120);
$rand1 = imagecolorallocate($img,100,200,50);
//3.填充颜色
imagefill($img,0,0,$green);
//4.绘制验证码
// imagestring($img,7,10,30,"$code",$rand1);
//其他方式绘制验证码
for($i=0;$i<4;$i++){
	imagettftext(
	$img, //画布资源
	rand(15,25), //字体大小，像素
	rand(-30,30), //字体倾斜度
	10 + $i*20, //起始位置x
	30, //起始位置y
	imagecolorallocate($img,rand(0,255),rand(0,100),rand(0,255)), //文字颜色
	'SIMYOU.TTF', //字体
	$code[$i]); //内容
}

//5.显示/保存图片
imagepng($img);
//6.销毁
imagedestroy($img);