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
        <td class="tableleft">配送方式</td>       
       <td colspan="2">
         <?=exp_type($order_info['exp']);?>
       </td>
  </tr>
  <tr>
        <td class="tableleft">配送地址</td>       
       <td colspan="2">
        <?=$order_info['address'];?>
       </td>
  </tr>
  <tr>
  <td class="tableleft">红包使用:</td>       
       <td colspan="2">
        
       </td>
  </tr>
    <tr>
  <td class="tableleft">发票</td>       
       <td colspan="2">
        <?=invoice_type($order_info['invoice'])?>
       </td>
  </tr>
  <?php
    if($order_info['invoice'] == 3){
  ?>
      <tr>
  <td class="tableleft">发票抬头</td>       
       <td colspan="2">
        <?=$order_info['invoice_title']?>
       </td>
  </tr>
  <?php
}
  ?>
      <tr>
  <td class="tableleft">商品:</td>       
       <td colspan="2">
        <table class="table table-bordered table-hover definewidth m10">
            <thead>
            <tr>

                <th>商品名称</th> 
                 <th>缩略图</th>    
                <th>单价</th>
                <th>数量</th>
                <th>总额</th>
               
            </tr>
            </thead>

          <?php
            foreach($list as $k => $v){
          ?>
            <tr>
              <td valign="middle"><?=$v['p_name_o']?></a></td> 
              <td valign="middle"><img src="<?=base_url()?>uploads/productthumb/<?=$v['pic']?>" width="40px" height="40px"/></a></td>    
              <td valign="middle"><?=$v['price']?></td>
              <td valign="middle"><?=$v['num']?></td>
              <td valign="middle"><?=$v['price']*$v['num']?></td>
              
            </tr>

          <?php
          }
          ?>

        </table>
       </td>
  </tr>
      <tr>
  <td class="tableleft">订单状态</td>       
       <td colspan="2">
        <input type="radio" name="status" id="inlineCheckbox1" value="0" <?php if($v['status'] == 0){ ?> checked="checked" <?php }?> > 未付款
        <br/>
        <input type="radio" name="status" id="inlineCheckbox1" value="1" <?php if($v['status'] == 1){ ?> checked="checked" <?php }?>> 待发货
        <br/>
        <input type="radio" name="status" id="inlineCheckbox1" value="2" <?php if($v['status'] == 2){ ?> checked="checked" <?php }?>> 待签收
        <br/>
        <input type="radio" name="status" id="inlineCheckbox1" value="3" <?php if($v['status'] == 3){ ?> checked="checked" <?php }?>> 完成
        <br/>
        <input type="radio" name="status" id="inlineCheckbox1" value="4" <?php if($v['status'] == 4){ ?> checked="checked" <?php }?>> 失败
       </td>
  </tr>
      <tr>
  <td class="tableleft">时间</td>       
       <td colspan="2">
          <?=date("Y-m-d H:i:s",$order_info['createtime'])?>
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
