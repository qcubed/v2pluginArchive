<?php

$objPlugin = new QPlugin();

$objPlugin->strName = "QSwfObject";
$objPlugin->strDescription = 'Embeds Flash Video (SWF) into QForm';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Steven Warren (Allegro)"; 

$files = array();
// javascript 
$files[] = new QPluginJsFile("js/swfobject.js");
// example files
$files[] = new QPluginExampleFile("example/SwfExample.php");
$files[] = new QPluginExampleFile("example/SwfExample.tpl.php");
$files[] = new QPluginExampleFile("example/test.swf");
// including swf source for express installation courtesy of the swfobject javascript project
$files[] = new QPluginExampleFile("example/src/expressInstall.as");
$files[] = new QPluginExampleFile("example/src/expressInstall.fla");
$files[] = new QPluginExample("example/SwfExample.php", "Embed Flash Video with QSwfObject");
// includes
$files[] = new QPluginControlFile("includes/QSwfObject.class.php", "QSwfObject");
// images 
$files[] = new QPluginImageFile("images/expressInstall.swf");

$objPlugin->addComponents($files);

$components = array(); 
$components[] = new QPluginIncludedClass("QSwfObject", "includes/QSwfObject.class.php");
$objPlugin->addComponents($components);
$objPlugin->install();