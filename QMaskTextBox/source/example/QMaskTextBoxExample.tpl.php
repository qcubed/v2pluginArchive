<?php require(__INCLUDES__ . '/configuration/header.inc.php'); ?>
<?php $this->RenderBegin(); ?>

<div class="instructions">
<h1 class="instruction_title">QMaskTextBox</h1>
<p>Adapted from QCodo (<a href="http://www.qcodo.com/wiki/file:old_downloads/qform_controls/qmaskinputtextbox_using_jquery">http://www.qcodo.com/wiki/file:old_downloads/qform_controls/qmaskinputtextbox_using_jquery</a>)
This is a masked input plugin for the jQuery  javascript library. It allows a user to more easily 
enter fixed width input where you would like them to enter the data in a certain 
format (dates,phone numbers, etc).</p>
<p>For more information see: <a href="http://digitalbush.com/projects/masked-input-plugin/">http://digitalbush.com/projects/masked-input-plugin/</a></p>
</div>

<h2>Example</h2>
	<p>Example of Phone Mask</p>   
    <p><?php $this->txtMaskPhone->RenderWithName(); ?></p>
	<p>Example of Phone Mask with optional Extension</p>            
    <p><?php $this->txtMaskPhoneWithExt->RenderWithName(); ?></p>
	<p>Example of Zip Code Mask +4 is optional</p>            
    <p><?php $this->txtMaskZip->RenderWithName(); ?></p>
	<p>Example of Social Security Number Mask</p>            
    <p><?php $this->txtMaskSSN->RenderWithName(); ?></p>
	<p>Example of using custom mask</p>            
    <p><?php $this->txtPartNumber->RenderWithName(); ?></p>
	<p>Submit button will test validation on required controls</p>
    <p><?php $this->btnSubmit->RenderWithName(); ?></p>

<?php $this->RenderEnd(); ?>
<?php require(__INCLUDES__ . '/configuration/footer.inc.php'); ?> 