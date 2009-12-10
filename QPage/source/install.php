<?php
$objPlugin = new QPlugin();
$objPlugin->strName = "QPage"; // no spaces allowed
$objPlugin->strDescription = 'Takes care of the entire XHTML structure, not just the form.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1"; 
$objPlugin->strAuthorName = "D. Scott Carroll, a.k.a. Scottux";
$objPlugin->strAuthorEmail ="d [dot] scott [dot] carroll [at] gmail [dot] com"; 

$components = array();
$components[] = new QPluginControlFile("includes/QPage.class.php");
$components[] = new QPluginControlFile("includes/QExamplePage.class.php");
$components[] = new QPluginExampleFile("example/QPageExample.php");
$components[] = new QPluginExampleFile("example/QPageExample.tpl.php");

$components[] = new QPluginIncludedClass("QPage", "includes/QPage.class.php");
$components[] = new QPluginIncludedClass("QExamplePage", "includes/QExamplePage.class.php");
$components[] = new QPluginExample("example/QPageExample.php", "QPage Simple Example");

$objPlugin->addComponents($components);
$objPlugin->install();
?>