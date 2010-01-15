<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?> 
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">An Introduction to the QDataGridExporter Class</h1>
		
		Using this plugin you can add button that export the datagrid content to cvs.<br>
		               <i> At this level inside a Button you can put only text (now: download CVS)!!</i> 
		<br><br> 
		Setting   blnDowload_all  you can instruct the button to <br> 
		 - DOWNLOAD_ENTIRE_GRID (true) or <br>
		 - DOWNLOAD_CURRENT_PAGE_ONLY (false). <br>
		
	</div>
          <?php $this->btnCVS->Render(); ?>  
          
		<?php $this->dtgPersons->Render(); ?>
          
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>