<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QCollapsablePanel";
$objPlugin->strDescription = 'A panel the wraps a header and a body panel, where the body panel can be toggled by clicking a button or the header itself.';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "2.0.2";
$objPlugin->strAuthorName = "Vardan Akopian";
$objPlugin->strAuthorEmail = "vakopian+qcubed [at] gmail [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QCollapsablePanel.class.php");
$components[] = new QPluginIncludedClass("QCollapsablePanel", "includes/QCollapsablePanel.class.php");

$components[] = new QPluginExample("example/collapsablepanel.php", "QCollapsablePanel: collapsable panel");
$components[] = new QPluginExampleFile("example/collapsablepanel.php");
$components[] = new QPluginExampleFile("example/collapsablepanel.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
