<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QTabPanel";
$objPlugin->strDescription = 'A jQuery-based Tabs are generally used to break content into multiple sections that can be swapped to save space, much like an accordion.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QTabPanel.class.php");
$components[] = new QPluginControlFile("includes/QTabPanelSection.class.php");

$components[] = new QPluginCssFile("css/jquery.tabs-ie.css");
$components[] = new QPluginCssFile("css/jquery.tabs.css");

$components[] = new QPluginJsFile("js/jquery.tabs.js");

$components[] = new QPluginImageFile("images/tab.png");


$components[] = new QPluginExampleFile("example/tab_panel.php");
$components[] = new QPluginExampleFile("example/tab_panel.tpl.php");

$components[] = new QPluginIncludedClass("QTabPanel", "includes/QTabPanel.class.php");
$components[] = new QPluginIncludedClass("QTabPanelSection", "includes/QTabPanelSection.class.php");

$components[] = new QPluginExample("example/tab_panel.php", "QTabPanel: jQuery-based Tabs Control");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
