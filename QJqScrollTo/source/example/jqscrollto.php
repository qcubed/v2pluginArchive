<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class ExampleForm extends QForm {
		/** @var QPanel The top panel */
		protected $pnlPanelTop;
		/** @var QPanel The first target panel */
		protected $pnlPanel1;
		/** @var QPanel The second target panel*/
		protected $pnlPanel2;
		/** @var QLinkButton The navigation button for the first target panel */
		protected $btnButton1;
		/** @var QLinkButton The navigation button for the first target panel to come back to the top */
		protected $btnButton1Top;
		/** @var QLinkButton The navigation button for the second target panel */
		protected $btnButton2;
		/** @var QLinkButton The navigation button for the second target panel to come back to the top */
		protected $btnButton2Top;

		protected function Form_Create() {
			$this->pnlPanelTop = new QPanel($this);
			$this->pnlPanelTop->Height = '2000px';
			$this->pnlPanelTop->Text = "The top panel";
			
			$this->pnlPanel1 = new QPanel($this);
			$this->pnlPanel1->Height = '2000px';
			$this->pnlPanel1->Text = "The first panel";
			
			$this->pnlPanel2 = new QPanel($this);
			$this->pnlPanel2->Height = '2000px';
			$this->pnlPanel2->Text = "The second panel";
			
			$this->btnButton1 = new QLinkButton($this);
			$this->btnButton1->Text = 'Go to first panel';
			$this->btnButton1->AddAction(new QClickEvent(), new QJQScrollToAction($this->pnlPanel1, 30));
			$this->btnButton1->AddAction(new QClickEvent(), new QJavascriptAction('return false'));
			
			$this->btnButton1Top = new QLinkButton($this);
			$this->btnButton1Top->Text = 'Go back to the top panel';
			$this->btnButton1Top->AddAction(new QClickEvent(), new QJQScrollToAction($this->pnlPanelTop, 30));
			$this->btnButton1Top->AddAction(new QClickEvent(), new QJavascriptAction('return false'));
			
			$this->btnButton2 = new QLinkButton($this);
			$this->btnButton2->Text = 'Go to second panel';
			$this->btnButton2->AddAction(new QClickEvent(), new QJQScrollToAction($this->pnlPanel2, 30));
			$this->btnButton2->AddAction(new QClickEvent(), new QJavascriptAction('return false'));
			
			$this->btnButton2Top = new QLinkButton($this);
			$this->btnButton2Top->Text = 'Go back to the top panel';
			$this->btnButton2Top->AddAction(new QClickEvent(), new QJQScrollToAction($this->pnlPanelTop, 30));
			$this->btnButton2Top->AddAction(new QClickEvent(), new QJavascriptAction('return false'));
		}

	}

	ExampleForm::Run('ExampleForm');
?>