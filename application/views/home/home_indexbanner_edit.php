<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/indexbanner/update" enctype="multipart/form-data"/>
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
         <input type="text" name="banner_name" value="<?=$info['banner_name']?>"> <span class="label label-danger">必填</span>
       </td>
  </tr>
      <tr>
        <td class="tableleft">KEY</td>       
       <td colspan="2">
         <input type="text" name="banner_key" value="<?=$info['banner_key']?>"> <span class="label label-danger">必填</span>
       </td>
  </tr>
    <tr>
        <td class="tableleft">图片</td>   
        <td><input type="file" name="userfile" /></td>      
    </tr>
    <tr>
        <tr>
      <td>简介</td>
      <td colspan="2">
   <!-- <?=$fcf?>-->
    <textarea name="banner_intro" style="width:600px;height:400px;"><?=$info['banner_intro']?></textarea>
    </td>
    </tr>
  <td class="tableleft">排序</td>       
       <td colspan="2">
          <input type="text" name="rank" value="<?=$info['rank']?>">
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
