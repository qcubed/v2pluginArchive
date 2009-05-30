<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QPhoneTextBox";
$objPlugin->strDescription = 'A sublcass of QTextBox, this control validates the input ' . 
	'based on the North American phone format of (xxx) xxx-xxxx, and reformats the input ' . 
	'if it is entered differently.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Alex Weinstein, a.k.a. alex94040";
$objPlugin->strAuthorEmail ="alex94040 [at] yahoo [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QPhoneTextBox.class.php");

$components[] = new QPluginJsFile("js/phonetextbox.js");

$components[] = new QPluginExampleFile("example/phonetextbox.php");
$components[] = new QPluginExampleFile("example/phonetextbox.tpl.php");

$components[] = new QPluginIncludedClass("QPhoneTextBox", 				"includes/QPhoneTextBox.class.php");

$components[] = new QPluginExample("example/phonetextbox.php", "QPhoneTextBox: validate and format phone numbers");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>