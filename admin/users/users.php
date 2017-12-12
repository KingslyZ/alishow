<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/layer/layer.js"></script>
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <!-- 数据库获取数据 -->
  <?php include_once '../include/checksession.php' ?>
  <?php
  include '../include/connect.php';
  //查询数据
  //设置显示的行数  
  $pagesize=3;
  $pageno=isset($_GET['pageno']) ? $_GET['pageno'] : 1;
  $start=($pageno-1) * $pagesize;
  $sql="select * from ali_user limit $start,$pagesize";
  $res=mysql_query($sql);
  ?>
  <script>NProgress.start()</script>
  <div class="main">
     <?php include_once '../include/nav.php' ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input type="button" value="添加用户" onclick="adduser()">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
            <!-- 循环获取数据 -->
            <?php while($row = mysql_fetch_assoc($res)):?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="../../assets/img/default.png"></td>
                <td><?=$row['user_email']?></td>
                <td><?=$row['user_slug']?></td>
                <td><?=$row['user_nickname']?></td>
                <td><?= ($row['user_state']==1) ? '激活' : '未激活'?></td>
                <td class="text-center">
                  <a href="javascript:;" data="<?=$row['user_id']?>" class="edituser btn btn-default btn-xs">编辑</a>
                  <a href="javascript:;" data="<?=$row['user_id']?>" class="deluser btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
            <?php endwhile;?>
            </tbody>
          </table>
             <ul class="pagination pagination-sm pull-right">
             <!-- 设置首页 -->
             <li><a href="users.php?pageno=1">首页</a></li>
              <!-- 设置上一页 -->
              <?php if($pageno<=1){
                $prev=1;
                }else{
                   $prev=$pageno-1;
                } 
              ?>
              <li><a href="users.php?pageno=<?=$prev?>">上一页</a></li>
              <!-- 循环输出 -->
              <?php 
                $countSql="select count(*) num from ali_user";
                $countRes=mysql_query($countSql);
                // die($countRes);//资源型
                $num=mysql_fetch_assoc($countRes)['num'];
                $pages=ceil($num/$pagesize);
              ?>
            <?php for($i=1;$i<=$pages;$i++):?>
              <li><a href="users.php?pageno=<?=$i?>"><?=$i?></a></li>
            <?php endfor;?>
            <!-- 设置下一页 -->
              <?php if($pageno>=$pages){
                $next=$pages;
                }else{
                   $next=$pageno+1;
                }
              ?>
              <li><a href="users.php?pageno=<?=$next?>">下一页</a></li>
                <!-- 设置尾页 -->
             <li><a href="users.php?pageno=<?=$pages?>?>">尾页</a></li>
            </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
   <?php include_once '../include/aside.php' ?>
  </div>

  
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
  function adduser(){
      layer.ready(function(){ 
        layer.open({
          type: 2,
          title: '添加新用户',
          maxmin: true,
          area: ['800px', '600px'],
          content:'addusers.html'
      });
  });
  }
  $(".deluser").click(function(){
    var id=$(this).attr('data');
    // alert(id);
    _this=$(this);
    $.post("deluser.php",{'id':id},function(msg){
      // alert(msg);
      if(msg==1){
        layer.alert("删除成功");
        //删除页面上的该行
        _this.parent().parent().remove();
      } else{
         layer.alert("删除失败");
      }
    });
  });
  $(".edituser").click(function(){
    //点击编辑按钮弹出修改信息layer层 且要传递id信息
    var id=$(this).attr('data');
    layer.ready(function(){
      layer.open({
        type:2,
        title:'编辑用户信息',
        maxmin:true,
        area:['800px','600px'],
        content:'edituser.php?id='+id
      })
    })
  })
  </script>
</body>
</html>
