<?php
	/**
	 *	QMaskInputTextBox
	 *	Using the JQuery Plugin:
	 *		http://digitalbush.com/projects/masked-input-plugin
	 *
	 *	@author Zeno Yu <zeno.yu@gmail.com>
	 *
	 *	@history:
     *  2010-10-04 Updated to QCubed by Steven Warren
     *  2010-10-04 Added QMaskType class to store common Mask
     *  2010-10-04 Fixed validate function to pass validation to parent if no mask has been set
	 *	2007-10-08 First Release
     * 
     *  This is a masked input plugin for the jQuery  javascript library. It allows a user to more easily 
     *  enter fixed width input where you would like them to enter the data in a certain 
     *  format (dates,phone numbers, etc). It has been tested on Internet Explorer 6/7, Firefox 1.5/2/3, 
     *  Safari, Opera, and Chrome.  A mask is defined by a format made up of mask literals and mask definitions. 
     *  Any character not in the definitions list below is considered a mask literal. Mask literals will be 
     *  automatically entered for the user as they type and will not be able to be removed by the user.The following 
     *  mask definitions are predefined:
     *
     * a - Represents an alpha character (A-Z,a-z)
     * 9 - Represents a numeric character (0-9)
     * * - Represents an alphanumeric character (A-Z,a-z,0-9)
	 * ? - Represents optional characters. Anything to the right of '?' will be considered optional.
	 */
    abstract class QMaskType {
        const Date = '99/99/9999';
        const Phone = '(999) 999-9999';
        const PhoneWithExt = '(999) 999-9999? x9999';
        const EIN = '99-9999999';
        const SSN = '999-99-9999';
        const ZipCode = '99999?-9999'; // added optional -9999 for zip+4         
    }
	class QMaskTextBox extends QTextBox {
		// initialize as null to force setting of mask
		// If Mask=null then basically we have a standard QTextBox
		protected $strMask = null;
		protected $strMaskWarning="Invalid Input";
		
		public function __construct($objParentObject, $strControlId = null) {
			if ($objParentObject)
				parent::__construct($objParentObject, $strControlId);
			$this->AddJavascriptFile(__JQUERY_BASE__);
			$this->AddPluginJavascriptFile('QMaskTextBox', 'jquery.maskedinput.js');
		}
		public function Validate() {
			// This will perform server side validation. Technically redundant as we  
			// have already validated on the client side.
			// Note: Optional portion of mask is validated as all or nothing. This can be awkward for 
			// data like phone extensions which could be varying lengths. (i.e. 3 digit or 4 digit extension)
			
            // We will assume true if control is not required and Text is '' 
            if( !$this->blnRequired && $this->strText=='')return true;
            //only validate if a mask has been set
            if ($this->strMask){
				// set our pattern to the current Mask
				$strPattern = $this->strMask;
				// check if optional characters exist
				$intOptional = stripos($this->strMask, '?');
				// stripos may return 0 if '?' is in first position so check for type  
				if ($intOptional !== false){ 
					// TODO: Validate optional portion. Could possibly add a flag $blnValidateOptional
					// If length of strText = Mask minus the optional portion we will assume the optional portion
					// was not entered and does not need to be validated. For now we will strip away the optional portion.
					if (strlen($this->strText) == $intOptional) $strPattern = substr($this->strMask, 0, $intOptional);										
				}
				// use strtr to replace our tokens and prepare our $strPattern for use as Regular Expression
				$strPattern = strtr($strPattern,
									array(	'(' => '\(',
											')' => '\)',
											'[' => '\[',
											']' => '\]',
											'/' => '\/',
										));
				$strPattern = strtr($strPattern,
									array(	'9' => '[0-9]',
											'a' => '[a-zA-Z]',
											'*' => '[0-9a-zA-Z]'
										));
				// Validate our mask
				if ( (preg_match("/^".$strPattern."$/", $this->strText) ) == false ){
					$this->strWarning = $this->strMaskWarning;
					return false;
				}
				
            }
            // let parent handle further validation
			return parent::Validate();
		}		

		/**
         * Refresh From AjaxAction if needed
		 */
		public function GetScript(){
			if( !$this->blnVisible )return '';
			if( !$this->blnEnabled )return '';
			if( $this->strMask == '' )return '';
			return sprintf('$("#%s").mask( "%s" )',
							$this->strControlId,
							$this->strMask
						);           
		}
		/**
		 *	Setup the Javascript
		 */
		public function GetEndScript() {
			if( !$this->blnVisible )return '';
			if( !$this->blnEnabled )return '';
			$strJavaScript = $this->GetScript();
			return "$().ready(function() {".$strJavaScript.";});";
		}
		/////////////////////////
		// Public Properties: SET
		/////////////////////////
		public function __set($strName, $mixValue) {
			$this->blnModified = true;
			switch ($strName) {
				case "Mask":
					try {
						$this->strMask = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				default:
					try {
						parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
					break;
			}
		}
		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				case "Mask":return $this->strMask;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}
?>