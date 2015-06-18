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
        
        <a href="<?=base_url()?>index.php/home/school/listsadd?sid=<?=$sid?>">
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
<ol class="breadcrumb">
  <li><a href="<?=base_url()?>index.php/home/school">品牌学堂</a></li>
  <li class="active">内容列表</li>

</ol>

<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th>ID</th>    
        <th>标题</th>
        <th>配图</th>
        <th>作者</th>
        <th>简介</th>
        <th>创建时间</th>
        <th>管理操作</th>
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr>
      <td valign="middle"><?=$v['id']?></td>     
      <td valign="middle"><?=$v['title']?></td>
      <td valign="middle">
     
      <?php
        if(!empty($v['img'])){
      ?>
      <img src="<?=base_url()?>uploads/school_lists/<?=$v['img']?>" width="60px" height="60px"/>
      <?php
        }
      ?>
      </td>
      <td valign="middle"><?=$v['author']?></td>
      <td valign="middle"><?=$v['intro']?></td>
      <td valign="middle"><?=date("Y-m-d H:i:s")?></td> 
      <td>
        	
		  <a href="<?=base_url()?>index.php/home/school/listsupdate?id=<?=$v['id']?>">编辑</a> | 
		  <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/school/listsdel?id=<?=$v['id']?>&sid=<?=$v['sid']?>')">删除</a> 
		
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
