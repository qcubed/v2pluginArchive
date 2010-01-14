<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QDataGridExporter";
$objPlugin->strDescription = 'Add a Buttom to datagrid to export data in CVS.';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Gianni Rossini";
$objPlugin->strAuthorEmail = "magiainformatica [at] alice [dot] it";

$components = array();

$components[] = new QPluginControlFile("includes/QDataGridExporter.class.php");

$components[] = new QPluginExampleFile("example/datagridexportcvs.php");
$components[] = new QPluginExampleFile("example/datagridexportcvs.tpl.php");

$components[] = new QPluginIncludedClass("QDataGridExporter","includes/QDataGridExporter.class.php");

$components[] = new QPluginExample("example/datagridexportcvs.php", "QDataGridExporter: Export datagrid to cvs");

$objPlugin->addComponents($components);
$objPlugin->install();

?>