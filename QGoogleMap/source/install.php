<?php
$objPlugin = new QPlugin();
$objPlugin->strName = "QGoogleMap"; // no spaces allowed
$objPlugin->strDescription = 'Render a Google Map in a QControl, with many options and multiple addresses.';
$objPlugin->strVersion = "1.0";
$objPlugin->strPlatformVersion = "1.1"; 
$objPlugin->strAuthorName = "D. Scott Carroll, a.k.a. Scottux";
$objPlugin->strAuthorEmail ="d [dot] scott [dot] carroll [at] gmail [dot] com"; 

$files = array();
$files[] = new QPluginControlFile("includes/QGoogleMap.class.php");
$files[] = new QPluginExampleFile("example/QGoogleMapExample.php");
$files[] = new QPluginExampleFile("example/QGoogleMapExample.tpl.php");
$objPlugin->addComponents($files); 

$components = array();
$components[] = new QPluginIncludedClass("QGoogleMap", "includes/QGoogleMap.class.php");
$components[] = new QPluginExample("example/QGoogleMapExample.php", "Test the Google Map API");
$objPlugin->addComponents($components);

$objPlugin->install();
?>