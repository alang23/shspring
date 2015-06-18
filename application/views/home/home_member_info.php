<?php Widget::head();?>
<link rel="stylesheet" href="<?=base_url()?>static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?=base_url()?>static/kindeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/plugins/code/prettify.js"></script>


<body>
<ol class="breadcrumb">
  <li><a href="<?=base_url()?>index.php/home/member">会员列表</a></li>
  <li class="active">会员详情</li>
  <li>Data</li>
</ol>

<form name="form1" method="post" action="<?=base_url()?>index.php/home/product/add" enctype="multipart/form-data"/>
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">收货地址</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">购买记录</a></li>

  </ul>
<table class="table definewidth m10">
    <tr>
        <td>
            
                          <!-- Tab panes -->
              <div class="tab-content">
              <!--基本信息-->
                <div role="tabpanel" class="tab-pane active" id="home">
                    
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th></th>      
                            <th></th>
                        </tr>
                        </thead>
                        <tr>
                            <td class="tableleft" width="20%">手机号</td>       
                           <td colspan="2">
                           <?=$info['phone']?>
                           </td>
                      </tr>
                    <tr>
                            <td class="tableleft">用户名</td>       
                           <td colspan="2">
                             <?=$info['username']?>
                           </td>
                      </tr>

                        <tr>
                            <td class="tableleft">真实姓名</td>       
                           <td colspan="2">
                  
                           <?=$info['realname']?>
                           </td>
                      </tr>

                    <tr>
                            <td class="tableleft">性别</td>       
                           <td colspan="2">
                            <?php
                              if($info['gender'] == 1){
                            ?>
                            男
                            <?php
                              }elseif($info['gender'] == 2){
                            ?>
                            女
                            <?php
                              }else{
                            ?>
                            未知
                            <?php
                              }
                            ?>
                           </td>
                      </tr>
                    <tr>
                            <td class="tableleft">头像</td>       
                           <td colspan="2">

                           </td>
                      </tr>
                    <tr>
                            <td class="tableleft">地址</td>       
                           <td colspan="2">
                           <?=$info['phone']?>
                           </td>
                      </tr>
                      <tr>
                            <td class="tableleft">账号状态</td>       
                           <td colspan="2">
                           <?php
                            if($info['enabled'] == 0){
                           ?>
                            停用
                           <?php
                            }else{
                           ?>
                            正常
                           <?php
                            }
                           ?>
                           </td>
                      </tr>
                    </table>
                </div>
                <!--基本信息-->

                <!--收货地址-->
                <div role="tabpanel" class="tab-pane" id="profile">
                    <table class="table table-bordered  definewidth m10">
                          <thead>
                          <tr>
                              <th>收件人</th>
                              <th>省</th>  
                              <th>市</th>
                              <th>区</th>  
                              <th>地址</th>                          
                              <th>邮编</th>
                              <th>电话</th>
                              <th>填写日期</th>     
                          </tr>
                          </thead>
                      <?php
                        foreach($address as $k => $v){
                      ?>
                        <tr>
                            <td><?=$v['realname']?></td>  
                            <td><?=$v['n1']?></td>  
                            <td><?=$v['n2']?></td>  
                            <td><?=$v['n3']?></td>   
                            <td><?=$v['address']?></td>  
                            <td><?=$v['zip_code']?></td>  
                            <td><?=$v['mobile']?></td>  
                             <td><?=date("Y-m-d H:i:s")?></td>   
                        </tr>
                        <?php
                          }
                        ?>
                       
                       
                    </table>
                </div>
                 <!--描述-->

                  <!--图片-->
                <div role="tabpanel" class="tab-pane" id="messages">

                </div>
                 <!--图片-->

              </div>

            </div>
        </td>       
    </tr>
    <tr>

        <td colspan="8"></td>   
    </tr>
    </table>
</form>


</body>
</html>
