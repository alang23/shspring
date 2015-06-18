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
        
        <a href="<?=base_url()?>index.php/home/product/add">
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
  产品数量 <span class="badge"><?=$count?></span>
</button>
</ol>

<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th>产品编号</th>    
        <th>产品名称</th>
        <th>价格</th>
        <th>发布者</th>
        <th>发布时间</th>
        <th>状态</th>
        <th>管理操作</th>
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr>
      <td valign="middle"><?=$v['suk']?></td>     
      <td valign="middle"><?=$v['pro_name']?></td>
      <td valign="middle"><?=$v['price']?></td>
      <td valign="middle"><?=$v['mname']?></td>
      <td valign="middle"><?=date("Y-m-d H:i:s",$v['createtime'])?></td>
      <td valign="middle">
      <?php
        if($v['status'] == 0){
      ?>
      <span class="label label-default">未审核</span>
      <?php
        }elseif($v['status'] == 1){
      ?>
      <span class="label label-success">上架</span>
      <?php
        }elseif($v['status'] == 2){
      ?>
       <span class="label label-warning">审核未通过</span>
      <?php
        }
      ?>
      </td>  
      <td>
        	
		  <a href="<?=base_url()?>index.php/home/product/update?id=<?=$v['id']?>">编辑</a> | 
		  <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/product/del?id=<?=$v['id']?>')">删除</a> 
		
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
