<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>

<?php $this->RenderBegin(); ?>

		<div class="instructions">
			<h1 class="instruction_title">QReport Tabular</h1>
				
			<p>Some times we need create simple reports but using free data, we don't need reach the information from database or using DB model structure, do this task
				using QDataGrid could  be so hard, for this reason appear qreport to be simple and util to create reports.</p>
				
				
			<p>This example use a QReport plugin to prepare a simple tabular report using free source data,
			   this example don't use any DB abstraction
			</p>
		</div>
		<div style="margin-left:25%;">
		 	<?php $this->rptVendor->Render(); ?>
		</div>

<?php $this->RenderEnd(); ?>

<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>