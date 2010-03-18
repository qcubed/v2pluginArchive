<?php 

require('../../../../includes/configuration/prepend.inc.php');

require(__DOCROOT__.'/NuNZ/includes/qcubed/plugins/QCurl/includes/QCurl.class.php');

class ExampleForm extends QForm {
	protected $crlControl;
	protected $btnCurl;
	protected $txtURL;
	protected $txtProxy;
	protected $lblHTTPStatus;
	protected $lblError;
	
	protected $strHTML = "";
	
	protected function Form_Create() {
		$this->crlControl = new QCurl("www.gmail.co.nz");
	
		$this->txtURL = new QTextBox($this);
		$this->txtProxy = new QTextBox($this);
		
		$this->lblHTTPStatus = new QLabel($this);
		$this->lblHTTPStatus->ForeColor = 'red';
		
		
		$this->lblError = new QLabel($this);
		$this->lblError->ForeColor = 'red';
		
		
		$this->btnCurl = new QButton($this);
		$this->btnCurl->Text = 'Curl';
		$this->btnCurl->AddAction(new QClickEvent(), new QServerAction('btnCurl_Click'));
		$this->btnCurl->CausesValidation = false;
	}
	
	// Override Form Event Handlers as Needed
	
	protected function btnCurl_Click($strFormId, $strControlId, $strParameter) {
		QFirebug::warn("test0");
		if($this->txtProxy->Text){
			$this->crlControl->useProxy(true);
			$this->crlControl->setProxy($this->txtProxy->Text);
		}
		$this->crlControl->createCurl($this->txtURL->Text);
		$this->lblHTTPStatus->Text = $this->crlControl->getHttpStatus();
		$this->lblError->Text = $this->crlControl->getLastError();
		
	}
}

ExampleForm::Run('ExampleForm','qcurl.tpl.php');
?>
