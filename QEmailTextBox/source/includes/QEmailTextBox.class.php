<?php
	/*********************************************************	
	QEmailTextBox		
	A subclass of QTextBox. 
	Contributors:	enzo	
	This text box validates  method overridden -- Validate will also ensure that the Text is a valid email address
	
	02-08-2010 changed short tag to <?php to fix break in some installations (Allegro)
	**********************************************************/
	
	
	class QEmailTextBox extends QTextBox {
		public function Validate() {
			if (parent::Validate()) {
				if ($this->strText != "") {
					// RegExp taken from php.net
					
					if ( !preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $this->strText) ) {
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