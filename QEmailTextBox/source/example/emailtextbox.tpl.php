<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">QPhoneTextBox: Formatting and Validation of Phone Numbers</h1>

		<b>QEmailTextBox</b> is a simple extension of the <b>QTextBox</b> control that 
		allows you to easily validate the email that users provide. 
		
		Please try this control typing a wrong and correct emails.

	        If you do end up writing an extension of this control, please do share it with the 
		<a href="http://qcu.be" target="_blank">QCubed community</a>.
	</div>

	<?php $this->txtEmail->RenderWithName(); ?>
	<?php $this->btnSubmit->Render(); ?>
			
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
