<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/attribute/update" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>
    <tr>
        <td class="tableleft">属性名称</td>       
       <td colspan="2">
         <input type="text" name="name" value="<?=$info['name']?>"> <span class="label label-danger">必填</span>
       </td>
  </tr>
        <tr>
        <td class="tableleft">类型</td>       
       <td colspan="2">
              <?php
                if($info['typeid'] == 1){
                  echo '文字';
                }elseif($info['typeid'] == 2){
                  echo '图片';
                }else{
                  echo '未知';
                }
              ?>
       </td>
  </tr>

    <tr>
        <input type="hidden" name="id" value="<?=$info['id']?>"/>
	 	<td colspan="4"><input type="submit" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
