<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QChromePhp";
$objPlugin->strDescription = '.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "2.0";
$objPlugin->strAuthorName = "Helge Dzierzon";
$objPlugin->strAuthorEmail ="dochelge [at] gmail [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QChromePhp.class.php");
$components[] = new QPluginControlFile("includes/ChromePhp.php");

$components[] = new QPluginExampleFile("example/qchromephp.php");
$components[] = new QPluginExampleFile("example/qchromephp.tpl.php");

$components[] = new QPluginIncludedClass("QChromePhp", "includes/QChromePhp.class.php");

$components[] = new QPluginExample("example/qchromephp.php", "QChromePhp: Using QChromePhp in QCubed 1.1/2.0");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
