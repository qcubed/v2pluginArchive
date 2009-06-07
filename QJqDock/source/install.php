<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "JQjDock";
$objPlugin->strDescription = 'Transform a set of images into a Mac-like Dock menu,' . 
	'horizontal or vertical, with icons that expand on rollover.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QJqDock.class.php");
$components[] = new QPluginControlFile("includes/QJqDockItem.class.php");

$components[] = new QPluginIncludedClass("QJqDock", 		"includes/QJqDock.class.php");
$components[] = new QPluginIncludedClass("QJqDockItem", "includes/QJqDockItem.class.php");

$components[] = new QPluginJsFile("js/jquery.jqDock.min.js");

$components[] = new QPluginExampleFile("example/qjqdock.php");
$components[] = new QPluginExampleFile("example/qjqdock.tpl.php");
$components[] = new QPluginExampleFile("example/home.png");
$components[] = new QPluginExampleFile("example/level.png");
$components[] = new QPluginExampleFile("example/student.png");
$components[] = new QPluginExampleFile("example/students.png");

$components[] = new QPluginExample("example/qjqdock.php", "QJqDoc: jQuery-based Dock control, just like on the Mac");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>