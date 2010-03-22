<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QCurl";
$objPlugin->strDescription = 'Server-side HTTP request wrapper (curl)';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Doc Helge Dzierzon";
$objPlugin->strAuthorEmail ="dochelge [at] gmail [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QCurl.class.php");

$components[] = new QPluginExampleFile("example/qcurl.php");
$components[] = new QPluginExampleFile("example/qcurl.tpl.php");

$components[] = new QPluginIncludedClass("QCurl", "includes/QCurl.class.php");

$components[] = new QPluginExample("example/qcurl.php", "QCurl: Making server-side HTTP requests using a Curl wrapper");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
