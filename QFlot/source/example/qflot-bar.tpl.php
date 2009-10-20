<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">Bar charts with QFlot</h1>
		
		<p>This example explain how create a bar chart using QFlot at client side</p>
		
	</div>
		
   	<div id="Flot" title="flot">
    	<?php $this->flotReport->Render(); ?>
   	</div>
   	
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>