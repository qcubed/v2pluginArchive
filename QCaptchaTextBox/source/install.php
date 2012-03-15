<?php

$objPlugin = new QPlugin();
$objPlugin->strName = "QCaptchaTextBox";
$objPlugin->strDescription = 'Render a textbox with Captcha Image to prevent Spam bot to hack a form.';
$objPlugin->strVersion = "1.1";
$objPlugin->strPlatformVersion = "2.0.2";
$objPlugin->strAuthorName = "Mike Quirion";
$objPlugin->strAuthorEmail ="mikequirion [at] gmail [dot] com";

$components = array();

//Include all required Control
$components[] = new QPluginControlFile("includes/QCaptchaTextBox.class.php");
$components[] = new QPluginControlFile("includes/QCaptchaImage.class.php");
$components[] = new QPluginControlFile("includes/QCaptchaFilters.class.php");

//Include default Fonts
$components[] = new QPluginControlFile("fonts/bluehigl.ttf");
$components[] = new QPluginControlFile("fonts/typewriterA602.ttf");

$components[] = new QPluginImageFile("images/errorsign.jpg");
$components[] = new QPluginImageFile("captcha.php");


//TODO Create an example.
$components[] = new QPluginExampleFile("example/QCaptchaTextBoxExample.php");
$components[] = new QPluginExampleFile("example/QCaptchaTextBoxExample.tpl.php");

$components[] = new QPluginIncludedClass("QCaptchaTextBox", "includes/QCaptchaTextBox.class.php");
$components[] = new QPluginIncludedClass("QCaptchaImage", "includes/QCaptchaImage.class.php");
$components[] = new QPluginIncludedClass("QCaptchaFilters", "includes/QCaptchaFilters.class.php");

$components[] = new QPluginExample("example/QCaptchaTextBoxExample.php", "QCaptchaTextBox: Simple example using QCaptcha Textbox");

$objPlugin->addComponents($components);
$objPlugin->install();

?>
