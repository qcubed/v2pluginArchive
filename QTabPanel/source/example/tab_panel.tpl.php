<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<div class="instruction_title">Tab Panels</div>

		This is just a simple example to show how we could create in an easy way tab to wrap 
		our control in order to provide a fancy interface to our user.
		
		Tab panel enable to crea tabs inside other tabs as you can see in the tab # one.
		
		We create our tabs hierarchy on our form , but in our template we just need render the main parent tab. 
		
		Note that this control use css, so we could change the look and fell accordingly our needs.
	</div>
	<div id="tabpanel" style="clear: both">
	<?php 
		$this->tabPanel->Render();
		$this->btnSave->Render();
		$this->btnCancel->Render();
	?>
	</div>
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>