<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/takeaway/update" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>
    <tr>
        <td class="tableleft">地址</td>       
       <td colspan="2">
         <input type="text" name="address" class="form-control" placeholder="自提地址" value="<?=$info['address']?>"> <span class="label label-danger">必填</span>
       </td>
  </tr>
    <tr>
        <td class="tableleft">电话</td>   
        <td><input type="text" name="tel" class="form-control" placeholder="联系电话" value="<?=$info['tel']?>"/><span class="label label-danger">必填</span></td>      
    </tr>
    <tr>
        <td class="tableleft">排序</td>   
        <td>
           <input type="text" name="rank" class="form-control" placeholder="排序" value="<?=$info['rank']?>"/>

        </td>      
    </tr>
        <tr>
        <td class="tableleft">备注</td>   
        <td>
            <textarea name="intro" class="form-control"><?=$info['intro']?></textarea>

        </td>      
    </tr>
    <tr>
    <input type="hidden" name="id" value="<?=$info['id']?>" />
	 	<td colspan="4"><input type="submit" class="btn btn-primary" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
