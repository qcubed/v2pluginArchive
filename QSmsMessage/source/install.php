<?php

$objPlugin = new QPlugin();

$objPlugin->strName = "QSmsMessage";
$objPlugin->strDescription = 'Extends QEmailMessage to send SMS text messages';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Steven Warren (Allegro)"; 

$files = array();
// example files
$files[] = new QPluginControlFile("includes/QSmsMessage.class.php");
$files[] = new QPluginControlFile("includes/QSmsCarrierType.class.php");
$files[] = new QPluginExampleFile("example/ExamplesForm.php");
$files[] = new QPluginExampleFile("example/ExamplesForm.tpl.php");
$files[] = new QPluginExample("example/ExamplesForm.php", "Use QEmailServer to send SMS Text");
$objPlugin->addComponents($files);

$components = array(); 
$components[] = new QPluginIncludedClass("QSmsMessage", "includes/QSmsMessage.class.php");
$components[] = new QPluginIncludedClass("QSmsCarrierType", "includes/QSmsCarrierType.class.php");
$objPlugin->addComponents($components);
$objPlugin->install();