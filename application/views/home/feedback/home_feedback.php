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
        

      </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<ol class="breadcrumb">
  <li>意见反馈</li>
  
</ol>

<form name="form2" method="post" action="<?=base_url()?>index.php?d=home&c=aboutsys&m=rank">
<table class="table table-bordered table-striped definewidth m10">
    <thead>
    <tr>

        <th>ID</th>      
        <th>用户</th>
        <th>内容</th>
        <th>时间</th>
        <th>处理</th>
        <th>管理操作</th>
    </tr>
    </thead>
	<?php
		foreach($list as $k => $v){
	?>
    <tr>
	 	<td><?=$v['id']?></td>   
    <td><?=$v['username']?></td>      
		<td><?=$v['content'] ?></td>   
    <td><?=date("Y-m-d H:i:s",$v['createtime'])?></td> 
    <td><?=$v['respond']?></td> 
              
        <td width="113" valign="middle"><a href="<?=base_url()?>index.php?d=home&c=feedback&m=update&id=<?=$v['id']?>">编辑</a> |
          
            <a href="javascript:void(0);" onClick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php?d=home&c=feedback&m=del&id=<?=$v['id']?>');">删除</a> 
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
</form>
</body>
</html>
