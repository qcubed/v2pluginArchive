<?php

	require('../../../../includes/configuration/prepend.inc.php');

	class ExampleForm extends QForm {

		public $objQSliderA;
		public $objQSliderB;
		public $btnSubmit;
		
		protected function Form_Create() {
			
			$this->objQSliderA = new QSlider($this);
			$this->objQSliderA->Name = "Slider Horizontal";
			$this->objQSliderA->CssClass = "ui-slider-1 ui-slider";
			$this->objQSliderA->CssClassHandle = "ui-slider-handle";
			$this->objQSliderA->MinValue = 1;
			$this->objQSliderA->MaxValue = 15;
			$this->objQSliderA->Steps = 15;
			$this->objQSliderA->StartValue = 7;
			$this->objQSliderA->Axis = 'horizontal';
			

			$this->objQSliderB = new QSlider($this);
			$this->objQSliderB->Name = "Slider Horizontal";
			$this->objQSliderB->CssClass = "ui-slider-1 ui-slider";
			$this->objQSliderB->CssClassHandle = "ui-slider-handle";
			$this->objQSliderB->MinValue = 1;
			$this->objQSliderB->MaxValue = 15;
			$this->objQSliderB->Steps = 15;
			$this->objQSliderB->StartValue = 7;
			$this->objQSliderB->Axis = 'horizontal';
			$this->objQSliderB->DisplayValueBox = TRUE;
			
			$this->btnSubmit = new QButton($this);
			$this->btnSubmit->Text = "Submit";
			$this->btnSubmit->AddAction(new QClickEvent(), new QAjaxAction('btnSubmit_Click'));
			
		}

		public function btnSubmit_Click($strFormId, $strControlId) {
			QApplication::DisplayAlert("Slider A Value:" . $this->objQSliderA->txtSliderValue->Text);
			QApplication::DisplayAlert("Slider B Value:" . $this->objQSliderB->txtSliderValue->Text);
		}
	}
	
	ExampleForm::Run('ExampleForm',dirname(__FILE__) . '/qslider.tpl.php');	
?>
