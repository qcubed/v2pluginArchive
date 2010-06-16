<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
<?php //require(__CONFIGURATION__ . '/header.inc.php'); ?>
   <?php $this->RenderBegin(); ?>

   <div class="instructions">
   <h1 class="instruction_title">QSortablePanel: jQuery-based Sortable List</h1>

		<b>QSortablePanel</b> implements the jQuery sortable to make member items sortable via drag 'n drop.
		Four optional callbacks are included. One callback may be set to call your method each time an item
		is moved.<br /><br />
		Each sortable item must be created as a QPanel, which is added to an array,
		managed by the QSortable plugin. Each member panel must have at least one QLabel control, which
		is designaged as the <b>handle</b>, used to drag the panel within the list to a new location. That
		QLabel Control must have a CSS Class of <b>sortablehandle</b>.  You may have as many text boxes and other
		QLabel controls as desired.  However, a maximum of three buttons are accommodated, each with their own
		callback.  The actions are <b>FirstCallBack</b>, <b>SecondCallBack</b>, or <b>ThirdCallBack</b>.  Each
		 callback will pass the index of the QPanel member of the initiating button.<br /><br />
    The QSortablePanel control also implements the <b>toArray</b> jQuery option.  This allows for retrieving
		a comma delimited list of member QPanel control ID's, with "_li" appended.  Strip off the "_li",
		using preg_replace and you have a list of the QPanel member ID's in the order sorted by the user.<br /><br />
		Requires jQuery-ui and tested with jquery-ui-1.7.2.custom.min.js and QCubed 2.0, specifically.
                                
   </div>


   <?php $this->pnlSortableMaster->Render(); ?>
	 <?php $this->btnAddItems->Render(); $this->txtNewItem->Render(); ?>

   <?php $this->RenderEnd(); ?>

<?php require(__CONFIGURATION__ .'/footer.inc.php'); ?>