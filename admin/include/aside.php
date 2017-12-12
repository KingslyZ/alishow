<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-19 16:26:48
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-26 19:56:20
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="profile">
      <img class="avatar" src="/uploads/avatar.jpg">
      <h3 class="name"><?=$_SESSION['nickname']?></h3>
    </div>
    <ul class="nav">
      <li class="active">
        <a href="/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse">
          <li><a href="/admin/post/posts.php">所有文章</a></li>
          <li><a href="/admin../post/addpost.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
          <li><a href="/admin/cate/addcate.php">添加分类</a></li>
        </ul>
      </li>
      <li>
        <a href="../comments/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="../users/users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="/admin/other/slides.php">图片轮播</a></li>
          <li><a href="/admin/other/settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>	
</body>
</html>