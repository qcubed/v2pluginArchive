<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QSortable";
$objPlugin->strDescription = 'QCubed implementation of jQuery Sortable plugin. Allow the user to rearrange '.
			'(sort) items of a list into a desired sequence. Tested in 2.0, untested in earlier versions of QCubed.';
$objPlugin->strVersion = "1.0";
$objPlugin->strPlatformVersion = "2.0";
$objPlugin->strAuthorName = "Merrill Kingston, aka LaCeja";
$objPlugin->strAuthorEmail ="mkingston [at] weblinesys [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QSortablePanel.class.php");

$components[] = new QPluginCssFile("css/jquery.sortable.css");

$components[] = new QPluginExampleFile("example/sortabledemo.php");
$components[] = new QPluginExampleFile("example/sortabledemo.tpl.php");
$components[] = new QPluginExampleFile("example/sortablepanel.php");
$components[] = new QPluginExampleFile("example/sortablepanel.tpl.php");

$components[] = new QPluginIncludedClass("QSortablePanel", 		"includes/QSortablePanel.class.php");

$components[] = new QPluginExample("example/sortabledemo.php", "* jQuery Sortable Example");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>