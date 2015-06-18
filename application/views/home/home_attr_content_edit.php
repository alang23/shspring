<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/attr_content/update" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>
    <tr>
        <td class="tableleft">规格名称</td>       
       <td colspan="2">
         <input type="text" name="attr_name" value="<?=$info['attr_name']?>"> <span class="label label-danger">必填</span>
       </td>
  </tr>
  <?php
    if($info['typeid'] == 1){
  ?>
<tr>
        <td class="tableleft">规格值</td>       
       <td colspan="2">
         <input type="text" name="attr_value" value="<?=$info['attr_value']?>"> <span class="label label-danger">必填</span>
       </td>
  </tr>
  <?php
    }else{
  ?>
    <tr>
        <td>图片</td>   
        <td><input type="file" name="userfile" />
        <img src="<?=base_url()?>uploads/attribute/<?=$info['attr_pic']?>" width="40px" height="40px"/>
        </td>      
    </tr>
<?php
    }
?>
  <td class="tableleft">简介</td>       
       <td colspan="2">
         <textarea name="attr_intro" style="width:600px;height:400px;"><?=$info['attr_intro']?></textarea>
       </td>
  </tr>
    <tr>
        <input type="hidden" name="id" value="<?=$info['id']?>"/>
        <input type="hidden" name="typeid" value="<?=$info['typeid']?>"/>
         <input type="hidden" name="attr_id" value="<?=$info['attr_id']?>"/>
	 	<td colspan="4"><input type="submit" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
