<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

	<div class="instructions">
		<h1 class="instruction_title">Rich Text Editing with QFCKEditor</h1>

		<p>This plugin offers an integrated open-source rich-text WYSIWYG
		editor, <a href="http://www.fckeditor.net">FCKEditor</a>, to be used as a control
		inside QCubed. The idea here is "what you see is what you get": the user
		can do a little bit of text processing right inside of your application:
		make text bold, introduce bullets, etc - all with an intuitive
		point-and-click interface, a-la Microsoft Word, and without security
		risks for your server.</p>
		
		<p>To use it, just instantiate a <strong>QFCKEditor</strong> control the same way you
		would a <strong>QTextBox</strong>. Set its width and height, and you're good to go.
		One important gotcha: the QForm that's hosting <strong>QFCKEditor</strong> must use
		<strong>QServerAction</strong> - QAjaxAction will not work well with the rich-text
		editor.</p>
		
		<p>If you want to make customizations to how the <strong>QFCKEditor</strong> looks (for
		example, change the color scheme of the toolbar) or what the users can
		do with it (for example, allow them to add tables), you should know about
		the <strong>QFCKEditor</strong> configuration file: <em>/assets/js/fckeditor_config.js</em>.
		To learn more about the options you can specify in this file, refer to the
		<a href="http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options">
		FCKEditor configuration documentation</a>.</p>
	</div>

	<p><?php $this->txtInput->Render() ?></p>
	<p><?php $this->btnButton->Render(); ?></p>
	<p><?php $this->lblMessage->Render(); ?></p>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>