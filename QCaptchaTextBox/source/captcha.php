<?php
	
	require_once('../../qcubed.inc.php');		

	$strParams = QApplication::QueryString('cId'); 
	
	//Create a CAPTCHA
	$objCaptchaImage = new QCaptchaImage($strParams);
?>