<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QCurl";
$objPlugin->strDescription = 'A CURL implementaton class to do server side http requests.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Doc Helge Dzierzon";
$objPlugin->strAuthorEmail ="dochelge [at] gmail [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QCurl.class.php");

$components[] = new QPluginExampleFile("example/qcurl.php");
$components[] = new QPluginExampleFile("example/qcurl.tpl.php");

$components[] = new QPluginIncludedClass("QCurl", "includes/QCurl.class.php");

$components[] = new QPluginExample("example/qcurl.php", "QCurl: Using CURL in QCubed 1.1");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
