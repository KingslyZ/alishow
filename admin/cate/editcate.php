<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-20 12:01:08
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:46:19
 */
header("content-type:text/html;charset=utf8");
include_once '../include/checksession.php';
$id=$_GET['id'];
// echo $id;
include_once '../include/connect.php';
$sql="select * from ali_cate where cate_id=$id";
// die($sql);
$res=mysql_query($sql);
$cateInfo=mysql_fetch_assoc($res);
// var_dump($cateInfo);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
  <div class="main">
     <?php include_once '../include/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>编辑分类</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
       <div class="col-md-4">
          <form action="modifycate.php" method="post">
          <!-- 隐藏域传递id -->
          <input type="hidden" name="id" value="<?=$cateInfo['cate_id']?>">
            <h2>添加分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称" value="<?=$cateInfo['cate_name']?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug" value="<?=$cateInfo['cate_slug']?>">
            </div>
            <div class="form-group">
              <label for="name">图标</label>
              <input id="name" class="form-control" name="icon" type="text" value="<?=$cateInfo['cate_class']?>">
            </div>
            <div class="form-group">
              <label for="name">状态</label>
              <input id="name"  name="status" type="radio" value=1 <?= $cateInfo['cate_status']==1 ? 'checked':''?>>启用
              <input id="name"  name="status" type="radio" value=2 <?= $cateInfo['cate_status']==2 ? 'checked':''?>>禁用
            </div>
            <div class="form-group">
              <label for="name">是否显示</label>
              <input id="name"  name="show" type="radio" value=1 <?= $cateInfo['cate_show']==1 ? 'checked':''?>>显示
              <input id="name"  name="show" type="radio" value=2 <?= $cateInfo['cate_show']==2 ? 'checked':''?>>不显示
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">修改</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
