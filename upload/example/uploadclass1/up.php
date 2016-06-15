<?php
#######################################
# Author:          David Asín Sánchez #
# Organization:    Xarelan Multimedia #
# e-mail:          david@xarelan.com  #
#######################################
 
include('./XUploadForm.inc.php');

// Create the upload form
$mf = new XUploadForm('./upload.php');
?>
<html>
<body>
<?php

// ===================
// Show Form
// ===================

$mf->begin();
$mf->setFormMaxFileSize("2097152");

$mf->setFormFileInput("file1");
$mf->setFormFileInput("file2");
$mf->setFormFileInput("file3");

$mf->setFormButton("submit","Upload");
$mf->end();

?>
</body>
</html>