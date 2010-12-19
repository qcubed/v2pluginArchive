<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QEmailTextBox";
$objPlugin->strDescription = 'A sublcass of QTextBox, this control validates valid emails.';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia, a.k.a. enzo";
$objPlugin->strAuthorEmail = "enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QEmailTextBox.class.php");

$components[] = new QPluginExampleFile("example/emailtextbox.php");
$components[] = new QPluginExampleFile("example/emailtextbox.tpl.php");

$components[] = new QPluginIncludedClass("QEmailTextBox","includes/QEmailTextBox.class.php");

$components[] = new QPluginExample("example/emailtextbox.php", "QEmailTextBox: Validate Email Addresses");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
