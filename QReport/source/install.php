<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QReport";
$objPlugin->strDescription = 'Plugin that implement is tabular report with pagination supporting free source of data.';
$objPlugin->strVersion = "0.1.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QReport.class.php");
$components[] = new QPluginControlFile("includes/QReportCell.class.php");
$components[] = new QPluginControlFile("includes/QReportCellStyle.class.php");

$components[] = new QPluginExampleFile("example/qreport-tabular.php");
$components[] = new QPluginExampleFile("example/qreport-tabular.tpl.php");
$components[] = new QPluginExampleFile("example/qreport-paginator.php");
$components[] = new QPluginExampleFile("example/qreport-paginator.tpl.php");
$components[] = new QPluginExampleFile("example/testdata.csv");

$components[] = new QPluginIncludedClass("QReport", "includes/QReport.class.php");
$components[] = new QPluginIncludedClass("QReportCell", "includes/QReportCell.class.php");
$components[] = new QPluginIncludedClass("QReportCellStyle", "includes/QReportCellStyle.class.php");

$components[] = new QPluginExample("example/qreport-tabular.php", "Example to use a simple tabular report");
$components[] = new QPluginExample("example/qreport-paginator.php", "Example to use a paginatior tabular report");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>
