<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QQConditionRange";
$objPlugin->strDescription = 'Range query for QQuery.';
$objPlugin->strVersion = "0.11";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Vardan Akopian";
$objPlugin->strAuthorEmail = "vakopian+qcubed [at] gmail [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QQConditionRange.class.php");
$components[] = new QPluginIncludedClass("QQConditionRange", "includes/QQConditionRange.class.php");

$components[] = new QPluginExample("example/conditionrange.php", "QQConditionRange: Range query for QQuery");
$components[] = new QPluginExampleFile("example/conditionrange.php");
$components[] = new QPluginExampleFile("example/conditionrange.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
