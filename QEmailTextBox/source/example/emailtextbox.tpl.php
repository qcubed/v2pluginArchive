<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">QEmailTextBox: Validation of Email Addresses</h1>

		<p><strong>QEmailTextBox</strong> control is a simple extension of the <strong>QTextBox</strong>
		control that allows you to easily validate the email address that the user provides.</p>
		
		<p>Use it just like a QTextBox whenever you want to validate email addresses.</p>
	</div>

	<p>Enter an email address: <?php $this->txtEmail->RenderWithError(); ?></p>
	<div><?php $this->btnSubmit->Render(); ?></div>
	<p><?php $this->lblFormSubmissionResult->Render(); ?></p>
			
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
