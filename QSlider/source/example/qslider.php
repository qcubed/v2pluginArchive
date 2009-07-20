<?php

require('../../../../includes/configuration/prepend.inc.php');

class ExampleForm extends QForm {
	public $objSlider;
	public $btnSubmit;
	
	protected function Form_Create() {			
		$this->objSlider = new QSlider($this);
        
		$this->objSlider->MinValue = 1;
		$this->objSlider->MaxValue = 15;
		$this->objSlider->Steps = 15;
		$this->objSlider->InitialValue = 7;

		// Try changing "ui-slider-1" to "ui-slider-2" and see what happens!
        $this->objSlider->CssClass = "ui-slider-1";
		$this->objSlider->CssClassHandle = "ui-slider-handle";
		
		// We'll show the "current value" text box
        $this->objSlider->ShowValueTextBox = true;
		
		$this->btnSubmit = new QButton($this);
		$this->btnSubmit->Text = "Submit";
		$this->btnSubmit->AddAction(new QClickEvent(), new QAjaxAction('btnSubmit_Click'));
	}

	public function btnSubmit_Click($strFormId, $strControlId) {
		QApplication::DisplayAlert("Slider value: " . $this->objSlider->Value);
	}
}

ExampleForm::Run('ExampleForm',dirname(__FILE__) . '/qslider.tpl.php');	
?>
