<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QDataGridExporterButton";
$objPlugin->strDescription = 'Add a button to a datagrid to export its data in CVS or XLS formats.';
$objPlugin->strVersion = "0.8";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Gianni Rossini";
$objPlugin->strAuthorEmail = "magiainformatica [at] alice [dot] it";

$components = array();

$components[] = new QPluginControlFile("includes/QDataGridExporterButton.class.php");
$components[] = new QPluginIncludedClass("QDataGridExporterButton", "includes/QDataGridExporterButton.class.php");

$components[] = new QPluginExample("example/datagridexport.php", "QDataGridExporterButton: Export datagrid to a CSV or XLS file");
$components[] = new QPluginExampleFile("example/datagridexport.php");
$components[] = new QPluginExampleFile("example/datagridexport.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
