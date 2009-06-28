<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
		<?php $this->RenderBegin(); ?>

		<div class="instructions">
		<h1 class="instruction_title">QJqDock</h1>

		<p>The Dock - as anyone familiar with a Mac will know - is a set of
		iconic images that expand when rolled over with the cursor, and usually
		perform some action when clicked. This plugin mimics that behaviour by
		transforming a contiguous set of HTML images into an expanding Dock,
		vertical or horizontal, with or without labels.</p>
		
		<p>Basically, all the Dock does is smoothly expand a reduced size image
		towards its full size when the cursor is on or near it. You can specify
		a vertical or horizontal orientation for the Dock, and select the
		direction in which the image should expand and whether to show labels or
		not. The styling and positioning of the Dock is (almost) entirely up to
		you.</p>
		
		<p>If you want to learn more about this plugin, check out the
		<a href="http://www.wizzud.com/jqDock/">jqDock plugin homepage</a> - it
		has a detailed description of the various options that you can set to
		control the style of the Dock.</p>
     </div>

		<div id="dockmenu" style="height:300px">
		<?php
				$this->dckMenuHorizontal->Render();
				$this->dckMenuVertical->Render();
		?>
		</div>
	
	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>