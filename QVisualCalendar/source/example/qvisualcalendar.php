<?php

require('../../../../includes/configuration/prepend.inc.php');

class ExampleForm extends QForm {

	protected $calStartCalendar;
	protected $calEndCalendar;

	protected $btnAction;

	protected function Form_Create() {

		$this->calStartCalendar = new QVisualCalendar($this);
		$this->calStartCalendar->MaxSelectableDate = QDateTime::Now();
		$this->calStartCalendar->Name = "Max Selectable Date: Today";

		$this->calEndCalendar = new QVisualCalendar($this);
		$this->calEndCalendar->MinSelectableDate = QDateTime::Now();
		$this->calEndCalendar->Name = "Min Selectable Date: Today";

		$this->btnAction = new QButton($this);
		$this->btnAction->Text = QApplication::Translate('Get Dates');
		$this->btnAction->AddAction(new QClickEvent(), new QAjaxAction('btnAction_Click'));
			
	}

	protected function btnAction_Click($strFormId, $strControlId, $strParameter) {
		
		if($this->calStartCalendar->SelectedDate != '' && 
			$this->calEndCalendar->SelectedDate != '')
			{
				QApplication::DisplayAlert(QApplication::Translate("Start Date:") . " " .  $this->calStartCalendar->SelectedDate);
				QApplication::DisplayAlert(QApplication::Translate("End Date:") . " " . $this->calEndCalendar->SelectedDate);
			} else 
			{
				QApplication::DisplayAlert(QApplication::Translate("You must select both dates"));
			}	

	}
		
}

ExampleForm::Run('ExampleForm','qvisualcalendar.tpl.php');
?>
