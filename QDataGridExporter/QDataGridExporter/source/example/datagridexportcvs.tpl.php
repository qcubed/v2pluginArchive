<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?> 
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">An Introduction to the QDataGridExportCVS Class</h1>
		
		You now can add a button that export the datagrid content (all rows) to cvs.
		
	</div>
          <?php $this->btnCVS->Render(); ?>  
          
		<?php $this->dtgPersons->Render(); ?>
          
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>