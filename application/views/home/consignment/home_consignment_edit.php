<?php Widget::head();?>
<link rel="stylesheet" href="<?=base_url()?>static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?=base_url()?>static/kindeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/plugins/code/prettify.js"></script>
<script type="text/javascript" src="<?=base_url()?>static/uploadify/jquery.uploadify.min.js"></script>
<link href="<?=base_url()?>static/uploadify/uploadify.css" rel="stylesheet" type="text/css">
<script>
    KindEditor.ready(function(K) {
      var editor1 = K.create('textarea[name="newsContent"]', {
        cssPath : '<?=base_url()?>static/kindeditor/plugins/code/prettify.css',
        uploadJson : '<?=base_url()?>static/kindeditor/php/upload_json.php',
        fileManagerJson : '<?=base_url()?>static/kindeditor/php/file_manager_json.php',
        allowFileManager : true,
        filterMode: true,//是否开启过滤模式

      });

        var editor1 = K.create('textarea[name="intro"]', {
        cssPath : '<?=base_url()?>static/kindeditor/plugins/code/prettify.css',
        uploadJson : '<?=base_url()?>static/kindeditor/php/upload_json.php',
        fileManagerJson : '<?=base_url()?>static/kindeditor/php/file_manager_json.php',
        allowFileManager : true,
        filterMode: true,//是否开启过滤模式

      });
      prettyPrint();
    });

var hostname = '<?=base_url()?>';
    $(function(){
  function delpic()
  {
    alert(this);
  }

//网站logo
  
  var piclist = '';
  $('#uploadify').uploadify({
    
    'swf':hostname+'static/uploadify/uploadify.swf',//选择文件按钮
    'uploader':hostname+'index.php/userupload/upload',//处理文件上传的php文件
    //'buttonImage': hostname+"static/images/upload_btn.png",
    'buttonClass' : 'upload_img',
    'wmode': "transparent",
    'removeCompleted':false,
    'width':'130',//选择文件按钮的宽度
    'height':'26',//选择文件按钮的高度
    'debug':false,
    'multi':false,//设置为true时可以上传多个文件
    'auto' : true,
    'fileObjName':'uploadify',
    'postData' : {dir:'product'},
         'buttonText':"选择文件",
    'onUploadComplete':function(file,data,response){
      //alert(data);
      //$("#logo").attr('src',hostname+'uploads/test/');

    },

    'onUploadError':function(file,errorCode,errorMsg){
      alert('上传错误：错误代码：'+obj2string(errorCode)+'错误消息：'+obj2string(errorMsg));
    },
    'onInit': function () {                        //载入时触发，将flash设置到最小
               $("#uploadify-queue").hide();
         },
    onUploadSuccess:function(file,data,response){
      piclist = "<li><img src='"+hostname+"uploads/product/"+data+" '/><br/><a href='javascript:void(0);' onclick='alert(this)'>删除</a><input type='hidden' name='pic[]' value='"+data+"' /></li>";
     
      $("#piclist").append(piclist);
      //alert(data);
      
    }
  });


});

  function get_attr(id)
  {
         // alert(hostname);
          
          var aj = $.ajax( {
                url:hostname + 'index.php/home/product/get_attr',
                data:{
                    categoryid : id,
                },
                contentType:"application/x-www-form-urlencoded; charset=utf-8",
                type:'post',
                cache:false,
                dataType:'text',
                success:function(data){
                 
              
              // $("#info tr:eq(3)").after('<tr><td class="tableleft">属性</td><td>'+data+'</td></tr>');
                  $("#attr").html(data);
                 // $("#attrtr").css('display','block');

                },
                error : function() {
                    alert("ERROR");
                }
            });

  }
</script>
<body>
	




