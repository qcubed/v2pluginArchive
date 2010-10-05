<?php
    require('../../../../includes/configuration/prepend.inc.php');      

    class QMaskTextBoxExample extends QForm {
        
        protected $btnSubmit;
        protected $txtMaskPhone;
        protected $txtMaskPhoneWithExt;
        protected $txtMaskZip;
        protected $txtMaskSSN;
		
		protected $txtPartNumber;

        protected function Form_Create() {
            parent::Form_Create();
            
            $this->txtMaskPhone = new QMaskTextBox($this);
            $this->txtMaskPhone->Name = 'Phone';
            // mask can be set using the QMaskType
            $this->txtMaskPhone->Mask = QMaskType::Phone;
			$this->txtMaskPhone->Required = true;
            
            
            $this->txtMaskPhoneWithExt = new QMaskTextBox($this);
            $this->txtMaskPhoneWithExt->Name = 'Phone With Extension';
            $this->txtMaskPhoneWithExt->Mask = QMaskType::PhoneWithExt;
			// add width to show all of mask for extension
			$this->txtMaskPhoneWithExt->Width = '150';
             
            $this->txtMaskZip = new QMaskTextBox($this);
            $this->txtMaskZip->Name = 'Zip Code';
            $this->txtMaskZip->Mask = QMaskType::ZipCode;
            
            $this->txtMaskSSN = new QMaskTextBox($this);
            $this->txtMaskSSN->Name = 'SSN';
            $this->txtMaskSSN->Mask = QMaskType::SSN;
			
			// We will suppose all part numbers are in the format a999-99-aa99 ie z165-87-st34
			$this->txtPartNumber = new QMaskTextBox($this);
            $this->txtPartNumber->Name = 'Part Number';
			// We can also set the mask manually
            $this->txtPartNumber->Mask = 'a999-99-aa99';
            
            $this->btnSubmit = new QButton($this);
            $this->btnSubmit->Text = 'Submit';
            $this->btnSubmit->AddAction(new QClickEvent(), new QServerAction('btnSubmit_Click'));
            // force validation on submit to show off Masked input validation.
            $this->btnSubmit->CausesValidation = true;
                        
        }
        public function btnSubmit_Click($strFormId, $strControlId, $strParameter) {
            // Do event actions
            
        }       
    } 
    QMaskTextBoxExample::Run('QMaskTextBoxExample');
?>