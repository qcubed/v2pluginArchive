<?php
	require('../../../../includes/configuration/prepend.inc.php');

	class SampleForm extends QForm {
		// Declare the DataGrid
		protected $dtgPersons;
		
		// Download buttons
		protected $btnCSV;
		protected $btnXLS;
		
		protected $btnCurPage;
		

		protected function Form_Create() {
			$this->dtgPersons_Create();

			// Button 1: download entire datagrid as a comma-separated values file
			$this->btnCSV = new QDataGridExporterButton($this, $this->dtgPersons);
			$this->btnCSV->DownloadFormat = QDataGridExporterButton::EXPORT_AS_CSV;
			$this->btnCSV->Text = "Download all pages as CSV";
			
			// Button 2: download entire datagrid as Microsoft Excel .xls file
			$this->btnXLS = new QDataGridExporterButton($this, $this->dtgPersons);
			$this->btnXLS->DownloadFormat = QDataGridExporterButton::EXPORT_AS_XLS;
			$this->btnXLS->Text = "Download all pages as XLS";
			
			// Button 3: download only the current page of the datagrid as CSV file
			$this->btnCurPage = new QDataGridExporterButton($this, $this->dtgPersons);
			$this->btnCurPage->Text = "Download this page only as CSV";
			$this->btnCurPage->DownloadFormat = QDataGridExporterButton::EXPORT_AS_CSV;
			$this->btnCurPage->DownloadMode = QDataGridExporterButton::DOWNLOAD_CURRENT_PAGE;
		}
		
		private function dtgPersons_Create() {
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

			// Define Columns
			$this->dtgPersons->MetaAddColumn('Id');
			$this->dtgPersons->MetaAddColumn('FirstName');
			$this->dtgPersons->MetaAddColumn('LastName');
			$this->dtgPersons->MetaAddColumn(QQN::Person()->Login);
			// Let's pre-default the sorting by last name (column index #2)
			$this->dtgPersons->SortColumnIndex = 2;			
		}


	}

	SampleForm::Run('SampleForm');
?>
