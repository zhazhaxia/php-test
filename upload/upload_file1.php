<?php
header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试
?>
<form enctype="multipart/form-data" action="upload1.php" method="post">
	<input type="hidden" value="1000000" name="MAX_FILE_SIZE"/>
    上传文件：<input type="file" name="userfile" />
    <input type="submit" name="sub" value="上传"/>
</form>