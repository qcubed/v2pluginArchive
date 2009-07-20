<?
	/*********************************************************	
	QEmailTextBox		
	A subclass of QTextBox. 
	Contributors:	enzo	
	This text box validates  method overridden -- Validate will also ensure that the Text is a valid email address		
	**********************************************************/
	
	
	class QEmailTextBox extends QTextBox {
		public function Validate() {
			if (parent::Validate()) {
				if ($this->strText != "") {
					// RegExp taken from php.net
					if ( !eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*"."@([a-z0-9]+([\.-][a-z0-9]{1,})+)*$", $this->strText) ) {
						$this->strValidationError = QApplication::Translate("Invalid e-mail address");
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
