<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php 
    include_once '../include/nav.php';
    include_once '../include/checksession.php';
    include_once '../include/connect.php';
    //循环显示分类，美奇迹
    $cateSql="select * from ali_cate";
    $cateRes=mysql_query($cateSql);
    //循环显示数据   ----- 分类选择
    //接收分类
    $cate=isset($_GET['cateid']) ? $_GET['cateid'] : 0;
    $state=isset($_GET['state']) ? $_GET['state'] : 0;
    //设置where条件
    //分页
    $pageno=isset($_GET['pageno']) ? $_GET['pageno']:1;
    $pagesize=3;
    $start=($pageno-1) * $pagesize;
    $where="";
    if($cate != 0){
        $where.="cate_id=$cate and ";
    }
    if($state != 0){
        $where.="post_state=$state and ";
    }
    $where.=1;
    $sql="select post_id,post_title,user_nickname,cate_name,post_updtime,post_state from ali_post p 
      join ali_user u on p.post_author=u.user_id
      join ali_cate c on p.post_cateid=c.cate_id
      where $where limit $start,$pagesize;
    ";
    // die($sql);
    $res=mysql_query($sql);
    // die($res);
    ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline" action="posts.php" method="get">
          <select name="cateid" class="form-control input-sm">
            <option value="0">所有状态</option>
            <?php while($row = mysql_fetch_assoc($cateRes)):?>
            <option value="<?=$row['cate_id'];?>"><?=$row['cate_name'];?></option>
          <?php endwhile;?>
          </select>
          <select name="state" class="form-control input-sm">
            <option value="0">所有状态</option>
            <option value="2">草稿</option>
            <option value="1">已发布</option>
          </select>
          <input type="submit" class="btn btn-default btn-sm" value="筛选">
        </form>
        <ul class="pagination pagination-sm pull-right">
        <?php 
        //分页循环显示注意加上条件
        $countSql="select count(post_id) num from ali_post p 
        join ali_user u on p.post_author=u.user_id
        join ali_cate c on p.post_cateid=c.cate_id
        where $where
        ";
        $countRes=mysql_query($countSql);
        $countArr=mysql_fetch_assoc($countRes);
        $count=$countArr['num'];
        // echo $count;
        $pages=ceil($count/$pagesize);
        // echo $pages;
        if($pageno <=1){
            $prev=1;
        }else{
          $prev=$pageno-1;
        }
         if($pageno >=$pages){
            $next=$pages;
        }else{
          $next=$pageno+1;
        }
        ?>
        <!-- 添加首页 -->
          <li><a href="posts.php?pageno=1&state=<?=$state?>&cateid=<?=$cate?>">首页</a></li>
          <li><a href="posts.php?pageno=<?=$prev?>&state=<?=$state?>&cateid=<?=$cate?>">上一页</a></li>
          <?php for($i=1;$i<=$pages;$i++):?>
          <li><a href="posts.php?pageno=<?=$i?>&state=<?=$state?>&cateid=<?=$cate?>"><?=$i?></a></li>
          <?php endfor;?>
          <li><a href="posts.php?pageno=<?=$next?>&state=<?=$state?>&cateid=<?=$cate?>">下一页</a></li>
          <!-- 添加尾页 -->
          <li><a href="posts.php?pageno=<?=$pages?>&state=<?=$state?>&cateid=<?=$cate?>">尾页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row = mysql_fetch_assoc($res)):?>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><?=$row['post_title']?></td>
            <td><?=$row['user_nickname']?></td>
            <td><?=$row['cate_name']?></td>
            <td class="text-center"><?=date('Y/m/d',$row['post_updtime'])?></td>
            <td class="text-center"><?=$row['post_state']?></td>
            <td class="text-center">
              <a href="editpost.php?id=<?=$row['post_id']?> " class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" data="<?=$row['post_id']?>" class="delpost btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php endwhile;?>
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
   <?php include_once '../include/aside.php';?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
  $(".delpost").click(function(){
    var _this=$(this);
    // alert(1);
    var id=$(this).attr('data');
    $.post("delpost.php",{'id':id},function(msg){
      if(msg==2){
          alert('删除失败');
      } else{
        alert('删除成功');
        _this.parent().parent().remove();
      }
    })
  })
  </script>
</body>
</html>
