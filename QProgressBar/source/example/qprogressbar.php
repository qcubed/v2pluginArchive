<?php

	require('../../../../includes/configuration/prepend.inc.php');

	class ExampleForm extends QForm {

		public $objQProgressBar;
		public $btnReset;		
		public $btnNext;
		public $intStep = 0;
		
		protected function Form_Create() {
			
			$this->objQProgressBar = new QProgressBar($this);
			$this->objQProgressBar->BarImage = __SUBDIRECTORY__ ."/assets/plugins/QProgressBar/images/progressbg_orange.gif";
			$this->objQProgressBar->BoxImage = __SUBDIRECTORY__ ."/assets/plugins/QProgressBar/images/progressbar.gif";
			$this->objQProgressBar->fltInitialValue = 0;
			$this->objQProgressBar->fltMaxValue = 100;
			$this->objQProgressBar->blnShowText = TRUE;
			$this->objQProgressBar->strTextFormat = "fraction";	        			

			$this->btnReset = new QButton($this);
			$this->btnReset->Text = QApplication::Translate("Reset");
			$this->btnReset->AddAction(new QClickEvent(), new QAjaxAction('btnReset_Click'));

			$this->btnNext = new QButton($this);
			$this->btnNext->Text = QApplication::Translate("Next");
			$this->btnNext->AddAction(new QClickEvent(), new QAjaxAction('btnNext_Click'));

		}

		public function btnReset_Click($strFormId, $strControlId) {
			$this->intStep = 0;
			$this->objQProgressBar->Update($this->intStep);
		}

		public function btnNext_Click($strFormId, $strControlId) {
			if($this->intStep<100){
				$this->intStep+= 20;
				$this->objQProgressBar->Update($this->intStep);
			} else {
				QApplication::DisplayAlert(QApplication::Translate("You Reach the last step"));
			}
		}
	}
	
	ExampleForm::Run('ExampleForm',dirname(__FILE__) . '/qprogressbar.tpl.php');	
?>
