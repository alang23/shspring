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

<ol class="breadcrumb  definewidth m10">
  <li>颜色</li>
  
</ol>
<form name="form1" method="post" action="<?=base_url()?>index.php/home/cortex/relation">
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th>ID</th>
        <th>属性值</th>
       <th >颜色名称</th>
         
    
    </tr>
    </thead>

	<?php
		foreach($list as $k => $v){
	?>
    <tr <?php if(in_array($v['id'],$ids)){ ?> style="background:#CCCCCC" <?php } ?>>
        <td valign="middle"><input type="checkbox" name="ids[]" value="<?=$v['id']?>" <?php if(in_array($v['id'],$ids)){ ?> checked <?php } ?>/></td>  
        <td valign="middle"><img src="<?=base_url()?>uploads/attribute/<?=$v['attr_pic']?>" width="40px" height="40px"/></td>  
        <td valign="middle"><?=$v['attr_name']?></td>            
    </tr>

	<?php
	}
	?>
	<tr>
        <input type="hidden" name="id" value="<?=$id?>" />
        <td colspan="4"><input type="submit" class="btn btn-primary" value="保存"/></td>
    </tr>
</table>

</form>

</body>
</html>
