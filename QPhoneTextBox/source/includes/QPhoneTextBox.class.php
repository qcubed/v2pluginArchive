<?php
	/*********************************************************
	
	PhoneTextBox
	
	A subclass of QTextBox. 

	Contributors:	Michael Ho, Shannon Pekary, Alex Weinstein
	
	This text box validates based on the North American phone format of (xxx) xxx-xxxx, and reformats the phone if it's entered differently. 
	
	Blank items are allowed. If the user does not enter anything, then the area code will be removed so that
	it will be blank
	
	WARNING: This class adds javascript onblur and onfocus events. If you remove all javascript actions, you will inadvertently
	remove these as well. You can use the public AddPrivateBlurAction and AddPrivateFocusAction to put them back if necessary.
	
	Usage example:
	
	$defaultAreaCode = "650";
	$txtPhone = new QPhoneTextBox ($this, $defaultAreaCode);
	$txtBox->Name = 'Home Phone';
	$txtBox->Text = $this->objPeople->HomePhone;
	
	02-08-2010 Changed php  short tag tp "<?php" (Allegro)
	**********************************************************/
	
	
	class QPhoneTextBox extends QTextBox {
		//////////
		// Member Variables
		//////////
		
		
		protected $defaultAreaCode;	// set this to the default area code to enter in the box when the field is entered. 
																// this will help users enter the information.
		
		//////////
		// Methods
		//////////
		
		public function __construct($objParentObject, $defaultAreaCode = null, $strControlId = null) {
			parent::__construct($objParentObject, $strControlId);
			
			$this->AddPluginJavascriptFile("QPhoneTextBox", "phonetextbox.js");
			
			$this->defaultAreaCode = $defaultAreaCode;
			$this->AddPrivateFocusAction();
			$this->AddPrivateBlurAction();
		}
		
		
		/******************************
		
		Use the following functions to put the actions back if you need to RemoveAllActions for some reason.
		
		*******************************/
		
		public function AddPrivateFocusAction () {
			$js = sprintf('__phoneBoxSetDefault(%s, %s)', $this->ControlId, $this->defaultAreaCode);
			$this->AddAction(new QFocusEvent(), new QJavaScriptAction($js));
		}
		
		public function AddPrivateBlurAction () {
			$js = sprintf('__phoneBoxCheckChanged(%s, %s)', $this->ControlId, $this->defaultAreaCode);
			$this->AddAction(new QBlurEvent(), new QJavaScriptAction($js));
		}
		
		public function Validate() {
			if (parent::Validate()) {
				$this->strText = trim ($this->strText);
				if ($this->strText != "") {
					$pattern = "(\(||\[)?\d{3}(\)||\])?[-\s.]+\d{3}[-\s.]+\d{4}( x\d+)?$"; // standard phone
					if (! preg_match("/$pattern/", $this->strText)) {
						$this->strValidationError = "Invalid phone";
						return false;
					}
				}
			} else
				return false;

			$this->strValidationError = "";
			return true;
		}

	}
?>