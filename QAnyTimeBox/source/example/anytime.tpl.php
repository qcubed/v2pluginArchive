<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">QAnyTimeBox: Date and time picker</h1>
		<b>QAnyTimeBox</b> is a date and time selection control. It wraps into a QControl the excellent <a href="http://www.ama3.com/anytime//">Any+Time DatePicker/TimePicker AJAX Calendar Widget</a> by Andrew M. Andrews III (SM).
		All the properties of the original jQuery control are supported.
		<br/>
		Example 1 shows the control with default settings.
		<br/>
		Example 2 shows how to set the earliest and latest dates and how to change the format.
	</div>

	<div class="drp-example">
		<strong>1. QAnyTimeBox with default settings</strong><br/>
		<?php $this->at1->Render(); ?><br/>
	</div>
	<br/>

	<div class="drp-example">
	  <strong>2. QAnyTimeBox with Earliest, Latest and DateTimeFormat properties customized</strong><br/>
		<?php $this->at2->Render(); ?><br/>
	</div>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
