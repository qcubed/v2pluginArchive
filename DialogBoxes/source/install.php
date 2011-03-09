<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "DialogBoxes";
$objPlugin->strDescription = 'A collection of server-side "modal" dialog boxes: ' . 
	'QConfirmationDialog, QTextBoxPromptDialog, QRadioButtonPromptDialog.';
$objPlugin->strVersion = "0.2";
$objPlugin->strPlatformVersion = "2.0";
$objPlugin->strAuthorName = "Alex Weinstein, a.k.a. alex94040 / updated by darq";
$objPlugin->strAuthorEmail ="alex94040 [at] yahoo [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QPromptDialog.class.php");
$components[] = new QPluginControlFile("includes/QTextBoxPromptDialog.class.php");
$components[] = new QPluginControlFile("includes/QRadioButtonPromptDialog.class.php");
$components[] = new QPluginControlFile("includes/QConfirmationDialog.class.php");

$components[] = new QPluginMiscIncludedFile("includes/QConfirmationDialog.tpl.php");
$components[] = new QPluginMiscIncludedFile("includes/QRadioButtonPromptDialog.tpl.php");
$components[] = new QPluginMiscIncludedFile("includes/QTextBoxPromptDialog.tpl.php");

$components[] = new QPluginExampleFile("example/more_dialog_boxes.php");
$components[] = new QPluginExampleFile("example/more_dialog_boxes.tpl.php");

$components[] = new QPluginIncludedClass("QPromptDialog", 				"includes/QPromptDialog.class.php");
$components[] = new QPluginIncludedClass("QTextBoxPromptDialog", 		"includes/QTextBoxPromptDialog.class.php");
$components[] = new QPluginIncludedClass("QRadioButtonPromptDialog", 	"includes/QRadioButtonPromptDialog.class.php");
$components[] = new QPluginIncludedClass("QConfirmationDialog", 		"includes/QConfirmationDialog.class.php");

$components[] = new QPluginExample("example/more_dialog_boxes.php", "* Pre-built Dialog Boxes: Confirmations and Prompts");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>