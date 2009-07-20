<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QSlider";
$objPlugin->strDescription = 'A jQuery-based slider with tick marks that allows the user to pick a value from a pre-defined range.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QSlider.class.php");

$components[] = new QPluginCssFile("css/slider.css");

$components[] = new QPluginJsFile("js/jquery.dimensions.js");
$components[] = new QPluginJsFile("js/ui.mouse.js");
$components[] = new QPluginJsFile("js/ui.slider.js");

$components[] = new QPluginImageFile("images/slider-bg-1.png");
$components[] = new QPluginImageFile("images/slider-bg-2.png");
$components[] = new QPluginImageFile("images/slider-handle.gif");


$components[] = new QPluginExampleFile("example/qslider.php");
$components[] = new QPluginExampleFile("example/qslider.tpl.php");

$components[] = new QPluginIncludedClass("QSlider", "includes/QSlider.class.php");

$components[] = new QPluginExample("example/qslider.php", "QSlider: jQuery-based Slider Control");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
