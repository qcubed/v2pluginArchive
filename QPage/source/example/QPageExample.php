<?php
require('../../../../includes/configuration/prepend.inc.php');

class QPageExample extends QPage {
	/*
	 *  A very simple QLabel to show how we are really just extending QForm.
	 */
	protected $strExampleLabel;
	
	protected function Form_Create() {
		parent::Form_Create();
		$this->PageTitle = QApplication::Translate("Example of a QPage");
		$this->Description = QApplication::Translate(
			"QPage Example"
		);
		
		$this->strExampleLabel = new QLabel($this);
		$this->strExampleLabel->Text = "Example QLabel";
	}	
}
QPageExample::Run('QPageExample','QPageExample.tpl.php');
?>