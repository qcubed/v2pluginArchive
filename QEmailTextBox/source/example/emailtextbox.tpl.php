<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">QEmailTextBox: Validation of Email Addresses</h1>

		<b>QEmailTextBox</b> control is a simple extension of the <b>QTextBox</b>
		control that allows you to easily validate the email address that the user provides. <br /><br />
		
		Use it just like a QTextBox whenever you want to validate email addresses.<br /><br />
	</div>

	Enter an email address: <?php $this->txtEmail->RenderWithError(); ?><br /><br />
	<?php $this->btnSubmit->Render(); ?><br /><br />
	<?php $this->lblFormSubmissionResult->Render(); ?>
			
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
