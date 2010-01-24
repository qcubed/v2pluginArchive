<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?> 
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">An Introduction to the QDataGridExporterButton Class</h1>
		
		Using this plugin you can add button that export the datagrid content to cvs or xls.<br>
		               <i> At this level inside a Button you can put only text (now: download CVS or download XLS)!!</i> 

<br><br> 
		To download in xls simply intruct button to do this changing his text<br> 
		 - $this->btnCVS->Text = "download XLS"; 

		<br><br> 
		Setting   blnDowload_all  you can instruct the button to <br> 
		 - ENTIRE_DATAGRID (true) or <br>
		 - CURRENT_PAGE (false). <br>
		<br>
		added a code to prevent Excel from autoconverting Item with number > 1000000000000000 to flot 
		loosing non significant digit - Item is now prefixed wih C: and treated as string by Excel.<br>
		<i>In my app. Part number numeric (char 20) loosed 4 least significant digit so  the 
		exported Excel table was useless....<i>  
		<br> 
		
	</div>
          <?php $this->btnCVS->Render(); ?>  
          
		<?php $this->dtgPersons->Render(); ?>
          
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>