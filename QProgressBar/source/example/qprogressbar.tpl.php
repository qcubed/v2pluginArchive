<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
		<?php $this->RenderBegin(); ?>

		<div class="instructions">
		<h1 class="instruction_title">QProgressBar</h1>
			
		<p>QProgressBar is a jQuery plugin was once upon a time an animated progress bar for jQuery. Its was based on the mootools progressBar by webappers. Now, it is, by popular demand, some funky 	multi-colored progress bar that starts with a THX intro and launches jQuery fireworks when it hits 100%. No not really. Check it out though!
		</p>

		<p>This control is a wrapper for original idea at: <a href="http://t.wits.sg/jquery-progress-bar/">http://t.wits.sg/jquery-progress-bar/</a></p>

		<?php $this->objQProgressBar->Render(); ?>
		<?php $this->btnNext->Render(); ?>		
		<?php $this->btnReset->Render(); ?>				
		<?php $this->RenderEnd(); ?>

<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
