<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-25 19:40:31
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-25 19:45:58
 */
header("content-type:text/html;charset=utf8");
$fp=fopen("e:/aa.text",'w');
$arr=[
'name'=>'alishow',
'descript'=>'阿里百秀',
'important'=>"趣事,科技"
];
$str=implode($arr,',');
fwrite($fp,$str);