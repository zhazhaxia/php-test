<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" /> 
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.imgareaselect.pack.js"></script> 
</head>

<body>
<script type="text/javascript"> 
function preview(img, selection) { 
var scaleX = 100 / selection.width;       //100 指的是新图的宽 
var scaleY = 100 / selection.height;   //100 指的是新图的高 
$('#thumbnail img').css({ 
width: Math.round(scaleX * 800) + 'px', //800指的是原图的宽 
height: Math.round(scaleY * 600) + 'px', //600指的是原图的高 
marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
}); 
$('#x1').val(selection.x1); 
$('#y1').val(selection.y1); 
$('#x2').val(selection.x2); 
$('#y2').val(selection.y2); 
$('#w').val(selection.width); 
$('#h').val(selection.height); 
} 
$(document).ready(function () { 
$('img#photo').imgAreaSelect({ x1: 0, y1: 0, x2: 50, y2: 50, fadeSpeed:10,aspectRatio: '1:1', handles:"corners",onSelectChange: preview}); 
$('#save_thumb').click(function() { 
var x1 = $('#x1').val(); 
var y1 = $('#y1').val(); 
var x2 = $('#x2').val(); 
var y2 = $('#y2').val(); 
var w = $('#w').val(); 
var h = $('#h').val(); 
if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){ 
alert("image is null"); 
return false; 
}else{ 
return true; 
} 
}); 
}); 
 </script>


<div style="float:left;" class="frame"> 
<img src="002.jpg" id="photo"/> 
</div> 
<div style="float:left; width: 100px; height: 100px;border:1px solid red;" id="thumbnail"> 
   <div style="overflow: hidden; width: 100px; height: 100px;" id="preview"> 
    <img src="002.jpg"/> 
   </div> 
</div> 
<div style="margin-top:10px;"> 
<form name="thumbnail" action="imgareaselect.php" method="post"> 
<input type="hidden" name="x1" value="" id="x1" /> 
<input type="hidden" name="y1" value="" id="y1" /> 
<input type="hidden" name="x2" value="" id="x2" /> 
<input type="hidden" name="y2" value="" id="y2" /> 
<input type="hidden" name="w" value="" id="w" /> 
<input type="hidden" name="h" value="" id="h" /> 
<input type="submit" name="upload_thumbnail" value="save thumb" id="save_thumb" /> 
</form> 
</div>
PHP代码：



</body>
</html>





<head> 

<head>

<p style="display:none;">其中CSS文件是jQuery的截图插件imgAreaSelect压缩包里自带的CSS样式，jquery.min.js 是jQuery库文件，jquery.imgareaselect.pack.js是imgareaselect插件的文件。


Javascript 代码：


这里重点介绍一下imagecopyresampled函数相关资料，
说明：imagecopyresampled 重采样拷贝部分图像并调整大小

原型：bool imagecopyresampled ( resource dst_image, resource src_image, int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h )dst_image 和 src_image 分别是目标图像和源图像的标识符。

其它：imagecopyresampled(目标图像，源图像，存宽度，存高度，坐标X，坐标Y，源宽度，源高度) 如果成功则返回 TRUE，失败则返回 FALSE。 imagecopyresampled() 将一幅图像中的一块正方形区域拷贝到另一个图像中，平滑地插入像素值，因此，尤其是，减小了图像的大小而仍然保持了极大的清晰度。如果源和目标的宽度和高度不同，则会进行相应的图像收缩和拉伸。坐标指的是左上角。本函数可用来在同一幅图内部拷贝（如果 dst_image 和 src_image 相同的话）区域，但如果区域交迭的话则结果不可预知。

注意事项: 因为调色板图像限制（255+1 种颜色）有个问题。重采样或过滤图像通常需要多于 255 种颜色，计算新的被重采样的像素及其颜色时采用了一种近似值。对调色板图像尝试分配一个新颜色时，如果失败我们选择了计算结果最接近（理论上）的颜色。这并不总是视觉上最接近的颜色。这可能会产生怪异的结果，例如空白（或者视觉上是空白）的图像。要跳过这个问题，请使用真彩色图像作为目标图像，例如用 imagecreatetruecolor() 创建的。



本文来自CSDN博客，转载请标明出处：http://blog.csdn.net/okfei/archive/2010/02/07/5296237.aspx
</p>