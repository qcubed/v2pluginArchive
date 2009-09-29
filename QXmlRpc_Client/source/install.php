<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QXmlRpcClient";
$objPlugin->strDescription = 'Plugin that enable to create a XML-RPC client to access XML-RPC services';
$objPlugin->strVersion = "0.1";
$objPlugin->strPlatformVersion = "1.1";
$objPlugin->strAuthorName = "Eduardo Garcia aka enzo";
$objPlugin->strAuthorEmail ="enzo [at] anexusit [dot] com";

$components = array();

$components[] = new QPluginMiscIncludedFile("includes/QXmlRpc_Client.class.php");

$components[] = new QPluginExampleFile("example/qxmlrpc_client.php");
$components[] = new QPluginExampleFile("example/qxmlrpc_client.tpl.php");

$components[] = new QPluginIncludedClass("QXmlRpc_Client", "includes/QXmlRpc_Client.class.php");

$components[] = new QPluginExample("example/qxmlrpc_client.php", "Introduction to XML-RPC Client");

$objPlugin->addComponents($components);
$objPlugin->install();
	
?>