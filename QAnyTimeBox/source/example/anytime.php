<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class ExampleForm extends QForm {
		protected $at1;
		protected $at2;

		protected function Form_Create() {
			$this->at1 = new QAnyTimeBox($this);

			$this->at2 = new QAnyTimeBox($this);
			$this->at2->Earliest = new QDateTime('2009-01-01');
			$this->at2->Latest = new QDateTime('2012-01-01');
			$this->at2->DateTimeFormat = 'MM/DD/YYYY hh:mm:ss zz';
		}
	}

	ExampleForm::Run('ExampleForm');
?>
