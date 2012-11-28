<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
<?php $this->RenderBegin(); ?>

<div class="instructions">
	<h1 class="instruction_title">Displaying an objListPanel with QListPanel</h1>
	<p>The QListPanel is a control that forms a html-list from it's child controls.</p>
	<p>It can be useful to construct navigational panels from QLinkButton objects, for example.</p>
	<p>This plugin provides a css file with qq_list_panel class defined to customize list look-and-feel. Feel free to edit it or provide your own style.</p>
</div>
<div style="margin-left: 100px">
	<?php $this->objListPanel->Render(); ?>
</div>

<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
