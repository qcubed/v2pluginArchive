<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QFCKEditor";
$objPlugin->strDescription = 'Rich-text, WYSIWYG editor for QCubed - a plugin that bridges QCubed and
	FCKEditor together. Use it anywhere you would use an HTML text area / multiline QTextBox.';
$objPlugin->strVersion = "0.11";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "tronics"; // Restructured into a plugin by alex94040

$components = array();

$components[] = new QPluginControlFile("includes/QFCKEditor.class.php");

$components[] = new QPluginJsFile("fckeditor_config.js");

// Taking the ENTIRE js folder and registering it as a collection of JS files. 
// Not all files in that folder are JS files, but for maintenance reasons, it makes sense 
// to just wrap all of FCKEditor into a single thing - so that when new versions of FCKEditor
// come out, updating the plugin would be simpler. 
$components[] = new QPluginJsFile("js");

$components[] = new QPluginExampleFile("example/fckeditor.php");
$components[] = new QPluginExampleFile("example/fckeditor.tpl.php");

$components[] = new QPluginIncludedClass("QFCKEditor", "includes/QFCKEditor.class.php");

$components[] = new QPluginExample("example/fckeditor.php", "Rich Text Editing with QFCKEditor");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>