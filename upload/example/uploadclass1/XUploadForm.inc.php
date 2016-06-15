<?php
#########################################################################################################
#         	 Class XUploadForm 		Version 1.1 (September 2001)				#
#########################################################################################################
#Description: 		Class for creating upload forms with php(requires XUpload Class)		#
#Author:		David Asin Sanchez (david@red666.net | david@xarelan.com)			#
#Organization:		Xarelan Multimedia S.L.L (www.xarelan.com) - SPAIN				#
#Requirements: 		PHP4										#
#Features:												#
#			- Easy upload form management							#
#			- Let you choose the form encode type						#
#			- Let you choose the form method						#
#			- Let you add javascript to your form						#
#													#
#Public Interfaces:											#
#		XUploadForm():		constructor							#
#				-Params:								#
#					action:	form action						#
#					name(optional):form name (default myXUploadForm) 		#
#					method(optional): form method (default POST)			#
#					xtraJS(optional): javascript code				#
#		begin():		form begins							#
#		setFormEncType():	set form encoding type(optional)				#
#				-Params:								#
#					encType(optional): encoding type				#
#		setFormMaxFileSize():	set max file size (default 2MB)					#
#				-Params:								#
#					size:	max file size						#
#		setFormFileInput():	set an input file tag for upload				#
#				-Params:								#
#					name: 	input file name(default "file")				#
#						Must be equal to XUpload class instance			#
#					size(optional):input file size(default 40)	 		#
#					maxLength(optional): (default 150)				#
#		setFormButton():	set an button tag for upload						#
#				-Params:								#
#					type: 	button type						#
#					name :button name	 					#
#					value: button text						#
#					xtraJS: javascript code for onClick event			#
#		end():			form ends							#
#													#
#DISCLAIMER:												#
#Distributed "as is", fell free to modify any part of this code.					#
#You can use this for any projects you want, commercial or not.						#
#If you want you can keep the header in the script, else it does not matter.				#
#It would be very kind to email me any suggestions you have or bugs you might find :)			#
#########################################################################################################


class XUploadForm
{
	var $cls_formName;	// form name
	var $cls_formAction;	// form action
	var $cls_formMethod;	// form method (default POST)
	var $cls_formXtraJS;	// for javascript
	var $cls_formEncType;	// form encoding type

	// constructor
	function XUploadForm($action="",$name="myXUploadForm",$method="POST",$xtraJS="")
	{

		$this->cls_formName = $name;
		$this->cls_formAction = $action;
		$this->cls_formMethod = $method;
		$this->cls_formXtraJS = $xtraJS;
		$this->setFormEncType("multipart/form-data");

	}

	## form begins
	## returns nothing
	function begin()
	{
		echo '<form action="'.$this->cls_formAction.'" name="'.$this->cls_formName.'" method="'.$this->cls_formMethod.'" enctype="multipart/form-data"'.$this->cls_formXtraJS.">\n";
	}

	## set form encoding type
	## returns nothing
	function setFormEnctype($encType)
	{
		$this->cls_formEncType = $encType;
	}

	## set max file size
	## returns nothing
	function setFormMaxFileSize( $size = "2097152" ) // default max file size 2MB
	{
		echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$size\">\n";
	}

	## displays an input file
	## returns nothing
	function setFormFileInput( $name = "file" , $size = 40 , $maxLength = 150 )
	{
		echo "<input type=\"file\" name=\"$name\" size=\"$size\" maxlenght=\"$maxLength\"><br>\n";
	}


	## displays an button
	## returns nothing
	function setFormButton( $type = "submit" , $value = "Submit" , $name = "submit" , $xtraJS = "" )
	{
		echo "<input type=\"$type\" name=\"$name\" value=\"$value\" onClick=\"$xtraJS\"><br>\n";
	}

	## form ends
	## returns nothing
	function end()
	{
		echo '</form>'."\n";
	}

} // class ends

?>