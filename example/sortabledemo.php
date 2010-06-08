<?php
	// Load the QCubed Development Framework
	require('../../../../includes/configuration/prepend.inc.php');
	//require('../../../../qcubed.inc.php');
	require('sortablepanel.php');
	class SortableDemo extends QForm {

		protected $pnlSortableMaster;

		protected $dlgValidationMessage;

		protected $btnVerifySeq;

		protected $txtNewItem;
		protected $btnAddItems;

		protected function Form_Run() {
			// Security check for ALLOW_REMOTE_ADMIN
			// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
			QApplication::CheckRemoteAdmin();
		}

		protected function Form_Create () {

			$this->objDefaultWaitIcon = new QWaitIcon($this);

			// Creates the main panel, which contains the sortable sub-panels
			$this->pnlSortableMaster = new MySortablePanel($this);

			// Creates and populates the sortable sub-panels with initial data
			$this->pnlSortableMaster->CreateList();

			// Create QTextBox to enter new items to be added to the sortable list
			$this->txtNewItem = new QTextBox($this);
			$this->txtNewItem->Name = "Enter New Item:";

			// Create QButton to add the new item to the sortable list
			$this->btnAddItems = new QButton($this);
			$this->btnAddItems->Text = QApplication::Translate('Add Another Item to the List');
			$this->btnAddItems->AddAction(new QClickEvent(), new QAjaxAction('AddItem_Click'));

    }

		// Call the method to add the new item to the sortable list and make it sortable
		public function AddItem_Click() {
			$this->pnlSortableMaster->txtNewItem->Text = $this->txtNewItem->Text;
			$this->pnlSortableMaster->AddItem_Click();
			$this->txtNewItem->Text = "";
		}

	}


SortableDemo::Run('SortableDemo');

?>