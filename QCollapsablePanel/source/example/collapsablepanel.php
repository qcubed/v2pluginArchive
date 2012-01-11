<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class ExampleForm extends QForm {
		protected $cp;

		protected function Form_Create() {
			$this->cp = new QCollapsablePanel($this);
			$this->cp->CssClass = 'cp';
			$this->cp->UseAjax = false;
			$this->cp->Header->AutoRenderChildren = true;
			$this->cp->Header->CssClass = 'cp_header';
			$this->cp->Body->AutoRenderChildren = true;
			$this->cp->Body->CssClass = 'cp_body';
			$this->cp->ClickableHeader = true;
			$lbl = new QLabel($this->cp->Header);
			$lbl->Text = 'Click on the button or anywhere on the header';
			$cal = new QDatePicker($this->cp->Body);
			$this->cp->Expanded = false;
			$this->cp->Button->CssClass = 'toggle_button';
		}
	}

	ExampleForm::Run('ExampleForm');
?>
