<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
<?php $this->RenderBegin(); ?>

<div class="instructions">
	<h1 class="instruction_title">ScrollTo plugin functionality</h1>
</div>
<div style="margin-left: 100px">
	<p><?php $this->btnButton1->Render(); ?>&nbsp;<?php $this->btnButton2->Render(); ?></p>
	<?php $this->pnlPanelTop->Render(); ?>
	<p><?php $this->btnButton1Top->Render(); ?></p>
	<?php $this->pnlPanel1->Render(); ?>
	<p><?php $this->btnButton2Top->Render(); ?></p>
	<?php $this->pnlPanel2->Render(); ?>
</div>

<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>
