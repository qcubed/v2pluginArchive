<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
<?php $this->RenderBegin(); ?>

<div class="instructions">
	<h1 class="instruction_title">QMaskTextBox - Masked Input into a Textbox</h1>
	<p>This is a masked input plugin for the jQuery javascript library. It allows a user to more easily 
	enter fixed width input where you would like them to enter the data in a certain format (dates,phone numbers, etc).</p>
	<p>Adapted from QCodo (<a href="http://www.qcodo.com/wiki/file:old_downloads/qform_controls/qmaskinputtextbox_using_jquery">http://www.qcodo.com/wiki/file:old_downloads/qform_controls/qmaskinputtextbox_using_jquery</a>)
	<p>For more information see: <a href="http://digitalbush.com/projects/masked-input-plugin/">http://digitalbush.com/projects/masked-input-plugin/</a></p>
</div>

<h2>Example</h2>
	<p>Phone Number Mask</p>   
    <p><?php $this->txtMaskPhone->RenderWithName(); ?></p>
	<p>Phone Number Mask with optional Extension</p>            
    <p><?php $this->txtMaskPhoneWithExt->RenderWithName(); ?></p>
	<p>Zip Code Mask (+4 is optional)</p>
    <p><?php $this->txtMaskZip->RenderWithName(); ?></p>
	<p>Social Security Number Mask</p>            
    <p><?php $this->txtMaskSSN->RenderWithName(); ?></p>
	<p>Example of using custom mask</p>            
    <p><?php $this->txtPartNumber->RenderWithName(); ?></p>
	<p>Submit button will test validation on required controls</p>
    <p><?php $this->btnSubmit->RenderWithName(); ?></p>

<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>