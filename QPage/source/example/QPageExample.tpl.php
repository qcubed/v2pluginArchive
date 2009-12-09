<?php $this->RenderBegin(); ?>
	<div class="instructions">
		<div class="instruction_title">QPage</div>
		<p>A <strong>QPage</strong> is extended from QForm to produce the
		entire XHTML head and body structure, not just the form tag. This allows
		for individual pages to override titles, meta tags, script and css
		includes, etc. Instead of calling header and footer includes as well as
		RenderBegin() and RenderEnd() in the template, just use RenderBegin()
		and RenderEnd() and then extend QPage to add custom default
		header/footer/menu structures etc.</p>
	</div>
	<?php $this->strExampleLabel->Render(); ?>
<?php $this->RenderEnd(); ?>