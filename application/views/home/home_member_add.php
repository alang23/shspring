<?php Widget::head();?>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/member/add" enctype="multipart/form-data"/>
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
         <input type="text" name="phone" class="form-control" placeholder="手机号"> 
       </td>
  </tr>
      <tr>
        <td class="tableleft">密码</td>       
       <td colspan="2">
         <input type="text" name="pawd" class="form-control" placeholder="登陆密码"> 
       </td>
  </tr>
      <tr>
        <td class="tableleft">姓名</td>       
       <td colspan="2">
         <input type="text" name="realname" class="form-control" placeholder="姓名"> 
  </tr>
<tr>
        <td class="tableleft">性别</td>       
       <td colspan="2">
            <input type="radio" name="gender" id="inlineCheckbox1" value="1"> 男 
            <input type="radio" name="gender" id="inlineCheckbox1" value="2">  女
       </td>
  </tr>
      <tr>
        <td class="tableleft">昵称</td>       
       <td colspan="2">
         <input type="text" name="username" class="form-control" placeholder="昵称">
       </td>
  </tr>
      <tr>
        <td class="tableleft">邮箱</td>       
       <td colspan="2">
         <input type="text" name="email" class="form-control" placeholder="邮箱"> 
       </td>
  </tr>
        <tr>
        <td class="tableleft">地址</td>       
       <td colspan="2">
         <input type="text" name="address" class="form-control" placeholder="地址"> 
       </td>
  </tr>
    <tr>
        <td class="tableleft">头像</td>   
        <td><input type="file" name="userfile" /></td>      
    </tr>
<tr>
        <td class="tableleft">账号状态</td>       
       <td colspan="2">
            <input type="radio" name="enabled" id="inlineCheckbox1" value="0">  <span class="label label-danger">停用</span>
            <input type="radio" name="enabled" id="inlineCheckbox1" value="1">  <span class="label label-success">正常</span>
       </td>
  </tr>
    <tr>

	 	<td colspan="4"><input type="submit" class="btn btn-primary" value="提交"/></td>   
    </tr>
	</table>
</form>
</body>
</html>
