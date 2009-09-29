<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">Getting information accross XML-RPC</h1>
		
		<p>In this exaple we will create a XML-RPC client to access a XML-RPC service located at http>//phpxmlrpc.sourceforge.net.</p>
		<p>This service accept a int number between 1 to 51 and return an State Name related with number provided</p>
		
	</div>	 		

		<?php $this->txtState->RenderWithName(); ?>
		<?php $this->btnRequest->Render() ?>
		<br/>
		<?php $this->lblResults->Render(); ?>

<?php $this->RenderEnd(); ?>				
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>