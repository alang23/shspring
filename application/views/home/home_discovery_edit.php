<?php Widget::head();?>
<body>
	

<form name="form1" class="form-inline" method="post" action="<?=base_url()?>index.php/home/discovery/update" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>

    <tr>
        <td class="tableleft">图片</td>   
        <td><input type="file" name="userfile" />
        <?php
          if(!empty($info['img'])){
        ?>
        <img src="<?=base_url()?>uploads/discovery/<?=$info['img']?>" width="60px" height="60px" />
        <?php
          }
        ?>

        </td>      
    </tr>

    <tr>
  <td class="tableleft">标题</td>       
  <td colspan="2">
    <input type="text" name="title" class="form-control" value="<?=$info['title']?>"/>   
  </td>

  </tr>
      <tr>
  <td class="tableleft">KEY</td>       
  <td colspan="2">
    <select name="d_key">
     <option value="0">对应</option>
      <option value="1" <?php if($info['d_key'] == 1){ ?> selected <?php } ?>>品牌学堂</option>
      <option value="2" <?php if($info['d_key'] == 2){ ?> selected <?php } ?>>颜色</option>
      <option value="3" <?php if($info['d_key'] == 3){ ?> selected <?php } ?>>皮质</option>
      <option value="4" <?php if($info['d_key'] == 4){ ?> selected <?php } ?>>金属</option>
    </select>   
  </td>
  
  </tr>
    <tr>
  <td class="tableleft">顺序</td>       
  <td colspan="2">
         <input type="text" name="rank" class="form-control" value="0" value="<?=$info['rank']?>"/>
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
