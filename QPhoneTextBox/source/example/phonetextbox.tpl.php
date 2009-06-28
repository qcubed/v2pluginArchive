<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">QPhoneTextBox: Formatting and Validation of Phone Numbers</h1>

		<b>QPhoneTextBox</b> is a simple extension of the <b>QTextBox</b> control that 
		allows you to easily validate and format the phone numbers that users provide. 
		That format is <i>(xxx) xxx-xxxx</i>. Validation and re-formatting happen when
		the user tabs out or somehow else leaves the <b>QPhoneTextBox</b>, giving focus
		to another control.<br/><br/>
		
		If the user enters something different - for example, a phone number without 
		spaces like <i>1112223344</i>, it will be reformatted to <i>(111) 222-3344</i>. 
		Same with inputs like <i>111-222-3344</i>, etc.<br/><br/>
		
		<b>QPhoneTextBox</b> allows you to specify an optional default area code - in those cases
		when you can predict what the user's area code most likely is. In the example below,
		we're using 650 as the default area code. That said, the user can freely delete
		that default and put in any area code they want.<br/><br/>
				
		Note that the control currently supports only North American phone formats - 
		it can be easily extended to support other formats as well. If you do end up
		writing an extension of this control, please do share it with the 
		<a href="http://qcu.be" target="_blank">QCubed community</a>.
	</div>

	<p>Home Phone: <?php $this->txtHomePhone->Render(); ?></p>
	<p>Work Phone: <?php $this->txtWorkPhone->Render(); ?></p>
			
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>