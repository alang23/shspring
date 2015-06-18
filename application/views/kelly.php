<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Birkin</title>
	<script src="<?=base_url()?>static/gouzao/js/echo.min.js"></script>
<style type="text/css">
html{
	font-size: 62.5%;
}
*,*:before,*:after{
	 box-sizing:border-box; -webkit-box-sizing:border-box; 
}
body{
	margin: 0;
	font: 400 1.4rem/1.5  'Helvetica Neue',Droid Sans Fallback,Heiti SC,sans-self;
	background: #fff;
	color: #686868;
}
a,a:active{
	text-decoration: none;
	color:#333;
}
div,a{
	 -webkit-tap-highlight-color:transparent;
}
img{
	max-width: 100%;vertical-align: middle;
	border:0;
}
.container{
	max-width: 640px;background: #fff;
	margin: 0 auto;
}
.container img{
	min-height: 100px;
	  background: #FFF url(<?=base_url()?>static/gouzao/img/ajax.gif) no-repeat center center;
}
ul.tab{
	margin: 0;padding: 0;list-style: none;
	overflow: hidden;
}
ul.tab li{
	float: left;width: 50%;height: 40px;line-height:40px;text-align: center;
}
ul.tab li a{border-bottom: 2px solid transparent;display: inline-block;padding: 0 20px; line-height: 38px;font-size: 16px;position: relative;
}
ul.tab li.active a{border-bottom: 2px solid #262626;z-index:100;}
.small-title{
	border-bottom: 1px solid #262626;margin: 0 1rem;
}
.small-title strong{
	background: #262626;display: inline-block;color:#fff;
	font-size: 2rem;padding: 0 10px;font-weight: normal;
	
}
.bot-link{
	text-align:center;padding: 0 1rem;
}
.bot-link a{
	display: inline-block;background: #231A16;border-radius:1.4rem;height: 2.8rem;color:#fff;line-height: 2.8rem;
	width: 30%;text-align: center;margin-bottom: 10px;font-size: 12px;
}
.border-1px{
  position: relative;
}  
.border-1px:before{
    border-top: 1px solid #c8c7cc;
    content: ' ';
    display: block;
    width: 100%;
    position: absolute;
    left: 0;
  }
.border-1px:before{
    bottom: 0;
  }
@media (-webkit-min-device-pixel-ratio:1.5), (min-device-pixel-ratio: 1.5){
   .border-1px:before{
      -webkit-transform: scaleY(.7);
      -webkit-transform-origin: 0 0;
      transform: scaleY(.7);
    }
    .border-1px:after{
      -webkit-transform-origin: left bottom;
    }
  
}
@media (-webkit-min-device-pixel-ratio:2), (min-device-pixel-ratio: 2){
    .border-1px:before{
      -webkit-transform: scaleY(.5);
      -webkit-transform-origin: 0 0;
      transform: scaleY(.5);
    }
    .border-1px:after{
      -webkit-transform-origin: left bottom;
    }
}
@media (-webkit-min-device-pixel-ratio:3), (min-device-pixel-ratio: 3){
    .border-1px:before{
      -webkit-transform: scaleY(.4);
      -webkit-transform-origin: 0 0;
      transform: scaleY(.4);
    }
    .border-1px:after{
      -webkit-transform-origin: left bottom;
    }
}
</style>	
</head>
<body>
	<div class="container">
		<ul class="tab border-1px">
			<li><a href="<?=base_url()?>index.php/gouzao">Birkin</a></li>
			<li class="active"><a href="<?=base_url()?>index.php/kelly">Kelly</a></li>
		</ul>
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-1.jpg">
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-2.jpg">
		<div class="small-title"><strong>尺寸设计 SIZE</strong></div>
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-3.jpg">
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-4.jpg">
		<div class="small-title"><strong>构造 DETAILES</strong></div>
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-5.jpg">
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-6.jpg">
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-7.jpg">
		<img src="<?=base_url()?>static/gouzao/img/blank.gif" alt="" data-echo="<?=base_url()?>static/gouzao/img/k-8.jpg">
		
	</div>
	<div class="bot-link">
			<a href="">KELLY 25</a>
			<a href="">KELLY 28</a>
			<a href="">KELLY 32</a>
			<a href="">KELLY 35</a>
			<a href="">KELLY others</a>
		</div>
	<script src="<?=base_url()?>static/gouzao/js/echo.min.js"></script>	
	<script type="text/javascript">
	echo.init({
      offset: 100,
      throttle: 250,
      unload: false
     
    });
    
	</script>
</body>
</html>