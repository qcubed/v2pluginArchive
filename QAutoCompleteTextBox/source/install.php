<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QAutoCompleteTextBox";
$objPlugin->strDescription = 'Two implementations of auto-complete functionality: matching the user '.
			'input against a pre-defined list, showing them the matches: server-side (Ajax)and client-side.';
$objPlugin->strVersion = "0.11";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Alex Weinstein, a.k.a. alex94040";
$objPlugin->strAuthorEmail ="alex94040 [at] yahoo [dot] com";

$components = array();

$components[] = new QPluginControlFile("includes/QAutoCompleteTextBoxBase.class.php");
$components[] = new QPluginControlFile("includes/QAjaxAutoCompleteTextBox.class.php");
$components[] = new QPluginControlFile("includes/QJavaScriptAutoCompleteTextBox.class.php");

$components[] = new QPluginImageFile("images/indicator.gif");

$components[] = new QPluginJsFile("js/jquery.autocomplete.js");
$components[] = new QPluginJsFile("js/jquery.bgiframe.js");

$components[] = new QPluginCssFile("css/jquery.autocomplete.css");

$components[] = new QPluginExampleFile("example/autocomplete.php");
$components[] = new QPluginExampleFile("example/autocomplete.tpl.php");

$components[] = new QPluginIncludedClass("QAutoCompleteTextBoxBase", 		"includes/QAutoCompleteTextBoxBase.class.php");
$components[] = new QPluginIncludedClass("QAjaxAutoCompleteTextBox", 		"includes/QAjaxAutoCompleteTextBox.class.php");
$components[] = new QPluginIncludedClass("QJavaScriptAutoCompleteTextBox", 	"includes/QJavaScriptAutoCompleteTextBox.class.php");

$components[] = new QPluginExample("example/autocomplete.php", "* Auto-complete Textbox Example");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>