<?php
	/*********************************************************	
	QEmailTextBox		
	A subclass of QTextBox. 
	Contributors:	enzo	
	This text box validates  method overridden -- Validate will also ensure that the Text is a valid email address
	
	02-08-2010 changed short tag to <?php to fix break in some installations (Allegro)
	19-12-2010 changed eregi to preg_match, and regular expression (wizard)
	**********************************************************/
	
	
	class QEmailTextBox extends QTextBox {
		public function Validate() {
			if (parent::Validate()) {
				if ($this->strText != "") {
					// RegExp taken from http://stackoverflow.com/questions/201323/what-is-the-best-regular-expression-for-validating-email-addresses
					if ( !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $this->strText) ) {
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
