<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QListPanel";
$objPlugin->strDescription = "QListPanel is a control that forms a html-list from it's child controls.";
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "2.1";
$objPlugin->strAuthorName = "Oleg Abrosimov";
$objPlugin->strAuthorEmail = "olegabr [at] yandex [dot] ru";

$components = array();

$components[] = new QPluginCssFile("css/style.css");

$components[] = new QPluginControlFile("includes/QListPanelBase.class.php");
$components[] = new QPluginControlFile("includes/QListPanel.class.php");
$components[] = new QPluginControlFile("includes/QListPanel.tpl.php");

$components[] = new QPluginIncludedClass("QListPanel", "includes/QListPanel.class.php");
$components[] = new QPluginIncludedClass("QListPanelBase", "includes/QListPanelBase.class.php");

$components[] = new QPluginExample("example/list_panel.php", "QListPanel is a control that forms a html-list from its child controls.");
$components[] = new QPluginExampleFile("example/list_panel.php");
$components[] = new QPluginExampleFile("example/list_panel.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
