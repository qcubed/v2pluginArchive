<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QJqScrollTo";
$objPlugin->strDescription = 'qcubed plugin for jQuery ScrollTo - Smooth Scrolling to any jQuery/DOM Element (http://balupton.github.com/jquery-scrollto/demo/)';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "2.1";
$objPlugin->strAuthorName = "Oleg Abrosimov";
$objPlugin->strAuthorEmail = "olegabr [at] yandex [dot] ru";

$components = array();

$components[] = new QPluginJsFile("js/jquery-scrollto/jquery.scrollto.js");
$components[] = new QPluginJsFile("js/jquery-scrollto/jquery.scrollto.min.js");

$components[] = new QPluginControlFile("includes/QJqScrollTo.class.php");
$components[] = new QPluginControlFile("includes/QJqScrollToBase.class.php");
$components[] = new QPluginControlFile("includes/QJqScrollToGen.class.php");
$components[] = new QPluginIncludedClass("QJQScrollToAction", "includes/QJqScrollTo.class.php");
$components[] = new QPluginIncludedClass("QJQScrollToActionBase", "includes/QJqScrollToBase.class.php");
$components[] = new QPluginIncludedClass("QJQScrollToActionGen", "includes/QJqScrollToGen.class.php");

$components[] = new QPluginExample("example/jqscrollto.php", "qcubed plugin for jQuery ScrollTo - Smooth Scrolling to any jQuery/DOM Element");
$components[] = new QPluginExampleFile("example/jqscrollto.php");
$components[] = new QPluginExampleFile("example/jqscrollto.tpl.php");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
