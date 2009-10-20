<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">Time Series charts with QFlot</h1>
		
		<p>This example explain how create a time series chart using QFlot at client side, besides this example render data used to generate the chart using a datagrid</p>
	</div>
		
	   	<div id="Flot" title="flot">
	    	<?php $this->flotReport->Render(); ?>
	   	</div>
	   	
	   	<br/><br/>
	   	
		<div id=FlotDtg>   	
   			<?php $this->dtgFlotDataGrid->Render(); ?>
   		</div>	
   	
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>