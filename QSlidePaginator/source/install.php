<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QSlidePaginator";
$objPlugin->strDescription = 'Alternative data grid paginator based on jQuery slider. Allows easier way to navigate between data grid pages';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Sergej Dugokontov";
$objPlugin->strAuthorEmail ="dugokontov [at] gmail [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QSlidePaginator.class.php");

$components[] = new QPluginCssFile("css/slider.css");

$components[] = new QPluginJsFile("js/jquery.dimensions.js");
$components[] = new QPluginJsFile("js/ui.mouse.js");
$components[] = new QPluginJsFile("js/ui.slider.js");

$components[] = new QPluginImageFile("images/slider-bg-1.png");
$components[] = new QPluginImageFile("images/slider-bg-2.png");
$components[] = new QPluginImageFile("images/slider-handle.gif");
$components[] = new QPluginImageFile("images/slider-next.png");
$components[] = new QPluginImageFile("images/slider-prev.png");


$components[] = new QPluginExampleFile("example/qslidepaginator.php");
$components[] = new QPluginExampleFile("example/qslidepaginator.tpl.php");

$components[] = new QPluginIncludedClass("QSlidePaginator", "includes/QSlidePaginator.class.php");

$components[] = new QPluginExample("example/qslidepaginator.php", "QSliderPaginator: Data Grid Paginator Based on jQuery-based Slider");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
