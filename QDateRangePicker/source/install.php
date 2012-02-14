<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QDateRangePicker";
$objPlugin->strDescription = 'Date range picker control based on datrangepicker jQuery plugin.';
$objPlugin->strVersion = "0.4";
$objPlugin->strPlatformVersion = "2.0.2";
$objPlugin->strAuthorName = "Vardan Akopian";
$objPlugin->strAuthorEmail = "vakopian+qcubed [at] gmail [dot] com";

$components = array();

$components[] = new QPluginJsFile("js/daterangepicker.jQuery.js");
$components[] = new QPluginCssFile("css");

$components[] = new QPluginControlFile("includes/QDateRangePicker.class.php");
$components[] = new QPluginControlFile("includes/QDateRangePickerBase.class.php");
$components[] = new QPluginMiscIncludedFile("includes/QDateRangePickerPreset.class.php");
$components[] = new QPluginMiscIncludedFile("includes/QDateRangePickerPresetRange.class.php");
$components[] = new QPluginIncludedClass("QDateRangePicker", "includes/QDateRangePicker.class.php");
$components[] = new QPluginIncludedClass("QDateRangePickerBase", "includes/QDateRangePickerBase.class.php");

$components[] = new QPluginExample("example/daterangepicker.php", "QDateRangePicker: Date range picker control");
$components[] = new QPluginExampleFile("example/daterangepicker.php");
$components[] = new QPluginExampleFile("example/daterangepicker.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
