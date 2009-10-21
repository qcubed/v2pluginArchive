<?php
require('../../../../includes/configuration/prepend.inc.php');

class XmlRpcForm extends QForm {
	protected $txtState;
	protected $btnRequest;
	protected $lblResults;

	protected function Form_Create() {
		$this->txtState = new QIntegerTextBox($this);
		$this->txtState->Name = QApplication::Translate('State #');

		$this->btnRequest = new QButton($this);
		$this->btnRequest->Text = QApplication::Translate('Request');
		$this->btnRequest->AddAction(new QClickEvent(), new QAjaxAction('btnRequest_Click'));
		$this->btnRequest->PrimaryButton = true;
		
		$this->lblResults = new QLabel($this);
	}

	protected function btnRequest_Click($strFormId, $strControlId, $strParameter) {		
		$client = new QXmlRpc_Client();
		$client->Debug = TRUE;

		$aParams = array(QXmlRpc_Client::prepare((int) $this->txtState->Text));
		
		// Result of making a request is a key-value pair. The first variable
		// is a boolean that indicates success or failure; the second one is
		// an array with the details.  
		list($success, $response) = $client->request('phpxmlrpc.sourceforge.net','/server.php','examples.getStateName',$aParams);

		// If you have the QFirebug plugin install, you'll see additional
		// status messages in Firebug. 
		if (class_exists('QFirebug')) {
			QFirebug::log($client->Log);
		}
		
		if($success) {
			$this->lblResults->Text = "OK " . $response;
		} else {
			$this->lblResults->Text = "Error(" . $response['faultCode']. "): " . $response['faultString'];
		}
	}
}

XmlRpcForm::Run('XmlRpcForm', 'qxmlrpc_client.tpl.php');
?>