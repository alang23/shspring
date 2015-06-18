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
         <input type="text" name="attr_name"> <span class="label label-danger">必填</span>
       </td>
  </tr>
    <tr>
        <td>图片</td>   
        <td><input type="file" name="userfile" /></td>      
    </tr>
  <td class="tableleft">简介</td>       
       <td colspan="2">
         <textarea name="attr_intro" style="width:600px;height:400px;"></textarea>
       </td>
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
