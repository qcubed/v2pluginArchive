<?php

class QCaptchaImage {

	protected $Length;
	protected $strCaptchaSessionVariable;
	protected $CaptchaString;
	protected $fontpath;
	protected $fonts;
	protected $objParams ;

	public function __construct($strControlId){
		
		$this->objParams = $_SESSION['__CAPTCHA_' . $strControlId . '_PARAMS__'] ;
				
		$this->Length = $this->objParams['Length'] ; 
		$this->strSessionVariable = sprintf("__CAPTCHA_%s__" , $strControlId ) ;
		
		header('Content-type: image/png');
		
		$this->fontpath = __PLUGINS__ . '/QCaptchaTextBox/fonts/';      
		$this->fonts    = $this->getFonts();
		
		if ($this->fonts == FALSE){
			$this->displayError();
			die();
		}

		if (function_exists('imagettftext') == FALSE){
			$this->displayError();
			die();
		}

		$this->stringGen();

		$this->makeCaptcha();

		$_SESSION[$this->strSessionVariable] = $this->CaptchaString;
	}

	protected function displayError (){
		$iheight     = 130;            
		$image       = imagecreate(600, $iheight);
		$errorsign   = imagecreatefromjpeg(__DOCROOT__ . __PLUGIN_ASSETS__ . '/QCaptchaTextBox/gfx/errorsign.jpg');

		imagecopy($image, $errorsign, 1, 1, 1, 1, 180, 120);
		imagepng($image);      
		imagedestroy($image);
	}	

	protected function getFonts (){

		$fonts = array();

		if ($handle = @opendir($this->fontpath)){
			while (($file = readdir($handle)) !== FALSE){
				$extension = strtolower(substr($file, strlen($file) - 3, 3));
				if ($extension == 'ttf'){
				$fonts[] = $file;
				}
			}
			closedir($handle);
		}
		else{
			return FALSE;
		}

		if (count($fonts) == 0){
			return FALSE;
		}
		else{
			return $fonts;
		}

	} 

	protected function getRandFont (){    
		return $this->fontpath . $this->fonts[mt_rand(0, count($this->fonts) - 1)];   
	} 

	protected function stringGen (){
		//Generate uppercase
		if ($this->objParams['AllowUpperCaseLetter'])
			$uppercase  = range('A', 'Z');
		else 
			$uppercase = array();
		//Generate lowercase.
		if ($this->objParams['AllowLowerCaseLetter'])
			$lowercase  = range('a', 'z');
		else
			$lowercase  = array();
		//Generate with numbers.
		if ($this->objParams['AllowNumbers'])
			$numeric    = range(0, 9);
		else
			$numeric    = array(); 
		
		$CharPool   = array_merge($uppercase, $lowercase, $numeric);
		$PoolLength = count($CharPool) - 1;

		for ($i = 0; $i < $this->Length; $i++){
			$this->CaptchaString .= $CharPool[mt_rand(0, $PoolLength)];
		}
	} 

	protected function makeCaptcha (){

		$imagelength = $this->Length * 25 + 16;
		$imageheight = $this->objParams['ImageHeight'];

		$image       = imagecreate($imagelength, $imageheight);

		//$bgcolor     = imagecolorallocate($image, 222, 222, 222);
		$bgcolor     = imagecolorallocate($image, $this->objParams['BackgroundColor'][0], $this->objParams['BackgroundColor'][1], $this->objParams['BackgroundColor'][2]);
		$stringcolor = imagecolorallocate($image, $this->objParams['ForeColor'][0], $this->objParams['ForeColor'][1], $this->objParams['ForeColor'][2]);

		$capFilters      = new QCaptchaFilters();

		if ($this->objParams['AddSign'])
			$capFilters->signs($image, $this->getRandFont(), $this->objParams['SignColor'] );

		for ($i = 0; $i < strlen($this->CaptchaString); $i++) {
			imagettftext($image, 30, mt_rand(-15, 15), $i * 25 + 10,
			mt_rand(30, 70),
			$stringcolor,
			$this->getRandFont(),
			$this->CaptchaString{$i});
		}

		//Add Noise
		if ($this->objParams['AddNoise'])
			$capFilters->noise($image, 10);
		
		//Add Blur
		if ($this->objParams['AddBlur'])
			$capFilters->blur($image, 6);

		imagepng($image);
		imagedestroy($image);

	} //MakeCaptcha

	public function getCaptchaString (){
		return $this->CaptchaString;
	} 
} 
?>