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
        
        <a href="<?=base_url()?>index.php/home/doubt/add">
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
  <li>意见反馈</li>
  
</ol>

<form name="form2" method="post" action="<?=base_url()?>index.php?d=home&c=aboutsys&m=rank">
<table class="table table-bordered table-striped definewidth m10">
    <thead>
    <tr>

        <th>ID</th> 
        <th>栏目</th>     
        <th>问题</th>
        <th>解答</th>
         <th>排序</th>
        <th>管理操作</th>
    </tr>
    </thead>
	<?php
		foreach($list as $k => $v){
	?>
    <tr>
	 	<td><?=$v['id']?></td> 
    <td><?=$v['tag']?></td>    
    <td><?=$v['question']?></td>   
     <td><?=$v['answer']?></td>     
		<td><?=$v['rank'] ?></td>   
              
        <td width="113" valign="middle"><a href="<?=base_url()?>index.php?d=home&c=boubt&m=update&id=<?=$v['id']?>">编辑</a> |
          
            <a href="javascript:void(0);" onClick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php?d=home&c=feedback&m=del&id=<?=$v['id']?>');">删除</a> 
          </td>
    </tr>
	<?php
		}
	?>
    <tr>
      
	 	<td colspan="6">
     
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
