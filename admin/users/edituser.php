<?php

/**
 * @Author: Administrator
 * @Date:   2017-10-22 12:25:16
 * @Last Modified by:   Administrator
 * @Last Modified time: 2017-10-22 19:49:02
 */
include_once '../include/checksession.php';
//接收数据
$id=$_GET['id'];
// echo $id;
include_once '../include/connect.php';
$sql="select * from ali_user where user_id=$id";
// die($sql);
$res=mysql_query($sql);
$userInfo=mysql_fetch_assoc($res);
?>
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
 <div class="col-md-4">
    <form id="mainform">
      <h2>编辑新用户</h2>
      <!-- 隐藏域传id -->
      <input type="hidden" name="id" value="<?=$userInfo['user_id']?>">
      <div class="form-group">
        <label for="email">邮箱</label>
        <input id="email" class="form-control" name="email" type="email" value="<?=$userInfo['user_email']?>">
      </div>
      <div class="form-group">
        <label for="slug">别名</label>
        <input id="slug" class="form-control" name="slug" type="text" value="<?=$userInfo['user_slug']?>">
        <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
      </div>
      <div class="form-group">
        <label for="nickname">昵称</label>
        <input id="nickname" class="form-control" name="nickname" type="text"value="<?=$userInfo['user_nickname']?>">
      </div>
      <div class="form-group">
        <label for="password">密码</label>
        <input id="password" class="form-control" name="password" type="text" value="<?=$userInfo['user_pwd']?>">
      </div>
      <div class="form-group">
        <input type="button" value="修改" class="btn btn-primary">
      </div>
    </form>
</div>
<script src="../../assets/vendors/jquery/jquery.js"></script>
<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script src="../../assets/layer/layer.js"></script>
<script type="text/javascript">
	$(".btn-primary").click(function(){
		//点击修改按钮，就提交到modifyuser.php页面  表单提交使用$.ajax()
		//获取表单数据
		var fm=$("#mainform")[0];
		var fd=new FormData(fm);
		$.ajax({
			url:'modifyuser.php',
			type:'post',
			data:fd,
			dataType:'text',
			contentType:false,
			processData:false,
			success:function(msg){
				if(msg==1){
					alert("修改成功");
				}else{
					alert("修改失败");
				}
				//关闭弹出层
		      var name = parent.layer.getFrameIndex(window.name);
		      parent.layer.close(name);
		      parent.location.reload();//重载页面(users.php重载)
			}
		})
		
	})

</script>
