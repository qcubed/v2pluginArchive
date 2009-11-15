<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QVisualCalendar";
$objPlugin->strDescription = 'A JS Inline Visual Calendar';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QVisualCalendar.class.php");

$components[] = new QPluginCssFile("css/qvisualcalendar.css");

$components[] = new QPluginExampleFile("example/qvisualcalendar.php");
$components[] = new QPluginExampleFile("example/qvisualcalendar.tpl.php");

$components[] = new QPluginIncludedClass("QVisualCalendar", "includes/QVisualCalendar.class.php");

$components[] = new QPluginExample("example/qvisualcalendar.php", "QVisualCalendar: JS Inline Calendar");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
