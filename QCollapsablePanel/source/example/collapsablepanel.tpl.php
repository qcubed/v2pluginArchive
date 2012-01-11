<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<style type="text/css">
		div.dtp-example { margin: 10px; } 
		.toggle_button { float: left; padding: 5px; margin-right: 5px; }
		div.cp {width: 500px; }
		div.cp_header { border: 1px solid black; padding: 5px; background-color: gold; }
		div.cp_body { border: 1px solid black; padding: 5px; }
	</style>

	<div class="instructions">
		<h1 class="instruction_title">QCollapsablePanel: collapsable panel control</h1>
		A panel the wraps a header and a body panel, where the body panel can be toggled by clicking a button or the header itself.
	</div>

	<div class="dtp-example">
		<?php $this->cp->Render(); ?><br/>
	</div>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
