<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QDataGridExporterButton";
$objPlugin->strDescription = 'Add a Buttom to datagrid to export data in CVS or XLS.';
$objPlugin->strVersion = "0.4";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Gianni Rossini";
$objPlugin->strAuthorEmail = "magiainformatica [at] alice [dot] it";

$components = array();

$components[] = new QPluginControlFile("includes/QDataGridExporterButton.class.php");

$components[] = new QPluginExampleFile("example/datagridexport.php");
$components[] = new QPluginExampleFile("example/datagridexport.tpl.php");

$components[] = new QPluginIncludedClass("QDataGridExporterButton","includes/QDataGridExporterButton.class.php");

$components[] = new QPluginExample("example/datagridexport.php", "QDataGridExporterButton: Export datagrid to cvs or XLS");

$objPlugin->addComponents($components);
$objPlugin->install();

?>