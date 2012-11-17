<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QDataTables";
$objPlugin->strDescription = 'table control based on jQuery DataTables plugin.';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "2.1";
$objPlugin->strAuthorName = "Vardan Akopian";
$objPlugin->strAuthorEmail = "vakopian+qcubed [at] gmail [dot] com";

$components = array();

$components[] = new QPluginJsFile("DataTables-1.9.0/media/js/jquery.dataTables.js");
$components[] = new QPluginJsFile("DataTables-1.9.0/media/js/jquery.dataTables.min.js");
$components[] = new QPluginJsFile("DataTables-1.9.0/plugin-apis/media/js");
$components[] = new QPluginCssFile("DataTables-1.9.0/media/css");
$components[] = new QPluginImageFile("DataTables-1.9.0/media/images");

$components[] = new QPluginControlFile("includes/QDataTable.class.php");
$components[] = new QPluginControlFile("includes/QDataTableBase.class.php");
$components[] = new QPluginControlFile("includes/QDataTableGen.class.php");
$components[] = new QPluginIncludedClass("QDataTable", "includes/QDataTable.class.php");
$components[] = new QPluginIncludedClass("QDataTableBase", "includes/QDataTableBase.class.php");
$components[] = new QPluginIncludedClass("QDataTableGen", "includes/QDataTableGen.class.php");

$components[] = new QPluginExample("example/datatable.php", "QDataTables: table control based on jQuery DataTables plugin");
$components[] = new QPluginExampleFile("example/datatable.php");
$components[] = new QPluginExampleFile("example/datatable.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
