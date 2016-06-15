<?php
/* 
 * 文件上传类 
 * 作    者：多菜鸟
 * 联系邮箱：kingerq AT msn DOT com
 * 创建时间：2005-06-11
 * 来　　源：http://blog.csdn.net/kingerq
 * 
 * 实例：
 */
print "<br><br>\n";
print "<form enctype='multipart/form-data' method='post' action='". $PHP_SELF ."'>\n";
print "<input type='hidden' name='MAX_FILE_SIZE' value='200000'>\n";
print "<input type='file' name='files'><p>\n";
print "<input type='submit' value='Upload' name='upload'>\n";
print "</form>\n";


 $f = new upfile("./soft/", "gif,jpg,png");
//上传单个或者多个同文件域名称文件
if(isset($_FILES["files"])){
 $filear = $f->upload("files");//返回上传后文件名(或者数组)
}
//上传多个不同文件域名称文件
if(isset($_FILES)){
 foreach($_FILES as $key=>$val)
  $filear[] = $f->upload($key);//返回上传后文件名数组
}




class upfile{
 //上传文件信息
 var $filename;
 // 保存名
 var $savename;
 // 保存路径
 var $savepath;
 // 文件格式限定，为空时不限制格式
 var $format = "";
 // 覆盖模式
 var $overwrite = 0;
 /* $overwrite = 0 时不覆盖同名文件
  * $overwrite = 1 时覆盖同名文件
  */
 //文件最大字节
 var $maxsize = 210000000;
 //文件扩展名
 var $ext;
 
 /* 构造函数
  * $path 保存路径
  * $format 文件格式(用逗号分开)
  * $maxsize 文件最大限制,0为默认值
  * $over 复盖参数
  */
 function upfile($path = "./", $format = "", $maxsize = 0, $over = 0){
  if(!file_exists($path)){
   $this->halt("指定的目录[ ".$path." ]不存在。");
  }
  
  if(!is_writable($path)){
   $this->halt("指定的目录[ ".$path." ]不可写。");
  }
  $path = str_replace("\\","/", $path);
  $this->savepath = substr($path, -1) == "/" ? $path : $path."/";//保存路径
  
  $this->overwrite = $over;//是否复盖相同名字文件
  $this->maxsize = !$maxsize ? $this->maxsize : $maxsize;//文件最大字节
  $this->format = $format;
 }
 
 /*
  * 功能：检测并组织文件
  * $form      文件域名称
  * $filename 上传文件保存名称，为空或者上传多个文件时由系统自动生成名称
  * $filename = 1，并上传多个同文件域名称文件时，则文件保存为原上传文件名称。
  */
 function upload($form, $filename = ""){
  if(!isset($_FILES[$form])){
   $this->halt("指定的文件域名称不存在。");
  }else{
   $filear = $_FILES[$form];
  }
  
  if(is_array($filear["name"])){//上传同文件域名称多个文件
   $outfile = array();//返回文件名称数组
   for($i = 0; $i < count($filear["name"]); $i++){
    $ar["name"] = $filear["name"][$i];
    $ar["tmp_name"] = $filear["tmp_name"][$i];
    $ar["size"] = $filear["size"][$i];
    $ar["error"] = $filear["error"][$i];
    
    $this->getext($ar["name"]);//取得扩展名
    $this->set_savename($filename == 1 ? $ar["name"] : "");//设置保存文件名
    $outfile[] = $this->copyfile($ar);
   }
   return $outfile;
  }else{//上传单个文件
   $this->getext($filear["name"]);//取得扩展名
   $this->set_savename($filename);//设置保存文件名
   return $this->copyfile($filear);
  }
  return false;
 }
 
 /*
  * 功能：检测并复制上传文件
  * $filear 上传文件资料数组
  */
 function copyfile($filear){
 
  if($filear["size"] > $this->maxsize){
   $this->halt("上传文件 ".$filear["name"]." 大小超出系统限定值[".$this->maxsize." 字节]，不能上传。");
  }
  
  if(!$this->overwrite && file_exists($this->savename)){
   $this->halt($this->savename." 文件名已经存在。");
  }
  
  if(!$this->chkext()){
   $this->halt($this->ext." 文件格式不允许上传。");
  }
  
  if(!copy($filear["tmp_name"], $this->savepath.$this->savename)){
   $errors = array(0=>"文件上传成功",
       1=>"上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 ",
       2=>"上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 ",
       3=>"文件只有部分被上传。 ",
       4=>"没有文件被上传。 ");
   $this->halt($errors[$filear["error"]]);
  }else{
   @unlink($filear["tmp_name"]);//删除临时文件
   return $this->savename;//返回上传文件名
  }
 }
 
 /*
  * 功能: 取得文件扩展名
  * $filename 为文件名称
  */
 function getext($filename){
  if($filename == "") return;
  
  $ext = explode(".", $filename);
  
  $this->ext = $ext[1];
 }
 
 /*
  * 功能：检测文件类型是否允许
  */
 function chkext(){
  if($this->format == "" || in_array(strtolower($this->ext), explode(",", strtolower($this->format)))) return true;
  else return false;
 }
 /*
  * 功能: 设置文件保存名
  * $savename 保存名，如果为空，则系统自动生成一个随机的文件名
  */
 function set_savename($savename = ""){
  if ($savename == "") { // 如果未设置文件名，则生成一个随机文件名
   srand ((double) microtime() * 1000000);
   $rnd = rand(100,999);
   $name = date('U') + $rnd;
   $name = $name.".".$this->ext;
  } else {
   $name = $savename;
  }
  $this->savename = $name;
 }
 
 /*
  * 功能：错误提示
  * $msg 为输出信息
  */
 function halt($msg){
  echo "<strong>注意：</strong>".$msg;
  exit;
 }
}


?>
