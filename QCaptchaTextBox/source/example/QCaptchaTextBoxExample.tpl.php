<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>

    <div class="instructions">				
        <div class="instruction_title">QCaptchaTextBox</div>
        <p><b>QCaptchaTextBox</b> Will add a textbox with vaildation code to your form to prevent Spam.</p> 
				<p>The control generates a string using randomly selected font that can be found in the <b>includes/qcubed/plugins/QCaptchaTextBox/fonts</b> 
				folder. So feel free to add your own fonts if you need to change the way your Captcha is rendered. </p>				
        <p><b>Availables Options to alter the behaviour of the Captcha.</b></p>        
				<p><b>General Captcha Options</b></p>
				<ul>
					<li>CssClass : Alter wrapper CSS Class for styling purpose. <small>(default = captchatextbox)<small></small></li>						
					<li>Length : Specify the Number of Characters visible. <small>(default = 6)</small></li>						
					<li>ImageHeight : Height of the Captcha image in pixel <small>(default = 75)</small></li>
				</ul>
				<p><b>Captcha color options</b></p>
				<ul>
					<li>rgbForeColor : Main text Color provided in the following format : array(int, int, int). <small>(default = array(0,0,0))</small></li>						
					<li>rgbSignColor : Background sings Color provided in the following format : array(int, int, int). <small>(default = array(128, 128, 128))</small></li>						
					<li>rgbBackgroundColor : Background Color provided in the following format : array(int, int, int). <small>(default = array (255, 255, 255))</small></li>						
				</ul>
				<p><b>Captcha String options</b></p>
				<ul>
					<li>AllowUpperCaseLetter : include Upper case Letters in the generation. <small>(default = true)</small></li>
					<li>AllowLowerCaseLetter : include Upper case Letters in the generation. <small>(default = true)</small></li>
					<li>AllowNumbers : include numbers in the generation.<small>(default = false)</small></li>
					<li>blnCaseSensitive : Validate character case when Comparing Image text to user Input.<small>(default = true)</small></li>
				</ul>
				<p><b>Available Image Filters options</b></p>
				<ul>
					<li>blnAddSign : Add character in the background to strengthen the Captcha <small>(default = true)</small></li>
					<li>blnAddNoise : Add Noise to the Image. <small>(default = false)</small></li>
					<li>blnAddBlur : Add Blur to the Image <small>(default = false)</small></li>
					<li>blnAddBlur : Add Blur to the Image <small>(default = false)</small></li>
				</ul>
    </div>
		<div>
	<?php $this->txtCaptcha1->Render(); ?>
			<br />
	<?php $this->lblCaptcha1->Render(); ?>
			<br /><br />
	<?php $this->btnCaptcha1->Render(); ?>		
		</div>
		<br />
		<div>
	<?php $this->txtCaptcha2->Render(); ?>
			<br />
	<?php $this->lblCaptcha2->Render(); ?>
			<br /><br />
	<?php $this->btnCaptcha2->Render(); ?>		
		</div>

	<?php $this->RenderEnd(); ?>
<?php require(__DOCROOT__ . __EXAMPLES__ . '/includes/footer.inc.php'); ?>