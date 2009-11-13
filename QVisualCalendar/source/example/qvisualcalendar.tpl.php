<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions"> 
		<div class="instruction_title">Inline Visual Calendars</div>
		
		<b>QVisualCalendar</b> offers a way create fancy calendars controls. 
		This control render a Inline calendar inside the form, useful when you don't want to use popup or listbox to
		capture dates<br /><br />
	</div>		
		
	<div style="margin-left: 150px;">	
		<?php $this->calStartCalendar->RenderWithName(); ?>
		<?php $this->calEndCalendar->RenderWithName(); ?>
		<?php $this->btnAction->Render();?>
	</div>
	
<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>