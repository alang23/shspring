<?php Widget::head();?>
<script>
function flush(msg,url){
	art.dialog(
		msg, 
		function () {
			
			window.location = url;
		},
		function(){
			
		}
	);
}


</script>
<body>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <a href="<?=base_url()?>index.php/home/member/add">
        <button type="button" class="btn btn-default navbar-btn" >添加</button>
        </a>      </ul>
      <form class="navbar-form navbar-left" role="search" action="#">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="button" class="btn btn-default">Submit</button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<ol class="breadcrumb  definewidth m10">
  <button class="btn btn-primary" type="button">
  会员数量 <span class="badge"><?=$count?></span>
</button>
</ol>

<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>手机</th>
        <th>用户名</th>    
        
        <th>性别</th>
        <th>头像</th>
        <th>注册时间</th>
        <th>账号状态</th>
        <th>管理操作</th>
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr>
    <td valign="middle"><a href="<?=base_url()?>index.php/home/member_info?id=<?=$v['id']?>"><?=$v['phone']?></a></td>
      <td valign="middle"><?=$v['username']?></td>     
      
      <td valign="middle">
     
      <?php
        if($v['gender'] == 1){
      ?>
      男
      <?php
        }elseif($v['gender'] == 2){
      ?>
      女
      <?php
        }else{
      ?>

      未知
      <?php
        }
      ?>
      </td>
      <td valign="middle">
     
      <?php
        if(!empty($v['photo'])){
      ?>
      <img src="<?=base_url()?>uploads/member/<?=$v['photo']?>"  width="40px" height="40px"/>
      <?php
        }
      ?>
      </td>
      <td valign="middle"><?=date("Y-m-d",$v['createtime'])?></td>
      <td valign="middle">
     
      <?php
        if($v['enabled'] == 1){
      ?>
      <span class="label label-success">正常</span>
      <?php
        }else{
      ?>
      <span class="label label-danger">停用</span>
      <?php
        }
      ?>
      </td>  
      <td>
        	
		  <a href="<?=base_url()?>index.php/home/member/update?id=<?=$v['id']?>">编辑</a> | 
		  <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/member/del?id=<?=$v['id']?>')">删除</a> 
		
    </td>
    </tr>

	<?php
	}
	?>
	<tr>
        <td colspan="8"><?=$page?></td>
    </tr>
</table>

</body>
</html>
