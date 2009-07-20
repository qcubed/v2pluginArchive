<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
		<?php $this->RenderBegin(); ?>

		<div class="instructions">
		<h1 class="instruction_title">QSlider</h1>
			
		<p>The Slider - Is a graphical componet to enable user to select a value between a range;
		   This QControl enable user to create a Ritch Interface to collect information and use as a regular control.		
		</p>

		<?php $this->objQSliderA->Render(); ?>
		<br><br>
		<?php $this->objQSliderB->Render(); ?>
		<br><br>
		<?php $this->btnSubmit->Render(); ?>
		<?php $this->RenderEnd(); ?>

<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
