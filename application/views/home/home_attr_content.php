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
        <a href="<?=base_url()?>index.php/home/attr_content/add?attr_id=<?=$attr_id?>">
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
<ol class="breadcrumb  definewidth m10">
  <li>产品属性列表</li>
  
</ol>

<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th>ID</th>
       <th >属性名</th>
         <th>属性值</th>
        <th>管理操作</th>
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr>
        <td valign="middle"><?=$v['id']?></td>    
          <td valign="middle"><?=$v['attr_name']?></td> 
          <?php
            if($typeid == 1){
          ?>
         <td valign="middle"><?=$v['attr_value']?></td>
         <?php
          }elseif($typeid == 2){
         ?>
         <td valign="middle"><img src="<?=base_url()?>uploads/attribute/<?=$v['attr_pic']?>" width="40px" height="40px"/></td>
         <?php
          }
         ?>
      <td>
        	
		<a href="<?=base_url()?>index.php/home/attr_content/update?id=<?=$v['id']?>">编辑</a> | 
		<a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/attr_content/del?id=<?=$v['id']?>&attr_id=<?=$v['attr_id']?>')">删除</a> 
		
    </td>
    </tr>

	<?php
	}
	?>
	<tr>
        <td colspan="8">
          
                    <nav>       
            <ul class="pagination">
               <?=$page?>
            </ul>
          </nav>
        </td>
    </tr>
</table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">添加属性</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">属性名称:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary">保存</button>
      </div>
    </div>
  </div>
</div>

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
