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
        
        <a href="<?=base_url()?>index.php/home/taken/add">
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
  街拍数 <span class="badge"><?=$count?></span>
</button>
</ol>
<table class="table table-bordered table-striped definewidth m10">
    <thead>
    <tr>

        <th>ID</th>
      
         <th >照片</th>
         <th >标题</th>
        <th>浏览数</th>
        <th>发布者</th>
        <th>管理操作</th>
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr>
        <td valign="middle"><?=$v['id']?></td>     
         <td valign="middle"><img src="<?=base_url()?>uploads/taken/<?=$v['img']?>" width="40px" height="40px"/></td>
       <td valign="middle"><?=$v['title']?></td>  
       <td valign="middle"><?=$v['total']?></td> 
        <td valign="middle"><?=$v['username']?></td> 
      <td>
        	
		<a href="<?=base_url()?>index.php/home/taken/update?id=<?=$v['id']?>">编辑</a> | 
		<a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/taken/del?id=<?=$v['id']?>')">删除</a> 
		
    </td>
    </tr>

	<?php
	}
	?>
	<tr>
        <td colspan="7">
                    <nav>       
            <ul class="pagination">
               <?=$page?>
            </ul>
          </nav>
        </td>
    </tr>
</table>

</body>
</html>
