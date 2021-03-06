<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>detail</title>
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
div,a{
	 -webkit-tap-highlight-color:transparent;
}
a{color:#333;text-decoration: none;
}
img{
	max-width: 100%;vertical-align: middle;
	border:0;
}
.title-area{
	overflow: hidden;
	position: relative;
	
}
.t-left{
	overflow: hidden;
	
}
.t-right{
	float: right;
	margin: 2rem 1rem 1rem;
}
.icon-fav{
	width: 18px;height: 18px;
	display: inline-block;
	background: url(favorite.svg) no-repeat;
	-webkit-background-size: 100% 100%;
	background-size: 100% 100%;
	vertical-align: middle;
	margin-right: 4px;
}
.article-title{
	color:#252525;font-size: 2.2rem;margin-left: 1rem;margin-bottom: 0;
}
.article-meta{color:#BCBCBC;margin-left: 1rem;font-size: 12px;}
.article-entry{
	/*padding: 1rem;*/
}
.article-entry img{
	display: block;
	margin: 1rem auto;
}
.article-entry h1,.article-entry h2,.article-entry h3,.article-entry h4,.article-entry h5,.article-entry h5,
.article-entry p,.article-entry div,.article-entry ul,.article-entry ol,.article-entry dl{
	margin: 1rem;
}
.article-entry table {
	font-family: verdana,arial,sans-serif;
	border-width: 1px;
	border-color: #ccc;
	border-collapse: collapse;
	width: 93%;
	margin: 1rem;
}
.article-entry table th {
	border-width: 1px;
	padding: 5px;
	border-style: solid;
	border-color: #ccc;
	background-color: #dedede;
}
.article-entry table td {
	border-width: 1px;
	padding: 5px;
	border-style: solid;
	border-color: #ccc;
	background-color: #ffffff;
}
.related-shop{
	margin: 1rem;
}
.related-shop h2{
	margin-bottom: 0;font-size: 1.8rem;
}
.related-shop ul{
	margin: 0;padding: 0;list-style: none;
}
.related-shop ul li{
	overflow: hidden;
	margin-top: 10px;padding-top: 10px;
}
.related-shop ul li img{
	float: left;margin-right: 10px;
	width: 8rem;height: 8rem;
	border:1px solid #ddd;
}
.bfc{
	overflow: hidden;
	
}
.related-shop ul li h3{
	margin: 1rem 0;font-size: 1.6rem;color:#262626;
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
}
.related-shop ul li .price{
	color:#8C8C8C;
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
    top: 0;
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
	<div class="title-area">
		<div class="t-right">
			<span class="icon-fav"></span>520
		</div>
		<div class="t-left">
			<h1 class="article-title"><?=$info['title']?></h1>
			<div class="article-meta">2015-06-06</div>
		</div>
		
	</div>
	
	<article class="article-entry">
	<?=$info['intro']?>
	</article>
	<div class="related-shop">
		<h2>相关商品</h2>
		<ul>
			<li class="border-1px"><a href="">
					<img src="img003.jpg" alt="">
					<div class="bfc">
						<h3>hermes女士手包 这里是标题，很长很长</h3>
						<div class="price">￥163323</div>
					</div>
				</a>
			</li>
			<li class="border-1px"><a href="">
					<img src="img003.jpg" alt="">
					<div class="bfc">
						<h3>hermes女士手包 这里是标题，很长很长</h3>
						<div class="price">￥163323</div>
					</div>
				</a>
			</li>
		</ul>
	</div>
</body>
</html>