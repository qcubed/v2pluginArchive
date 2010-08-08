<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QAnyTimeBox";
$objPlugin->strDescription = 'Date time picker control based on Any+Time jQuery plugin.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "2.0.1";
$objPlugin->strAuthorName = "Vardan Akopian";
$objPlugin->strAuthorEmail = "vakopian+qcubed [at] gmail [dot] com";

$components = array();

$components[] = new QPluginJsFile("js/anytimec.js");
$components[] = new QPluginCssFile("css/anytimec.css");

$components[] = new QPluginControlFile("includes/QAnyTimeBox.class.php");
$components[] = new QPluginControlFile("includes/QAnyTimeBoxBase.class.php");
$components[] = new QPluginIncludedClass("QAnyTimeBox", "includes/QAnyTimeBox.class.php");
$components[] = new QPluginIncludedClass("QAnyTimeBoxBase", "includes/QAnyTimeBoxBase.class.php");

$components[] = new QPluginExample("example/anytime.php", "QAnyTimeBox: Date time picker control");
$components[] = new QPluginExampleFile("example/anytime.php");
$components[] = new QPluginExampleFile("example/anytime.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
