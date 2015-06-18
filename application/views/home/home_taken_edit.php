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
      var editor1 = K.create('textarea[name="intro"]', {
        cssPath : '<?=base_url()?>static/kindeditor/plugins/code/prettify.css',
        uploadJson : '<?=base_url()?>static/kindeditor/php/upload_json.php',
        fileManagerJson : '<?=base_url()?>static/kindeditor/php/file_manager_json.php',
        allowFileManager : true,
        filterMode: true,//是否开启过滤模式

      });

      prettyPrint();
    });
    </script>
<body>
	

<form name="form1" method="post" action="<?=base_url()?>index.php/home/taken/update" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>
    <tr>
        <td class="tableleft">标题</td>       
       <td colspan="2">
         <input type="text"  value="<?=$info['title']?>" class="form-control" name="title" placeholder="标题"> <span class="label label-danger">必填</span>
       </td>
  </tr>
      <tr>
        <td class="tableleft">用户</td>       
       <td colspan="2">
       <?php
        foreach($member as $k => $v){
       ?>
         <input type="radio" name="uid" value="<?=$v['id']?>" <?php if($v['uid'] = $info['uid']){?>checked="checked" <?php } ?>/><?=$v['phone']?>
         <?php
          }
         ?>
       </td>
  </tr>
    <tr>
        <td class="tableleft">图片</td>   
        <td>
        <input type="file" name="userfile" />
        <img src="<?=base_url()?>uploads/taken/<?=$info['img']?>" />
        </td>      
    </tr>
  <td class="tableleft">简介</td>       
       <td colspan="2">
         <textarea name="intro" style="width:100%;height:600px;"><?=$info['intro']?></textarea>
       </td>
  </tr>
      <tr>
  <td class="tableleft">顺序</td>       
       <td colspan="2">
         <input type="text" name="rank" value="<?=$info['rank']?>" />
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
