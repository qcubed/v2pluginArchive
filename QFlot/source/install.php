<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QFlot";
$objPlugin->strDescription = 'Use JS flot library to create charts in QCodo using client side';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QFlot.class.php");
$components[] = new QPluginControlFile("includes/QFlotSeries.class.php");

$components[] = new QPluginIncludedClass("QFlot", 		"includes/QFlot.class.php");
$components[] = new QPluginIncludedClass("QFlotSeries", "includes/QFlotSeries.class.php");

$components[] = new QPluginJsFile("js/jquery.flot.pack.js");
$components[] = new QPluginJsFile("js/excanvas.pack.js");

$components[] = new QPluginExampleFile("example/qflot-bar.php");
$components[] = new QPluginExampleFile("example/qflot-bar.tpl.php");
$components[] = new QPluginExampleFile("example/qflot-timeseries.php");
$components[] = new QPluginExampleFile("example/qflot-timeseries.tpl.php");

$components[] = new QPluginExample("example/qflot-bar.php", "QFlot: Generate a bar chart using JS");
$components[] = new QPluginExample("example/qflot-timeseries.php", "QFlot Series: Generate a time series chart using JS");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>