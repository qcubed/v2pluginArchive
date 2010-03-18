<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<div class="instruction_title">Tabular Interfaces using QTabPanel</div>
		<b>QTabPanel</b> offers a way to wrap a tabular interface, similar to what you
		frequently see in rich-client applications. <br /><br />
		
		Using it is really simple: create a container <b>QTabPanel</b> control. Then,
		create <b>QTabPanelSections</b>, one for each tab, specifying the <b>QTabPanel</b> as
		their parent. Remember how you have to pass the parent in the constructor of any
		<b>QControl</b>? Here, you pass in the <b>QTabPanel</b>, not the <b>$this</b>:<br />
		
		<div style="padding-left: 50px">
			<code>
				$this->myTabPanel = new QTabPanel($this);<br />
				$sectionA = new QTabPanelSection($this->myTabPanel);<br />
				$sectionB = new QTabPanelSection($this->myTabPanel);
			</code>
		</div>
		<br>
			
		Then, just add your QControls to the right sections - the way to do it is again
		by specifying the section as the parent parameter in the QControl constructor. So
		really, what you're doing is specifying a hierarchy of visual elements. The root of the
		hierarchy is the parent QForm; it hosts a tab panel; the tab panel hosts the sections; each of the sections
		hosts one or more controls.<br /><br />
		
		You may also host <b>QTabPanelSection</b>'s inside other <b>QTabPanelSection</b>,
		thus creating a tabbed control inside a tab. This functionality is currently
		experimental. <br /><br />
		
		Note that this control uses CSS extensively, so it's really easy , so we could change the look and fell accordingly our needs.
	</div>
	<div id="tabpanel" style="clear: both">
	<?php 
		$this->tabPanel->Render();
	?>
		<br /><br />		
	<?php
		$this->btnSave->Render();
		$this->btnCancel->Render();
	?>
	</div>
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>