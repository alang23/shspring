<?php Widget::head();?>
<link rel="stylesheet" href="<?=base_url()?>static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?=base_url()?>static/kindeditor/plugins/code/prettify.css" />
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="<?=base_url()?>static/kindeditor/plugins/code/prettify.js"></script>
<script>
    KindEditor.ready(function(K) {
      var editor1 = K.create('textarea[name="newsContent"]', {
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
	<ol class="breadcrumb">
  <li><a href="<?=base_url()?>index.php/home/school">品牌学堂</a></li>
  <li class="active">添加</li>

</ol>

<form name="form1" method="post" action="<?=base_url()?>index.php/home/school/listsupdate" enctype="multipart/form-data"/>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>

        <th></th>      
        <th></th>
    </tr>
    </thead>
        <tr>
        <td class="tableleft">栏目</td>       
       <td colspan="2">
         <select name="sid">
          <option value="0">选择栏目</option>
          <?php
            foreach($list as $k => $v){
          ?>
            <option value="<?=$v['id']?>" <?php if($info['sid'] == $v['id']){ ?> selected <?php } ?>><?=$v['title']?></option>
            <?php
              }
            ?>
         </select>
       </td>
  </tr>
    <tr>
        <td class="tableleft">标题</td>       
       <td colspan="2">
         <input type="text" name="title" class="form-control" placeholder="标题" value="<?=$info['title']?>"> 
       </td>
  </tr>
      <tr>
        <td class="tableleft">配图</td>   
        <td><input type="file" name="userfile" />
        <?php
          if(!empty($info['img'])){
        ?>
        <img src="<?=base_url()?>uploads/school_lists/<?=$info['img']?>" width="60px" height="60px" />
        <?php
          }
        ?>
        </td>      
    </tr>
      <tr>
        <td class="tableleft">作者</td>       
       <td colspan="2">
         <input type="text" name="author" class="form-control" placeholder="作者" value="<?=$info['author']?>"> 
       </td>
  </tr>
      <tr>
        <td class="tableleft">简介</td>       
       <td colspan="2">
         <textarea name="intro" style="width:60%;height:300px;"><?=$info['intro']?></textarea>
  </tr>
<tr>
        <td class="tableleft">详情</td>       
       <td colspan="2">
            <textarea name="newsContent" style="width:100%;height:400px;visibility:hidden;"><?=$info['content']?></textarea>
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
