<?php
/* 
 * �ļ��ϴ��� 
 * ��    �ߣ������
 * ��ϵ���䣺kingerq AT msn DOT com
 * ����ʱ�䣺2005-06-11
 * ������Դ��http://blog.csdn.net/kingerq
 * 
 * ʵ����
 */
print "<br><br>\n";
print "<form enctype='multipart/form-data' method='post' action='". $PHP_SELF ."'>\n";
print "<input type='hidden' name='MAX_FILE_SIZE' value='200000'>\n";
print "<input type='file' name='files'><p>\n";
print "<input type='submit' value='Upload' name='upload'>\n";
print "</form>\n";


 $f = new upfile("./soft/", "gif,jpg,png");
//�ϴ��������߶��ͬ�ļ��������ļ�
if(isset($_FILES["files"])){
 $filear = $f->upload("files");//�����ϴ����ļ���(��������)
}
//�ϴ������ͬ�ļ��������ļ�
if(isset($_FILES)){
 foreach($_FILES as $key=>$val)
  $filear[] = $f->upload($key);//�����ϴ����ļ�������
}




class upfile{
 //�ϴ��ļ���Ϣ
 var $filename;
 // ������
 var $savename;
 // ����·��
 var $savepath;
 // �ļ���ʽ�޶���Ϊ��ʱ�����Ƹ�ʽ
 var $format = "";
 // ����ģʽ
 var $overwrite = 0;
 /* $overwrite = 0 ʱ������ͬ���ļ�
  * $overwrite = 1 ʱ����ͬ���ļ�
  */
 //�ļ�����ֽ�
 var $maxsize = 210000000;
 //�ļ���չ��
 var $ext;
 
 /* ���캯��
  * $path ����·��
  * $format �ļ���ʽ(�ö��ŷֿ�)
  * $maxsize �ļ��������,0ΪĬ��ֵ
  * $over ���ǲ���
  */
 function upfile($path = "./", $format = "", $maxsize = 0, $over = 0){
  if(!file_exists($path)){
   $this->halt("ָ����Ŀ¼[ ".$path." ]�����ڡ�");
  }
  
  if(!is_writable($path)){
   $this->halt("ָ����Ŀ¼[ ".$path." ]����д��");
  }
  $path = str_replace("\\","/", $path);
  $this->savepath = substr($path, -1) == "/" ? $path : $path."/";//����·��
  
  $this->overwrite = $over;//�Ƿ񸴸���ͬ�����ļ�
  $this->maxsize = !$maxsize ? $this->maxsize : $maxsize;//�ļ�����ֽ�
  $this->format = $format;
 }
 
 /*
  * ���ܣ���Ⲣ��֯�ļ�
  * $form      �ļ�������
  * $filename �ϴ��ļ��������ƣ�Ϊ�ջ����ϴ�����ļ�ʱ��ϵͳ�Զ���������
  * $filename = 1�����ϴ����ͬ�ļ��������ļ�ʱ�����ļ�����Ϊԭ�ϴ��ļ����ơ�
  */
 function upload($form, $filename = ""){
  if(!isset($_FILES[$form])){
   $this->halt("ָ�����ļ������Ʋ����ڡ�");
  }else{
   $filear = $_FILES[$form];
  }
  
  if(is_array($filear["name"])){//�ϴ�ͬ�ļ������ƶ���ļ�
   $outfile = array();//�����ļ���������
   for($i = 0; $i < count($filear["name"]); $i++){
    $ar["name"] = $filear["name"][$i];
    $ar["tmp_name"] = $filear["tmp_name"][$i];
    $ar["size"] = $filear["size"][$i];
    $ar["error"] = $filear["error"][$i];
    
    $this->getext($ar["name"]);//ȡ����չ��
    $this->set_savename($filename == 1 ? $ar["name"] : "");//���ñ����ļ���
    $outfile[] = $this->copyfile($ar);
   }
   return $outfile;
  }else{//�ϴ������ļ�
   $this->getext($filear["name"]);//ȡ����չ��
   $this->set_savename($filename);//���ñ����ļ���
   return $this->copyfile($filear);
  }
  return false;
 }
 
 /*
  * ���ܣ���Ⲣ�����ϴ��ļ�
  * $filear �ϴ��ļ���������
  */
 function copyfile($filear){
 
  if($filear["size"] > $this->maxsize){
   $this->halt("�ϴ��ļ� ".$filear["name"]." ��С����ϵͳ�޶�ֵ[".$this->maxsize." �ֽ�]�������ϴ���");
  }
  
  if(!$this->overwrite && file_exists($this->savename)){
   $this->halt($this->savename." �ļ����Ѿ����ڡ�");
  }
  
  if(!$this->chkext()){
   $this->halt($this->ext." �ļ���ʽ�������ϴ���");
  }
  
  if(!copy($filear["tmp_name"], $this->savepath.$this->savename)){
   $errors = array(0=>"�ļ��ϴ��ɹ�",
       1=>"�ϴ����ļ������� php.ini �� upload_max_filesize ѡ�����Ƶ�ֵ�� ",
       2=>"�ϴ��ļ��Ĵ�С������ HTML ���� MAX_FILE_SIZE ѡ��ָ����ֵ�� ",
       3=>"�ļ�ֻ�в��ֱ��ϴ��� ",
       4=>"û���ļ����ϴ��� ");
   $this->halt($errors[$filear["error"]]);
  }else{
   @unlink($filear["tmp_name"]);//ɾ����ʱ�ļ�
   return $this->savename;//�����ϴ��ļ���
  }
 }
 
 /*
  * ����: ȡ���ļ���չ��
  * $filename Ϊ�ļ�����
  */
 function getext($filename){
  if($filename == "") return;
  
  $ext = explode(".", $filename);
  
  $this->ext = $ext[1];
 }
 
 /*
  * ���ܣ�����ļ������Ƿ�����
  */
 function chkext(){
  if($this->format == "" || in_array(strtolower($this->ext), explode(",", strtolower($this->format)))) return true;
  else return false;
 }
 /*
  * ����: �����ļ�������
  * $savename �����������Ϊ�գ���ϵͳ�Զ�����һ��������ļ���
  */
 function set_savename($savename = ""){
  if ($savename == "") { // ���δ�����ļ�����������һ������ļ���
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
  * ���ܣ�������ʾ
  * $msg Ϊ�����Ϣ
  */
 function halt($msg){
  echo "<strong>ע�⣺</strong>".$msg;
  exit;
 }
}


?>
