<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class SampleForm extends QForm {
		protected $txtWorkPhone;
		protected $txtHomePhone;

		protected function Form_Create() {
			$defaultAreaCode = "650";
			$this->txtWorkPhone = new QPhoneTextBox($this, $defaultAreaCode);
			$this->txtHomePhone = new QPhoneTextBox($this, $defaultAreaCode);
		}		
	}

	SampleForm::Run('SampleForm');
?>