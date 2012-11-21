<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QSelect2ListBox";
$objPlugin->strDescription = 'Selector control based on <a href="http://ivaynberg.github.com/select2/">jQuery select2 plugin</a>.';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "2.1";
$objPlugin->strAuthorName = "Vardan Akopian";
$objPlugin->strAuthorEmail = "vakopian+github [at] gmail [dot] com";

$components = array();

$components[] = new QPluginJsFile("select2-release-3.2/select2.min.js");
$components[] = new QPluginCssFile("select2-release-3.2/select2.css");
$components[] = new QPluginImageFile("select2-release-3.2/select2.png");
$components[] = new QPluginImageFile("select2-release-3.2/select2x2.png");
$components[] = new QPluginImageFile("select2-release-3.2/spinner.gif");

$components[] = new QPluginControlFile("includes/QSelect2ListBox.class.php");
$components[] = new QPluginControlFile("includes/QSelect2ListBoxBase.class.php");
$components[] = new QPluginControlFile("includes/QSelect2ListBoxGen.class.php");
$components[] = new QPluginIncludedClass("QSelect2ListBox", "includes/QSelect2ListBox.class.php");
$components[] = new QPluginIncludedClass("QSelect2ListBoxBase", "includes/QSelect2ListBoxBase.class.php");
$components[] = new QPluginIncludedClass("QSelect2ListBoxGen", "includes/QSelect2ListBoxGen.class.php");

$components[] = new QPluginExample("example/select2listbox.php", "QSelect2ListBox: QSelect2ListBox: selector control based on select2 JQuery plugin");
$components[] = new QPluginExampleFile("example/select2listbox.php");
$components[] = new QPluginExampleFile("example/select2listbox.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
