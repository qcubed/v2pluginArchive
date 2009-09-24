<?php 

require('../../../../includes/configuration/prepend.inc.php');

class ExampleForm extends QForm {
	protected $tabPanel;
	protected $tabPanela;
	protected $tabPanelSection1;
	protected $tabPanelSection1a;
	protected $tabPanelSection1b;
	protected $tabPanelSection2;
	protected $tabPanelSection3;
	
	protected $txtBoxSection1;
	protected $txtBoxSection2;
	protected $txtBoxSection3;
	protected $txtBoxSection1a;
	protected $txtBoxSection1b;
	
	protected $btnSave;
	protected $btnCancel;
	
	protected function Form_Create() {
		$this->tabPanel = new QTabPanel($this);
		$this->tabPanel->CssClass = "tabpanel";
		$this->tabPanel->ActiveTab = 1;
		//$this->tabPanel->Width = '50%';
		//$this->tabPanel->SwitchWithFade = true;
		//$this->tabPanel->SwitchSpeed = QTabPanel::TabPanelSwitchSpeedSlow;
		// doesn't work here since we're not specifying section heights using CSS (I think)
		//$this->tabPanel->AutoHeight = true;
	
		$this->tabPanelSection1 = new QTabPanelSection($this->tabPanel);
		$this->tabPanelSection1->Title = "Section 1";
		$this->txtBoxSection1 = new QTextBox($this->tabPanelSection1);
		$this->txtBoxSection1->Name = 'One';
	
		$this->tabPanela = new QTabPanel($this->tabPanelSection1);
		$this->tabPanela->ActiveTab = 2;
		//$this->tabPanela->SwitchWithSlide = true;
		//$this->tabPanela->SwitchSpeed = QTabPanel::TabPanelSwitchSpeedFast;
		//$this->tabPanela->TabsOnBottom = true; // in this example, it's buggy (IE7)
	
		$this->tabPanelSection1a = new QTabPanelSection($this->tabPanela);
		$this->tabPanelSection1a->Title = "Section 1a";
		$this->txtBoxSection1a = new QTextBox($this->tabPanelSection1a);
		$this->txtBoxSection1a->Name = 'One A';
	
		$this->tabPanelSection1b = new QTabPanelSection($this->tabPanela);
		$this->tabPanelSection1b->Title = "Section 1b";
		$this->txtBoxSection1b = new QTextBox($this->tabPanelSection1b);
		$this->txtBoxSection1b->Name = 'One B';
	
		$this->tabPanelSection2 = new QTabPanelSection($this->tabPanel);
		$this->tabPanelSection2->Title = "Section 2";
		$this->txtBoxSection2 = new QTextBox($this->tabPanelSection2);
		$this->txtBoxSection2->Name = 'Two';
	
		$this->tabPanelSection3 = new QTabPanelSection($this->tabPanel);
		$this->tabPanelSection3->Title = "Section 3";
		$this->txtBoxSection3 = new QTextBox($this->tabPanelSection3);
		$this->txtBoxSection3->Name = 'Three';
	
		// Other controls
		$this->btnSave = new QButton($this);
		$this->btnSave->Text = 'Save';
		$this->btnSave->AddAction(new QClickEvent(), new QAjaxAction('btnSave_Click'));
		$this->btnSave->PrimaryButton = true;
	
		$this->btnCancel = new QButton($this);
		$this->btnCancel->Text = 'Cancel';
		$this->btnCancel->AddAction(new QClickEvent(), new QAjaxAction('btnCancel_Click'));
		$this->btnCancel->CausesValidation = false;
	}
	
	// Override Form Event Handlers as Needed
	protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		QApplication::DisplayAlert("Save action triggered!");
	}
	
	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		QApplication::DisplayAlert("Cancel action triggered!");
	}
}

ExampleForm::Run('ExampleForm','tab_panel.tpl.php');
?>
