<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/attr_content/add" enctype="multipart/form-data"/>
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
    <tr>
        <td>图片</td>   
        <td><input type="file" name="userfile" /><img src="<?=base_url()?>uploads/attribute/<?=$info['attr_pic']?>" width="40px" height="40px"/></td>      
    </tr>

    <tr>
        <input type="hidden" name="attr_id" value="<?=$attr_id?>"/>
        <input type="hidden" name="typeid" value="<?=$typeid?>"/>
	 	<td colspan="4"><input type="submit" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
