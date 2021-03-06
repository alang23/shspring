<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>SpriteSpin</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script src="<?=base_url()?>static/3d/spritespin.min.js"></script>
    <style type="text/css" media="screen">
      body{
        margin: 0;
      }
    </style>
  </head>
  <body>
    <div class="spritespin"></div>
    <div style="text-align:center">手指触摸滑动查看</div>
    <script type="text/javascript">
      var mediaWidth = $(window).width();
      console.log(mediaWidth);
      $('.spritespin').spritespin({
         source: SpriteSpin.sourceArray('<?=base_url()?>static/3d/images/rad_zoom_{frame}.jpg', { frame: [1,34], digits: 3 }),
        width: mediaWidth,
        height: mediaWidth,
        frames: 34,
        framesX: 6,
        frameTime : 60,
        sense: -1,
        renderer: 'image'
      });
    </script>
  </body>
</html>