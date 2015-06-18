<?php Widget::head();?>
<body>
	

<form name="form1" class="form-inline" method="post" action="<?=base_url()?>index.php/home/style/add" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>

    <tr>
        <td class="tableleft">图片</td>   
        <td><input type="file" name="userfile" /></td>      
    </tr>

    <tr>
  <td class="tableleft">关联款式</td>       
  <td colspan="2">
         <select class="form-control" name="category_id">
          <option value="0">选择关联款式</option>
          <?php
            foreach($list as $k => $v){
          ?>
           <option value="<?=$v['id']?>"><?=$v['c_name']?></option>
           <?php
            }
           ?>
        </select>
  </td>
  </tr>
    <tr>
  <td class="tableleft">顺序</td>       
  <td colspan="2">
         <input type="text" name="rank" class="form-control"/>
  </td>
  </tr>

    <tr>
	 	<td colspan="4"><input type="submit" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
