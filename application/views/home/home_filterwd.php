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

      <form class="navbar-form navbar-left" role="search" action="#">
        <div class="form-group">
          <input type="text" class="form-control" id="kw" placeholder="关键词">
        </div>
        <button type="button" class="btn btn-default" onclick="add();">添加</button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<ol class="breadcrumb">
  <li>过滤关键字</li>
   
</ol>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th>ID</th>      
        <th>关键字</th>
        <th>状态</th>
         <th>操作</th>
    </tr>
    </thead>
	<?php
		foreach($list as $k => $v){
	?>
    <tr>
	 	<td><?=$v['id']?></td>   
    <td><?=$v['word']?></td>      
    <td>
      <?php
        if($v['enabled'] == 1){
      ?>
     打开
      <?php
        }else{
      ?>
     关闭
      <?php
      }
      ?>
    </td>
       <td>
       <a href="<?=base_url()?>index.php/home/filterwd/del?id=<?=$v['id']?>">删除</a>
    </td>
    </tr>
	<?php
		}
	?>
    <tr>
	 	<td colspan="4"><?=$page?></td>   
    </tr>
	</table>
<script>
  function add()
  {
      var kw = $("#kw").val();

          var aj = $.ajax( {
              url : '<?=base_url()?>index.php/home/filterwd/add',
              data:{
                 
                  kw : kw,

              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
             
                if(data.errcode == 0){
                    $("#kw").val('');
                   location.reload();
                }else{
                  alert(data.msg);
                }
                                 
              },
              error : function() {alert("ERROR");}
          });
      
  }


</script>
</body>
</html>