<form name="form1" method="post" action="<?=base_url()?>index.php/home/consignment/update" enctype="multipart/form-data"/>
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">描述</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">图片</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">其他</a></li>
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
                            <td class="tableleft">产品名称</td>       
                           <td colspan="2">
                             <input type="text" class="form-control" name="p_name" placeholder="产品名称" value="<?=$info['pro_name']?>"> <span class="label label-danger">必填</span>
                           </td>
                      </tr>
                    <tr>
                            <td class="tableleft">品牌</td>       
                           <td colspan="2">
                             <select class="form-control" name="brand_id">
                              <option>请选择品牌</option>
                              <?php
                                foreach($brand as $k => $v){
                              ?>
                              <option value="<?=$v['id']?>" <?php if($info['brand_id'] == $v['id']){ ?> selected <?php } ?> ><?=$v['b_name']?></option>
                              <?php
                                }
                              ?>

                            </select>
                           </td>
                      </tr>

                        <tr>
                            <td class="tableleft">类别</td>       
                           <td colspan="2">
                            <select class="form-control" name="category_id" onchange="get_attr(this.value);">
                              <option>请选择类别</option>
                              <?php
                                foreach($category as $k => $v){
                              ?>
                              <option value="<?=$v['id']?>" <?php if($info['category_id'] == $v['id']){ ?> selected <?php } ?>><?=$v['c_name']?></option>
                              <?php
                                }
                              ?>

                            </select>

                           </td>
                      </tr>
                      <tr id="attrtr">
                            <td class="tableleft">属性</td>       
                           <td colspan="2" id="attr">
                           <?=$attr_str?>
                           </td>
                      </tr>
                    <tr>
                    <tr>
                            <td class="tableleft">数量</td>       
                           <td colspan="2">
                             <input type="text" class="form-control" name="total"  placeholder="0" value="<?=$info['total']?>"> <span class="label label-danger">必填</span>
                           </td>
                      </tr>
                    <tr>
                            <td class="tableleft">价格</td>       
                           <td colspan="2">
                             <input type="text" class="form-control" name="price"  placeholder="0.00" value="<?=$info['price']?>"> <span class="label label-danger">必填</span>
                           </td>
                      </tr>
                                          <tr>
                            <td class="tableleft">发布者</td>       
                           <td colspan="2">
                              <?=$info['mname']?>
                           </td>
                      </tr>
                       <tr>
                            <td class="tableleft">联系电话</td>       
                           <td colspan="2">
                              <?=$info['tel']?>
                           </td>
                      </tr>
                                            <tr>
                            <td class="tableleft">折扣</td>       
                           <td colspan="2">
                             <input type="text" class="form-control" name="discount"  placeholder="折扣" value="<?=$info['discount']?>"> 
                           </td>
                      </tr>

                                            <tr>
                            <td class="tableleft">支付方式</td>       
                           <td colspan="2">
                           <?php
                            foreach($pay as $k => $v){
                           ?>
                           <input type="checkbox"  value="<?=$v['id']?>" name="pay_id[]" <?php if(in_array($v['id'],$pays)){ ?> checked="true" <?php } ?>> <?=$v['pay_name']?>   
                           <?php
                            }
                           ?>

                           </td>
                      </tr>
                                          <tr>
                        <td class="tableleft">图片</td>   
                        <td>
                        <input type="file" name="userfile" />
                          <?php
                            if(!empty($info['pic'])){
                          ?>
                          <img src="<?=base_url()?>uploads/productthumb/<?=$info['pic']?>" width="60px" height="60px"/>
                          <?php
                            }
                          ?>
                        </td>      
                    </tr>
                      <tr>
                            <td class="tableleft">上下架</td>       
                           <td colspan="2">
                             <input type="radio" name="enabled" id="inlineCheckbox1" value="0" <?php if($info['enabled'] == 0){ ?> checked <?php } ?>>  <span class="label label-danger">下架</span>
                             <input type="radio" name="enabled" id="inlineCheckbox1" value="1" <?php if($info['enabled'] == 1){ ?> checked <?php } ?>>  <span class="label label-success">上架</span>
                           </td>
                      </tr>
                                            <tr>
                            <td class="tableleft">划分</td>       
                           <td colspan="2">
                             <input type="radio" name="types" id="inlineCheckbox1" value="4"  checked> 寄售
                           </td>
                      </tr>
                     <tr>
                            <td class="tableleft">审核</td>       
                           <td colspan="2">
                                <select name="status">
                                    <option value="0" <?php if($info['status'] == 0){ ?> selected <?php } ?>>未审核</option>
                                    <option value="1" <?php if($info['status'] == 1){ ?> selected <?php } ?>>审核通过</option>
                                    <option value="2" <?php if($info['status'] == 2){ ?> selected <?php } ?>>审核失败</option>
                                </select>
                           </td>
                      </tr>
                     <tr>
                            <td class="tableleft">原因/备注</td>       
                           <td colspan="2">
                               <textarea name="reasons" ><?=$info['reasons']?></textarea>
                           </td>
                      </tr>
                    </table>
                </div>
                <!--基本信息-->

                <!--描述-->
                <div role="tabpanel" class="tab-pane" id="profile">
                    <table class="table table-bordered  definewidth m10">


                        <tr>
                            <td class="tableleft">简介</td>   
                            <td>
                           <textarea name="intro" style="width:100%;height:400px;visibility:hidden;"><?=$info['intro']?></textarea>
                            </td>      
                        </tr>
                        <tr>
                          <td class="tableleft">详情</td>
                          <td colspan="2">
                       <!-- <?=$fcf?>-->
                        <textarea name="newsContent" style="width:100%;height:400px;visibility:hidden;"><?=$info['content']?></textarea>
                        </td>
                        </tr>
                       
                    </table>
                </div>
                 <!--描述-->

                  <!--图片-->
                <div role="tabpanel" class="tab-pane" id="messages">
                  <input type="file" name="uploadify" id="uploadify" >
                    <br/>
                    <br/>
                  <ul id="piclist">
                    <?php
                      foreach($pic as $k => $v){
                    ?>
                    <li id="img_<?=$v['id']?>"><img src="<?=base_url()?>uploads/productthumb/<?=$v['img']?>" width="100px" height="100px"/><input type="hidden" name="pic[]" value="<?=$v['filename']?>" /><br/><a href="javascript:void(0);" onclick="delpic('img_<?=$v['id']?>');">删除</a></li>
                    <?php
                      }
                    ?>
                  </ul>
                </div>
                 <!--图片-->

                  <!--其他-->
                <div role="tabpanel" class="tab-pane" id="settings">
                    
                </div>
                 <!--其他-->
              </div>

            </div>
        </td>       
    </tr>
    <tr>
        <input type="hidden" name="id" value="<?=$info['id']?>" />
        <td colspan="4"><input type="submit" class="btn btn-primary" value="提交"/></td>   
    </tr>
    </table>
</form>
<script>

function delpic(id)
{
   $("#"+id).remove();
}

function status_change(status)
{
  alert(status);
  switch(status){

      case "1":
       
        break;
      case "3":     //审核失败


      default:
        alert('22222222222222222');
        break;
  }
  
}
</script>

</body>
</html>
