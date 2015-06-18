<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/member/update" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>
    <tr>
        <td class="tableleft">手机号</td>       
       <td colspan="2">
         <input type="text" name="phone" class="form-control" placeholder="手机号" value="<?=$info['phone']?>"> 
       </td>
  </tr>
      <tr>
        <td class="tableleft">姓名</td>       
       <td colspan="2">
         <input type="text" name="realname" class="form-control" placeholder="姓名" value="<?=$info['realname']?>"> 
  </tr>
<tr>
        <td class="tableleft">性别</td>       
       <td colspan="2">
            <input type="radio" name="gender" id="inlineCheckbox1" value="1" <?php if($info['gender'] == 1){?> checked <?php } ?> > 男 
            <input type="radio" name="gender" id="inlineCheckbox1" value="2" <?php if($info['gender'] == 2){?> checked <?php } ?> >  女
       </td>
  </tr>
      <tr>
        <td class="tableleft">昵称</td>       
       <td colspan="2">
         <input type="text" name="username" class="form-control" placeholder="昵称" value="<?=$info['username']?>">
       </td>
  </tr>
      <tr>
        <td class="tableleft">邮箱</td>       
       <td colspan="2">
         <input type="text" name="email" class="form-control" placeholder="邮箱" value="<?=$info['email']?>"> 
       </td>
  </tr>
        <tr>
        <td class="tableleft">地址</td>       
       <td colspan="2">
         <input type="text" name="address" class="form-control" placeholder="地址" value="<?=$info['address']?>"> 
       </td>
  </tr>
    <tr>
        <td class="tableleft">头像</td>   
        <td>
        <input type="file" name="userfile" />
        <?php
          if(!empty($info['photo'])){
        ?>
        <img src="<?=base_url()?>uploads/member/<?=$info['photo']?>" width="60px" height="60px"/>
        <?php
          }
        ?>
        </td>      
    </tr>
<tr>
        <td class="tableleft">账号状态</td>       
       <td colspan="2">
            <input type="radio" name="enabled" id="inlineCheckbox1" value="0" <?php if($info['enabled'] == 0){?> checked <?php } ?>>  <span class="label label-danger">停用</span>
            <input type="radio" name="enabled" id="inlineCheckbox1" value="1" <?php if($info['enabled'] == 1){?> checked <?php } ?>>  <span class="label label-success">正常</span>
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
