<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class SampleForm extends QForm {
		protected $txtEmail;
		protected $btnSubmit;
		
		protected function Form_Create() {

			$this->txtEmail = new QEmailTextBox($this);
			$this->txtEmail->Name = QApplication::Translate('Email');

			$this->btnSubmit = new QButton($this);
			$this->btnSubmit->Text = QApplication::Translate('Submit');
			$this->btnSubmit->AddAction(new QClickEvent(), new QAjaxAction( 'btnSubmit_Click'));
			$this->btnSubmit->PrimaryButton = TRUE;
			$this->btnSubmit->CausesValidation = TRUE;
		}

		protected function btnSubmit_Click($strFormId, $strControlId, $strParameter) {
		
			QApplication::DisplayAlert(QApplication::Translate("Valid E-mail"));
		}		

	}

	SampleForm::Run('SampleForm');
?>
