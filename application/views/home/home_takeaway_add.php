<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/category/add" enctype="multipart/form-data"/>
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
         <input type="text" name="c_name" > <span class="label label-danger">必填</span>
       </td>
  </tr>
    <tr>
        <td class="tableleft">图片</td>   
        <td><input type="file" name="userfile" /></td>      
    </tr>
    <tr>
        <td class="tableleft">属性</td>   
        <td>
            <?php
                foreach($attr as $k => $v){
            ?>         
              <input type="checkbox" id="attr_<?=$v['id']?>" value="<?=$v['id']?>" name="c_attr[]"> <?=$v['name']?>           
            <?php
            }
            ?>

        </td>      
    </tr>
        <tr>
        <td class="tableleft">简介</td>   
        <td>
            <textarea name="c_intro" class="form-control"></textarea>

        </td>      
    </tr>
    <tr>

	 	<td colspan="4"><input type="submit" class="btn btn-primary" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
