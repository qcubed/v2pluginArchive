<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class SampleForm extends QForm {
		protected $txtEmail;
		protected $btnSubmit;
		protected $lblFormSubmissionResult;
		
		protected function Form_Create() {
			$this->txtEmail = new QEmailTextBox($this);
			$this->txtEmail->Name = QApplication::Translate('Email');

			$this->btnSubmit = new QButton($this);
			$this->btnSubmit->Text = QApplication::Translate('Verify');
			$this->btnSubmit->AddAction(new QClickEvent(), new QAjaxAction('btnSubmit_Click'));
			$this->btnSubmit->PrimaryButton = true;
			$this->btnSubmit->CausesValidation = true;
			
			$this->lblFormSubmissionResult = new QLabel($this);
		}

		protected function btnSubmit_Click($strFormId, $strControlId, $strParameter) {		
			$this->lblFormSubmissionResult->Text = "Email address is valid; QForm passed validatation";
		}		

	}

	SampleForm::Run('SampleForm');
?>
