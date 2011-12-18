<?php
    $objPlugin = new QPlugin();
    // Add MetaData
    $objPlugin->strName = "QMaskTextBox"; // no spaces allowed
    $objPlugin->strDescription = 'A masked input plugin, it allows a user to more easily 
        enter fixed-format input. Supports many built-in formats (date, phone number, SSN) - as well as custom formats.';
    $objPlugin->strVersion = "0.11";
    $objPlugin->strPlatformVersion = "1.1.2"; // version of QCubed that this plugin works well with
    $objPlugin->strAuthorName = "Steven Warren, original work by Zeno Yu; adapted from QCodo";
    
    // Setup Files
    $files = array();
    $files[] = new QPluginControlFile("includes/QMaskTextBox.class.php");
    $files[] = new QPluginJsFile("js/jquery.maskedinput.js");
    $files[] = new QPluginExampleFile("example/QMaskTextBoxExample.php");
    $files[] = new QPluginExampleFile("example/QMaskTextBoxExample.tpl.php");
    $objPlugin->addComponents($files); 
    
    // Setup Class Includes
    $components = array();
    $components[] = new QPluginIncludedClass("QMaskTextBox", "includes/QMaskTextBox.class.php");
    $objPlugin->addComponents($components);
    
    // Setup Example Files
    $components = array();
    // First parameter is the path to the file, relative to the root of your plugin.
    // Second parameter is the description of the example.
    $components[] = new QPluginExample("example/QMaskTextBoxExample.php", "Support fixed-format text entry with QMastTextBox");
    $objPlugin->addComponents($components);
    
    // Install Plugin
    $objPlugin->install();
?>
