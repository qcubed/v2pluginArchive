<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">Exporting Datagrid contents with QDataGridExporterButton</h1>

		Using this plugin you can add a button to your QForm that will let your users export data
		from a datagrid within your web application. The exported data can be in one of the following
		formats:
		<ul>
			<li>CSV: comma-separate plain text file</li>
			<li>XLS: Microsoft Office Excel file</li>
		</ul>
		
		The data that gets exported may be either:
		<ul>
			<li>the full contents of the datagrid, irrespective of any pagination</li>
			<li>only the current page that the user is looking at within the datagrid</li>
		</ul>
		
		Using the <b>QDataGridExporterButton</b> control is pretty easy - just create it like 
		you 		would create any other <b>QButton</b>, but pass in a <b>QDataGrid</b> control 
		as a parameter. Then, set the necessary parameters (ex. format of the output), and you're
		good to go. 
	</div>
		<?php $this->btnCSV->Render(); ?>&nbsp;&nbsp;&nbsp;
		<?php $this->btnXLS->Render(); ?>&nbsp;&nbsp;&nbsp;
		<?php $this->btnCurPage->Render(); ?>

		<?php $this->dtgPersons->Render(); ?>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>