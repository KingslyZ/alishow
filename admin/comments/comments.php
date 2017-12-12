<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
  <script src="../../assets/vendors/jquery/jquery.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php 
      include_once '../include/checksession.php';
      include_once '../include/nav.php';
      include_once '../include/connect.php';
      //查询数据循环显示
      $pageno=isset($_GET['pageno'])?$_GET['pageno']:1;
      $pagesize=3;
      $start=($pageno-1)*$pagesize;
      $sql="select cmt_id,cmt_content,cmt_time,cmt_state,member_nickname,post_title from ali_comment c 
          join ali_member m on c.cmt_memid=m.member_id
          join ali_post p on c.cmt_postid=p.post_id
          limit $start,$pagesize
      ";
      $res=mysql_query($sql);
    ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: block">
          <button id="allow" class="btn btn-info btn-sm">批量批准</button>
          <button id="unallow" class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <?php
            $countSql="select count(*) num from ali_comment c
              join ali_member m on c.cmt_memid=m.member_id
              join ali_post p on c.cmt_postid=p.post_id
            ";
            $countRes=mysql_query($countSql);
            $countArr=mysql_fetch_assoc($countRes);
            $count=$countArr['num'];
            $pages=ceil($count/$pagesize);
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
           <li><a href="comments.php?pageno=1">首页</a></li>
           <li><a href="comments.php?pageno=<?=$prev?>">上一页</a></li>
          <?php for($i=1;$i<=$pages;$i++):?>
          <li><a href="comments.php?pageno=<?=$i?>"><?=$i?></a></li>
          <?php endfor;?>
          <li><a href="comments.php?pageno=<?=$next?>">下一页</a></li>
          <li><a href="comments.php?pageno=<?=$pages?>">尾页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row = mysql_fetch_assoc($res)):?>
          <tr class="danger">
            <td class="text-center"><input type="checkbox" value="<?=$row['cmt_id']?>"></td>
            <td><?=$row['member_nickname']?></td>
            <td><?=$row['cmt_content']?></td>
            <td><?=$row['post_title']?></td>
            <td><?=date('Y/m/d',$row['cmt_time'])?></td>
            <td class="state"><?=$row['cmt_state']?></td>
            <td class="text-center">
              <?php if($row['cmt_state']=='批准'):?>
              <a href="javascript:;" data="<?=$row['cmt_id']?>" class="btn cmtbtn btn-warning btn-xs">驳回</a>
            <?php else:?>
              <a href="javascript:;" data="<?=$row['cmt_id']?>" class="btn cmtbtn btn-info btn-xs">批准</a>
            <?php endif;?>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
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
  <script type="text/javascript">
      $(".cmtbtn").click(function(){
        _this=$(this);
        // alert(123);
        //获取值
        var id=$(this).attr('data');
        var name=$(this).html();
        //修改状态数据
        $.post('editcmt.php',{id:id,name:name},function(msg){
          // alert(msg);
          if(msg==1){
            if(name=='批准'){
              _this.parent().parent().find('.state').html(name);
              _this.removeClass('btn-info');
              _this.addClass('btn-warning');
              _this.html("驳回");
            }else{
                _this.parent().parent().find('.state').html(name);
                _this.removeClass('btn-warning');
                _this.addClass('btn-info');
                _this.html("批准");
            }
            alert("修改成功");
          }else{
           alert("修改失败");
          }
        })
      });
      //批量批准
      $("#allow").click(function(){
        var _this=$(this);
        //获取数据
        var check_list=$(":checkbox:checked");
        // alert(check_list);
        //循环获取id
        var str="";
        check_list.each(function(index,ele){
          str+=ele.value+',';
        })
        //去掉最后的,
        str=str.substr(0,str.length-1);
        // alert(str);
        //数据传到后台
        $.post("modify_cmt.php",{ids:str},function(msg){
          // alert(msg);
          if(msg==1){
              check_list.each(function(index,ele){
              $(this).parent().parent().find('.state').html("批准");
              var tmp=$(this).parent().parent().find('.cmtbtn');
              tmp.removeClass('btn-info').addClass('btn-warning').html("驳回");
            });
              alert("批量批准成功");
          }else{
            alert('批量批准失败');
          }
        })
      });
      //批量拒绝
      $("#unallow").click(function(){
        var _this=$(this);
        var check_list=$(":checkbox:checked");//对象
        var str="";
        check_list.each(function(index,ele){
          str+=ele.value+",";//获取id
        });
        str=str.substr(0,str.length-1);
        // alert(str);字符串形式
        //发送ajax请求
        $.post("unawcmt.php",{id:str},function(msg){
          // alert(msg);
          if(msg==1){
              check_list.each(function(index,ele){
                //ele指的是复选框
                $(ele).parent().parent().find('.state').html("驳回");
                $(ele).parent().parent().find('.cmtbtn').addClass('btn-info').removeClass('btn-warning').html('批准');
              })
          }else{
            alert("批量拒绝失败");
          }
        })
              
      })
  </script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
