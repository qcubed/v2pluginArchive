<?php

class QSlider extends QControl  {

	protected $strJavaScripts = 'jquery.dimensions.js,ui.mouse.js,ui.slider.js';

	public $CssClassHandle;
	protected $intMinValue;
	protected $intMaxValue;
	protected $intSteps;
	protected $intStartValue;
	public $Axis;

	public $txtSliderValue;

	public function __construct($objParentObject, $strControlId = null) {
		if ($objParentObject)
		parent::__construct($objParentObject, $strControlId);

		$this->intMinValue = 1;
		$this->intMaxValue = 10;
		$this->intSteps = 10;
		$this->Axis = "horizontal";
			
		$this->txtSliderValue = new QTextBox($objParentObject);
		$this->txtSliderValue->Width = '25';
		$this->txtSliderValue->ReadOnly = TRUE;
		$this->txtSliderValue->Display = FALSE;
		$this->setFiles();
	}

	private function setFiles() {
		$this->AddJavascriptFile(__JQUERY_BASE__);
		$this->AddPluginJavascriptFile("QSlider", "jquery.dimensions.js");
		$this->AddPluginJavascriptFile("QSlider", "ui.mouse.js");
		$this->AddPluginJavascriptFile("QSlider", "ui.slider.js");

		$this->AddPluginCssFile("QSlider", "slider.css");
		/*if (QApplication::IsBrowser(QBrowserType::InternetExplorer)) {
			$this->AddPluginCssFile("QSlider", "slider_ie.css");
			}*/

	}

	protected function GetControlHtml() {

		$strHtml = sprintf('<div id="slider_%s" class="%s">
									<div class="%s" style=""/></div></div>',
		$this->ControlId,$this->CssClass,$this->CssClassHandle);

		$strSliderValue = $this->txtSliderValue->Render(false);
	
		$this->intStartValue = ($this->intStartValue)?$this->intStartValue:$this->intMinValue;

		$strJsSlider = sprintf('
			  $(document).ready(function(){
			    $("#slider_%s").slider({ 
				      steps: %s,
					  minValue: %s,
					  maxValue: %s,
					  startValue: %s,
					  axis: \'%s\',
					  slide: function(e,ui) { 
					     $("#%s").val(ui.values); 
					  }
					   });
			  })',$this->ControlId,$this->intSteps,$this->intMinValue,$this->intMaxValue,$this->intStartValue,$this->Axis,$this->txtSliderValue->ControlId);
			
		QApplication::ExecuteJavaScript($strJsSlider);
		return $strHtml . $strSliderValue;
	}

	public function GetEndScript() {
		return null;
	}

	public function ParsePostData() {

		return true;
	}

	public function Validate(){
		return true;
	}

	public function __get($strName) {
		switch ($strName) {
			// APPEARANCE
			case "Text": return $this->txtSliderValue->Text;

			default:
				try {
					return parent::__get($strName);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}

	public function __set($strName, $mixValue) {

		switch ($strName) {
			// APPEARANCE
			case "MinValue":
				try {
					$this->intMinValue = QType::Cast($mixValue, QType::Integer);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case "MaxValue":
				try {
					$this->intMaxValue = QType::Cast($mixValue, QType::Integer);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				
			case "Steps":
				try {
					$this->intSteps = QType::Cast($mixValue, QType::Integer);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				
			case "StartValue":
				try {
					$this->intStartValue = QType::Cast($mixValue, QType::Integer);
					$this->txtSliderValue->Text = QType::Cast($mixValue, QType::Integer);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				
			case "DisplayValueBox":
				try {					
					$this->txtSliderValue->Display = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
								
			default:
				try {
					parent::__set($strName, $mixValue);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				break;
		}

	}
}
?>
