<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QFirebug";
$objPlugin->strDescription = 'Plugin that eases debugging of QCubed applications through ' .
			'integration with Firebug, an excellent Firefox extension for Javascript debugging.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginMiscIncludedFile("includes/QFirebug.class.php");
$components[] = new QPluginMiscIncludedFile("includes/FirePHP.class.php");
$components[] = new QPluginMiscIncludedFile("includes/fb.php");

$components[] = new QPluginExampleFile("example/qfirebug.php");
$components[] = new QPluginExampleFile("example/qfirebug.tpl.php");
$components[] = new QPluginExampleFile("example/qfirebug.png");

$components[] = new QPluginIncludedClass("QFirebug", "includes/QFirebug.class.php");

$components[] = new QPluginExample("example/qfirebug.php", "Introduction to Debugging with QFirebug");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>