<?php

	class QProgressBar extends QControl  {
		
	public $strBarImage;
	public $strBoxImage;
	public $blnShowText;
	public $fltMaxValue;
	public $fltInitialValue;
	public $fltCurrentValue;		
	public $strTextFormat;  //fraction, percentaje
	
	public function __construct($objParentObject, $strControlId = null) {
			if ($objParentObject)
				parent::__construct($objParentObject, $strControlId);	

			$this->strBarImage = __SUBDIRECTORY__ ."/assets/plugins/QProgressBar/images/progressbg_orange.gif";	
			$this->strBoxImage = __SUBDIRECTORY__ ."/assets/plugins/QProgressBar/images/progressbar.gif";
			$this->fltInitialValue = 0;
			$this->fltMaxValue = 100;
			$this->blnShowText = TRUE;
			$this->strTextFormat = "fraction";
	        $this->setFiles();
    }	

	private function setFiles() {
		$this->AddJavascriptFile(__JQUERY_BASE__);
		$this->AddPluginJavascriptFile("QProgressBar", "jquery.progressbar.js");
	}
		
		protected function GetControlHtml() {

			$strHtml = sprintf('<div id="pb_%s" class="%s"></div>',
								$this->ControlId,$this->CssClass);

			$strJsProgressBar = sprintf('
			  jQuery(document).ready(function(){
			    jQuery("#pb_%s").progressBar(%s,{ 
				      showtext: %s,
					  barImage: "%s",
					  boxImage: "%s",
					  max: %s,
					  textFormat: "%s"
 				   	});
			  })',$this->ControlId,
                              ($this->fltCurrentValue)?$this->fltCurrentValue:$this->fltInitialValue,
			      ($this->blnShowText)?'true':'false',
                              $this->strBarImage,$this->strBoxImage,$this->fltMaxValue,$this->strTextFormat);
			
			QApplication::ExecuteJavaScript($strJsProgressBar);
			return $strHtml;
		}

	public function Update($value) {
		$this->fltCurrentValue = $value;
		QApplication::ExecuteJavaScript(sprintf("jQuery('#pb_%s').progressBar(%s);",$this->ControlId,$value));
		return true;
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
	
	public function __set($strName, $mixValue) {
		switch ($strName) {
			case "BarImage":
				try {
					$this->strBarImage = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				
			case "BoxImage":
				try {
					$this->strBoxImage = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				
			case "ShowText":
				try {
					$this->blnShowText = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				
			case "MaxValue":
				try {
					$this->fltMaxValue = QType::Cast($mixValue, QType::Float);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				
			case "InitialValue":
				try {
					$this->fltInitialValue = QType::Cast($mixValue, QType::Float);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case "TextFormat":
				try {
					$this->txtTextFormat = QType::Cast($mixValue, QType::String);
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
