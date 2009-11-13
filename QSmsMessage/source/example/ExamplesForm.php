<?php
  // load framework
  require('../../../../includes/configuration/prepend.inc.php');
  
  class ExamplesForm extends QForm {
      
      protected $btnSendText;
      protected $txtMobileNumber;
      protected $lstCarrier;
      
      protected function Form_Create() {
        
        $this->txtMobileNumber = new QTextBox($this);
        $this->txtMobileNumber->Name = QApplication::Translate('Mobile Number');
        $this->txtMobileNumber->Text = '';
        $this->txtMobileNumber->Required = true;
        $this->txtMobileNumber->ToolTip = QApplication::Translate('Enter Mobile Number');
        
        $this->lstCarrier = new QListBox($this);
        $this->lstCarrier->Name = QApplication::Translate('Mobile Provider');        
        $this->lstCarrier->AddItem(QApplication::Translate('- Select One -'), null);
		// use the PHP reflection class to populate our list box.
        $class = new ReflectionClass('QSmsCarrierType');
        $arrCarriers = $class->getConstants();        
        foreach ($arrCarriers as $key => $value) {
            $this->lstCarrier->AddItem(new QListItem($key, $value));
        }       
          
        $this->btnSendText = new QButton($this);
        $this->btnSendText->Text = QApplication::Translate('Send SMS Text');
        $this->btnSendText->ToolTip = QApplication::Translate('Send SMS Text');
        $this->btnSendText->HtmlEntities = false;
        $this->btnSendText->PrimaryButton = false;
        $this->btnSendText->CausesValidation = false;
        $this->btnSendText->AddAction(new QClickEvent(), new QAjaxAction('btnSendText_Click'));
      }
      
      protected function Form_PreRender() {
      }
      
      protected function Form_Validate() {
          // By default, we report that Custom Validations passed
          $blnToReturn = true;
  
          // Custom Validation Rules
          // We may wish to validate the textbox and ensure it is a valid mobile number for your area and that Carries is not Unknown
  
          $blnFocused = false;
          foreach ($this->GetErrorControls() as $objControl) {
              // Set Focus to the top-most invalid control
              if (!$blnFocused) {
                  $objControl->Focus();
                  $blnFocused = true;
              }
  
              // Blink on ALL invalid controls
              $objControl->Blink();
          }
  
          return $blnToReturn;
      }
      protected function btnSendText_Click($strFormId, $strControlId, $strParameter) {
		// Change to youe servers configuration
        QEmailServer::$SmtpServer = 'mx.myserversdomain.com';
        $objSmsText = new QSmsMessage();
        $objSmsText->From = 'Admin <admin@myserversdomain.com>';
        $objSmsText->MobileNumber = $this->txtMobileNumber->Text;
        $objSmsText->Carrier = $this->lstCarrier->SelectedValue;
		// TODO: find better method 'To' set To field 
        $objSmsText->To = $objSmsText->SmsAddress();   
        $objSmsText->Body = 'This is a test. It is only a test. Had this of been an actual text it would be more informative.';  
		
		// Here is where we would send the text using QEmailServer. commented out for obvious reasons
        // QEmailServer::Send($objSmsText);
		// adding popup to show what text would look like
		QApplication::DisplayAlert('Text sent to ' . $objSmsText->To . '. Containing the message: ' . $objSmsText->Body);
    }
  }
  
  ExamplesForm::Run('ExamplesForm');
?>
