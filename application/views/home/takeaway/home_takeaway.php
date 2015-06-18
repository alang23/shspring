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
        <a href="<?=base_url()?>index.php/home/takeaway/add">
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
<ol class="breadcrumb">
  <li>自提地址</li>
   
</ol>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th>ID</th>      
        <th>地址</th>
        <th>电话</th>
       <th>操作</th>
    </tr>
    </thead>
	<?php
		foreach($list as $k => $v){
	?>
    <tr>
	 	<td><?=$v['id']?></td>   
    <td><?=$v['address']?></td>      
    <td><?=$v['tel']?></td>
      <td>
       <a href="<?=base_url()?>index.php/home/takeaway/update?id=<?=$v['id']?>">编辑</a> | 
       <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/takeaway/del?id=<?=$v['id']?>')">删除</a> 

     </td>
    </tr>
	<?php
		}
	?>
    <tr>
	 	<td colspan="5">
      <nav>       
            <ul class="pagination">
               <?=$page?>
            </ul>
          </nav>


    </td>   
    </tr>
	</table>
<script>
  function changestatus(cid,status)
  {
          var aj = $.ajax( {
              url : '<?=base_url()?>index.php?d=home&c=region&m=changestatus',
              data:{
                  id : cid,
                  status : status,

              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               // alert(data);
                if(data.err == 0){
                  alert(data.msg);
                   location.reload();
                }
                                 
              },
              error : function() {alert("ERROR");}
          });
      
  }
</script>
</body>
</html>
