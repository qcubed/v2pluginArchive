<?php
require('../../../../includes/configuration/prepend.inc.php');

class QCaptchaTextBoxExample extends QForm {
	/** Default Captcha Text Box */
	protected $txtCaptcha1;
	protected $lblCaptcha1 ;
	protected $btnCaptcha1 ;	
	
	/** Captcha with modified styling */
	protected $txtCaptcha2;
	protected $lblCaptcha2 ;
	protected $btnCaptcha2 ;	

	protected function Form_Create() {	
		$this->txtCaptcha1 = new QCaptchaTextbox($this) ;		
		$this->lblCaptcha1 = new QLabel($this) ;
		$this->lblCaptcha1->FontBold = true; 
		$this->btnCaptcha1 = new QButton($this); ;
		$this->btnCaptcha1->Text = "Validate Captcha1" ;
		$this->btnCaptcha1->AddAction(new QClickEvent(), new QAjaxAction('btnCaptcha1_Click'));		
		
		$this->txtCaptcha2 = new QCaptchaTextbox($this) ;			
		$this->txtCaptcha2->ForeColor = array(0, 0, 0) ;			
		$this->txtCaptcha2->BackgroundColor = array(225, 225,225) ;			
		$this->txtCaptcha2->SignColor = array(255, 255,255) ;			
		$this->txtCaptcha2->Length = 5 ;								
		$this->txtCaptcha2->AddBlur = true ;								
		$this->lblCaptcha2 = new QLabel($this) ;
		$this->lblCaptcha2->FontBold = true; 
		$this->btnCaptcha2 = new QButton($this); ;
		$this->btnCaptcha2->Text = "Validate Captcha2" ;
		$this->btnCaptcha2->AddAction(new QClickEvent(), new QAjaxAction('btnCaptcha2_Click'));
		
	}
	
	protected function btnCaptcha1_Click($strFormId, $strControlId, $strParameter) {			
		if ($this->txtCaptcha1->Validate()) {
			$this->lblCaptcha1->Text = "Captcha1 Validation Successful." ; 
			$this->lblCaptcha1->ForeColor = "#0F0" ; 
		}
		else {
			$this->lblCaptcha1->Text = "Captcha1 Validation Failed" ; 
			$this->lblCaptcha1->ForeColor = "#F00" ; 
		}
	}
	
	protected function btnCaptcha2_Click($strFormId, $strControlId, $strParameter) {			
		if ($this->txtCaptcha2->Validate()){
			$this->lblCaptcha2->Text = "Captcha2 Validation Successful." ; 
			$this->lblCaptcha2->ForeColor = "#0F0" ; 
		}
		else {
			$this->lblCaptcha2->Text = "Captcha2 Validation Failed" ; 
			$this->lblCaptcha2->ForeColor = "#F00" ;  
		}
	}
}
QCaptchaTextBoxExample::Run('QCaptchaTextBoxExample', 'QCaptchaTextBoxExample.tpl.php');
?> 