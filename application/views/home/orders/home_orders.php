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
        
        <a href="<?=base_url()?>index.php/home/hongbao/add">
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

        <th>订单编号</th>    
        <th>会员</th>
        <th>总额</th>
        <th>配送</th>
        <th>发票</th>
        <th>状态</th>
        <th>管理操作</th>
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr>
      <td valign="middle"><a href="<?=base_url()?>index.php/home/orders/detail?id=<?=$v['id']?>"><?=$v['no']?></a></td>     
      <td valign="middle"><?=$v['username']?></td>
      <td valign="middle"></td>
      <td valign="middle"><?=exp_type($v['exp'])?></td>
      <td valign="middle"><?=invoice_type($v['invoice'])?></td>
      <td valign="middle"><?=order_status($v['status'])?></td>  
      <td>
        	
		  <a href="<?=base_url()?>index.php/home/orders/update?id=<?=$v['id']?>">编辑</a> | 
		  <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗?','<?=base_url()?>index.php/home/orders/del?id=<?=$v['id']?>')">删除</a> 
		
    </td>
    </tr>

	<?php
	}
	?>
	<tr>
        <td colspan="8">
        <!--<?=$page?> -->
          <nav>
         
            <ul class="pagination">
             <!--
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              -->
               <?=$page?>
            </ul>
          </nav>
        </td>
    </tr>
</table>

</body>
</html>
