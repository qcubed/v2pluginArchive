<?php
class MySortablePanel extends QPanel {

	public $pnlSortablePanel;
  public $pnlItem;
	public $pnlMyItem;
	public $pnlAddAnother;

	public $intSeqNo;
	public $txtMyItem;
	public $txtNewItem;
	public $intId;

	public $myarray = array();

	public $btnAddItems;
	public $btnDelSelect;

	public $lblTesting;

	public function __construct($objParentObject, $strControlId = null) {
    try {
        parent::__construct($objParentObject, $strControlId);
    } catch (QCallerException $objExc) {
        $objExc->IncrementOffset();
        throw $objExc;
    }

		$this->strTemplate = __DOCROOT__ . __FORM_MYFORMS__ . '/sortablepanel.tpl.php';

		// Create your sortable panel
		$this->pnlSortablePanel = new QSortablePanel($this);
		//$this->pnlSortablePanel->SetSelectCallback($this, 'AddItem_Click');

		$this->txtNewItem = new QTextBox($this);

	}

	// Create the intial list to display in the sortable list (ul)
	public function CreateList() {
		//$this->pnlSortablePanel->DestroyPanel();
    for ($i = 0; $i < 5; $i++) {
    	// Create the sortable panel member and its child controls
    	$this->MakePanel($i);

			// Add a description to the QLabel in the handle
			$this->txtMyItem[$i]->Text = 'Sortable Item - '. ($i + 1);

			// Add the sortable panel to the array managed by QSortable
			$this->pnlSortablePanel->AddPanel($this->pnlItem[$i]);
		}
		// Make the array of panels sortable.  Attaches the jQuery script
		$this->pnlSortablePanel->MakeSortable();
	}

	protected function MakePanel($i) {

		// Create the sortable member QPanel
		$this->pnlItem[$i] = new QPanel($this->pnlSortablePanel);
		$this->pnlItem[$i]->AutoRenderChildren = true;

		// Create a label used to hold the logical sequence of the panel in the list
		$this->intSeqNo[$i] = new QLabel($this);
		$this->intSeqNo[$i]->Text = $i + 1;
		$this->intSeqNo[$i]->Visible = false;

		// Create a sub-panel to hold the sortable QLable
		// This sub-panel is the handle for the user to grab with the mouse
		$this->pnlMyItem[$i] = new QPanel($this->pnlItem[$i]);
		$this->pnlMyItem[$i]->AutoRenderChildren = true;
    $this->pnlMyItem[$i]->AddCssClass("sortablehandle");
		$this->pnlMyItem[$i]->DisplayStyle = "inline";
		$this->pnlMyItem[$i]->Width = "200px";
		// Create a QLabel to hold the description to be displayed in the handle
		$this->txtMyItem[$i] = new QLabel($this->pnlMyItem[$i]);

	}

	// This method fires, when the btnAddItems is clicked in the parent form
	public function AddItem_Click()  {

		// Get the next index for your array
		$i = count($this->pnlItem);

		// Create a new QPanel to be the new sortable member
		$this->MakePanel($i);

		// Apply the text entered in the parent form
		$this->txtMyItem[$i]->Text = $this->txtNewItem->Text;

    // Make sure indices are correctly numbered to match the physical sequence
		// in the sorted panel.
		if (count($this->pnlSortablePanel->GetPanelArraySeq()) > 0) {
			// Get the list of controls in the correct order, strip off the "_li" from
			// the control Id. Note, the first control Id in the list is the control id
			// of the ul, which is the control Id of the QSortable list plus "_ctl"
    	$objNewSortList = explode(',',preg_replace('/_li/','',$this->pnlSortablePanel->GetPanelArraySeq()));

			// For each pre-existing list entry, find the control id of the QPanel and
			// get the index.  Since the first entry is the control id of the QSortable
			// list itself (the ul), the first member item will have an index of one (1)
			// not zero.
      for ($i = 0; $i < count($this->pnlItem); $i++) {
      	if (array_search($this->pnlItem[$i]->ControlId,$objNewSortList)) {
					$this->intSeqNo[$i]->Text = array_search($this->pnlItem[$i]->ControlId,$objNewSortList);
				}
			}
    }

		// Load an array with item's sequence number
		$strSeqArray = array();
		for ($i = 0; $i < count($this->pnlItem); $i++) {
			$strSeqArray[$i] = $this->intSeqNo[$i]->Text;
		}
		// sort the array by the logical sequence number, which is the sequence of
		// the physical list as sorted by the user
		asort($strSeqArray);

		// I was unable to make the "addItem" opiton of jQuery sortable work, so the
		// original sortable list must be destroyed and the list (array) rebuilt.
		$this->pnlSortablePanel->DestroyPanel();
		$this->pnlSortablePanel->MakeSortable();

		// Rebuild the list of sortable panels in the same sequence as the user last
		// sorted them, adding the new panel
		foreach ($strSeqArray as $i => $val) {
       $this->pnlSortablePanel->AddPanel($this->pnlItem[$i]);
		}
	}  
}
?>