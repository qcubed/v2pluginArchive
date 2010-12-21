<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QJqDateTimePicker";
$objPlugin->strDescription = 'Date time picker control based on <a href="http://trentrichardson.com/examples/timepicker">jQuery date picker plugin</a>.';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "2.0.2";
$objPlugin->strAuthorName = "Vardan Akopian";
$objPlugin->strAuthorEmail = "vakopian+qcubed [at] gmail [dot] com";

$components = array();

$components[] = new QPluginJsFile("js/jquery-ui-timepicker-addon-0.6.2.min.js");
$components[] = new QPluginJsFile("js/jquery-ui-timepicker-addon-0.6.2.js");
$components[] = new QPluginCssFile("css");

$components[] = new QPluginControlFile("includes/QJqDateTimePicker.class.php");
$components[] = new QPluginControlFile("includes/QJqDateTimePickerBase.class.php");
$components[] = new QPluginIncludedClass("QJqDateTimePicker", "includes/QJqDateTimePicker.class.php");
$components[] = new QPluginIncludedClass("QJqDateTimePickerBase", "includes/QJqDateTimePickerBase.class.php");

$components[] = new QPluginExample("example/datetimepicker.php", "QJqDateTimePicker: Date time picker control");
$components[] = new QPluginExampleFile("example/datetimepicker.php");
$components[] = new QPluginExampleFile("example/datetimepicker.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
