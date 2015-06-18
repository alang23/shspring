<?php Widget::head();?>
<body>
	

<form name="form1" class="form-inline" method="post" action="<?=base_url()?>index.php/home/school/update" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>
    <tr>
        <td class="tableleft">栏目名称</td>   
        <td><input type="text" name="title" value="<?=$info['title']?>"/></td>      
    </tr>
    <tr>
        <td class="tableleft">图片</td>   
        <td>
        <input type="file" name="userfile" />
        <?php
          if(!empty($info['img'])){
        ?>
        <img src="<?=base_url()?>uploads/school/<?=$info['img']?>" />
        <?php
          }
        ?>
        </td>      
    </tr>

    <tr>
  <td class="tableleft">顺序</td>       
  <td colspan="2">
         <input type="text" name="rank" class="form-control" value="<?=$info['rank']?>"/>
  </td>
  </tr>

    <tr>
    <input type="hidden" name="id" value="<?=$info['id']?>" />
	 	<td colspan="4"><input type="submit" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
