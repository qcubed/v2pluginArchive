<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class ExampleForm extends QForm {
		/** @var QListPanel */
		protected $objListPanel;

		protected function Form_Create() {
			// Define the DataGrid
			$this->objListPanel = new QListPanel($this);
			
			for ($i = 0; $i < 5; $i++) {
				$btnButton = new QLinkButton($this->objListPanel);
				$btnButton->Text = 'Item #' . $i;
			}
		}

	}

	ExampleForm::Run('ExampleForm');
?>