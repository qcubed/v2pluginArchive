<?php
    $objPlugin = new QPlugin();
    // Add MetaData
    $objPlugin->strName = "QMaskTextBox"; // no spaces allowed
    $objPlugin->strDescription = 'Adapted from QCodo (http://www.qcodo.com/wiki/file:old_downloads/qform_controls/qmaskinputtextbox_using_jquery)
        This is a masked input plugin for the jQuery  javascript library. It allows a user to more easily 
        enter fixed width input where you would like them to enter the data in a certain 
        format (dates,phone numbers, etc).';
    $objPlugin->strVersion = "0.1";
    $objPlugin->strPlatformVersion = "1.1.2"; // version of QCubed that this plugin works well with
    $objPlugin->strAuthorName = "Steven Warren, original work by Zeno Yu";
    
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
    $components[] = new QPluginExample("example/QMaskTextBoxExample.php", "allows a user to more easily enter fixed width input where you would like them to enter the data in a certain format (dates,phone numbers, etc)");
    $objPlugin->addComponents($components);
    
    // Install Plugin
    $objPlugin->install();
    
?>
