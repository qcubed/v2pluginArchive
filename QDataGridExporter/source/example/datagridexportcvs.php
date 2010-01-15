<?php
	require('../../../../includes/configuration/prepend.inc.php'); 


	class SampleForm extends QForm {
		// Declare the DataGrid
		protected $dtgPersons;
// Button to download CVS         
          protected $btnCVS;
//

		protected function Form_Create() {
			// Define the DataGrid
			$this->dtgPersons = new PersonDataGrid($this);
			$this->dtgPersons->CellPadding = 5;
			$this->dtgPersons->CellSpacing = 0;
			
			// To create pagination, we will create a new paginator, and specify the datagrid
			// as the paginator's parent.  (We do this because the datagrid is the control
			// who is responsible for rendering the paginator, as opposed to the form.)
			$objPaginator = new QPaginator($this->dtgPersons);
			$this->dtgPersons->Paginator = $objPaginator;

			// Now, with a paginator defined, we can set up some additional properties on
			// the datagrid.  For purposes of this example, let's make the datagrid show
			// only 5 items per page.
			$this->dtgPersons->ItemsPerPage = 5;

// do not show filter 
               $this->dtgPersons->ShowFilter = false;

			// Use the MetaDataGrid functionality to add Columns for this datagrid


			// Define Columns
			$this->dtgPersons->MetaAddColumn('Id');
			$this->dtgPersons->MetaAddColumn('FirstName');
			$this->dtgPersons->MetaAddColumn('LastName');
			$this->dtgPersons->MetaAddColumn(QQN::Person()->Login);
			// Let's pre-default the sorting by last name (column index #2)
			$this->dtgPersons->SortColumnIndex = 2;

// to activate the plugin
               $this->btnCVS = new QDataGridExporter($this, $this->dtgPersons);

// now you can choose to download all (default) or only page (uncomment next line)
	       //$this->btnCVS->blnDowload_all=false;


			// Make the DataGrid look nice
			$objStyle = $this->dtgPersons->RowStyle;
			$objStyle->FontSize = 12;

			$objStyle = $this->dtgPersons->AlternateRowStyle;
			$objStyle->BackColor = '#eaeaea';

			$objStyle = $this->dtgPersons->HeaderRowStyle;
			$objStyle->ForeColor = 'white';
			$objStyle->BackColor = '#000066';

			// Because browsers will apply different styles/colors for LINKs
			// We must explicitly define the ForeColor for the HeaderLink.
			// The header row turns into links when the column can be sorted.
			$objStyle = $this->dtgPersons->HeaderLinkStyle;
			$objStyle->ForeColor = 'white';
		}


	}

	SampleForm::Run('SampleForm');
?>
