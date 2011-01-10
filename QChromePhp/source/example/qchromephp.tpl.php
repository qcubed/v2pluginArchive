<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<div class="instruction_title">Curling using QCurl</div>
		<b>QChromePhp</b> offers a Firebug like featire for the log console of Google Chrome. Just 
		use it as QFirebug. For instance: 
		<code>
			QChromePhp::log('message');
		</code><br /><br />
		
	</div>
	<br /><br /><br /><br /><br /><br />
		<?php $this->btnRunChromePhp->Render();?>
	</div>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>