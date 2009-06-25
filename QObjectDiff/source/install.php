<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QObjectDiff";
$objPlugin->strDescription = 'Determine which fields have changed '.
	'in the QForm since the user last saw it: which fields did they edit.';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Alex Weinstein, a.k.a. alex94040";
$objPlugin->strAuthorEmail ="alex94040 [at] yahoo [dot] com";

$components = array();

$components[] = new QPluginMiscIncludedFile("includes/QObjectDiff.class.php");

$components[] = new QPluginExampleFile("example/diff.php");
$components[] = new QPluginExampleFile("example/diff.tpl.php");

$components[] = new QPluginIncludedClass("QObjectDiff", "includes/QObjectDiff.class.php");

$components[] = new QPluginExample("example/diff.php", "* QObjectDiff: What fields changed in my form?");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>