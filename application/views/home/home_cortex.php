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
        <a href="<?=base_url()?>index.php/home/cortex/add">
        <button type="button" class="btn btn-default navbar-btn" >添加</button>
        </a>
       

      </ul>
      <form class="navbar-form navbar-left" role="search" action="#">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="button" class="btn btn-default">Submit</button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
      <th>ID</th>
      <th>图片</th>
       <th>皮质名称</th>
      <th>顺序</th>
      <th>管理操作</th>
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr>
        <td valign="middle"><?=$v['id']?></td>           
        <td valign="middle"><img src="<?=base_url()?>uploads/cortex/<?=$v['img']?>" width="60px" height="60px"/></td>
        <td valign="middle"><?=$v['title']?>(<a href="<?=base_url()?>index.php/home/cortex/relation?id=<?=$v['id']?>">查看关联</a>)</td>
        <td valign="middle"><?=$v['rank']?></td> 
        <td>
                    
      <a href="<?=base_url()?>index.php/home/cortex/update?id=<?=$v['id']?>">编辑</a> | 
      <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/cortex/del?id=<?=$v['id']?>')">删除</a> 

        </td>
    </tr>

	<?php
	}
	?>
	<tr>
        <td colspan="8"><?=$page?></td>
    </tr>
</table>



<script>
var hostname = "<?=base_url()?>";

 $(".btn-primary").bind("click", function() {
      var name = jQuery.trim($("#name").val());
     
      $(".btn-primary").text("请求中..");
      var aj = $.ajax( {
              url:hostname + 'index.php/home/attribute/add',
              data:{
                  name : name,
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                alert(data.msg);
                if(data.errcode != 0){
                    alert(data.msg);
                     $(".btn-primary").text("保存");
                }else{

                   window.location.reload();
                }

              },
              error : function() {
                  alert("ERROR");
              }
          });
      });
</script>
</body>
</html>
