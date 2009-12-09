<?php
class QPage extends QForm {

	/**
	 * If you wish to encrypt the resulting formstate data to be put on the form (via
	 * QCryptography), please specify a key to use.  The default cipher and encrypt mode
	 * on QCryptography will be used, and because the resulting encrypted data will be
	 * sent via HTTP POST, it will be Base64 encoded.
	 *
	 * @var string EncryptionKey the key to use, or NULL if no encryption is required
	 */
	public static $EncryptionKey = '\rcH4nG3m3.\0';

	/**
	 * The QFormStateHandler to use to handle the actual serialized form.  By default,
	 * QFormStateHandler will be used (which simply outputs the entire serialized
	 * form data stream to the form), but file- and session- based, or any custom db-
	 * based FormState handling can be used as well.
	 *
	 * @var string FormStateHandler the classname of the FormState handler to use
	 */
	public static $FormStateHandler = 'QSessionFormStateHandler';

	/**
	 * Protected value for public QPage->PageTitle
	 * Sets the <title></title> for the page.
	 *
	 * @var		string
	 * @access	protected
	 */
	protected $strPageTitle = '';

	/**
	 *  Protected value for public QPage->Generator
	 *  Used for Default Meta Generator
	 *
	 * @var		string
	 * @access	protected
	 */
 	protected $strGenerator = 'QCubed';

 	/**
 	 * Protected value for public QPage->Language
	 * Contains the document language setting
	 *
	 * @var	 string
	 * @access  public
	 */
	protected $strLanguage = 'en-gb';

	/**
	 * Protected value for public QPage->Description
	 * Used for Meta Description
	 *
	 * @var	 string
	 * @access  protected
	 */
	protected $strDescription = '';

	/**
	 * Contains the document direction setting
	 *
	 * @var	 string
	 * @access  public
	 */
	protected $strPageDirection = 'ltr';
	protected $strJavaScripts = '';
	protected $strStyleSheets = '';
	protected $strMetaTagArray = array();

	protected $strEncodingType = "utf-8";
	protected $BodyOnload;
	/**
	 * Document mime type
	 *
	 * @var		string
	 * @access	private
	 */
	protected $strMimeType  = 'text/html';

	/**
	 * Document DOCTYPE
	 *
	 * @var		string
	 * @access	private
	 */
	protected $strDocType = 'XHTML 1.0 Strict';
	
	public function __set($strName, $mixValue) {
		switch ($strName) {
			case 'PageTitle':
				/**
				 * Sets the value for PageTitle
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strPageTitle = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'Generator':
				/**
				 * Sets the value for Generator
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strGenerator = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'Description':
				/**
				 * Sets the value for Description
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strDescription = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'Language':
				/**
				 * Sets the value for Language i.e. en-GB, es, fr-CA, de, etc.
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strLanguage = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'Direction':
				/**
				 * Sets the value for strPageDirection (Default 'ltr')
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strPageDirection = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'EncodingType':
				/**
				 * Sets the value for _strEncodingType (Default QApplication::$EncodingType)
				 * 
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->_strEncodingType = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'MimeType':
				/**
				 * Sets the value for strMimeType (Default 'text/html')
				 * 
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strMimeType = QType::Cast(strtolower($mixValue), QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'DocType':
				/**
				 * Sets the value for strDocType (Default 'XHTML 1.0 Strict')
				 * 
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strDocType = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case 'Header':
				/**
				 * Sets the value for _strHeader (Default '')
				 * 
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->_strHeader = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			default:
				try {
					return parent::__set($strName, $mixValue);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}
	
	
	public function __get($strName) {
		switch ($strName) {
			///////////////////
			// Member Variables
			///////////////////
			case 'PageTitle':
				/**
				 * Gets the Default Page Title
				 * @return string
				 */
				return $this->PageTitle;
			case 'MetaTags':
				/**
				 * Gets the array of Meta Tags
				 * @return array
				 */
				return (array) $this->arrMetaTags;
			case 'DocType':
				/**
				 * Gets the Document Type
				 * @return string
				 */
				return $this->strDocType;
			case 'EncodingType':
				/**
				 * Gets the Encoding Type
				 * @return string
				 */
				return $this->strEncodingType;
			case 'MimeType':
				/**
				 * Gets the Mime Type
				 * @return string
				 */
				return $this->strMimeType;
			case 'PageDirection':
				/**
				 * Gets the Page Direction
				 * @return string
				 */
				return $this->strPageDirection;
			case 'Language':
				/**
				 * Gets the Language Used
				 * @return string
				 */
				return $this->strLanguage;
			case 'Description':
				/**
				 * Gets the Description for meta info
				 * @return string
				 */
				return $this->strDescription;
			case "JavaScripts": return $this->strJavaScripts;
			case "StyleSheets": return $this->strStyleSheets;
			default:
				try {
					return parent::__get($strName);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}
	/**
	 * These are the list of core QForm JavaScript files, or JavaScript files needed by
	 * a QControl, which QForm should IGNORE trying to load during a RenderBegin() or RenderAjax() call.
	 * 
	 * In production or as a performance tweak, you may want to use the compressed "_qc_packed.js"
	 * library (which is a compressed, single file version of ALL the QCubed .js files that is in _core).
	 * 
	 * If you want to do this, MAKE SURE you FIRST MANUALLY do a <script> inclusion of "/assets/js/_qc_packed.js" in
	 * your HTML.  Then, you can specify that QForm "ignore" all the other QCubed _core javascripts.
	 *
	 * @var array
	 */
	protected $strIgnoreJavaScriptFileArray = array();
	/* protected $strIgnoreJavaScriptFileArray = array(
		'calendar.js',
		'calendar_popup.js',
		'control.js',
		'control_dialog.js',
		'control_handle.js',
		'control_move.js',
		'control_resize.js',
		'control_rollover.js',
		'date_time_picker.js',
		'event.js',
		'listbox.js',
		'logger.js',
		'post.js',
		'qcodo.js',
		'treenav.js'); */

	/**
	 * This should be very rarely used.
	 * 
	 * This mechanism acts similarly to the strIgnoreJavascriptFileArray, except it applies to StyleSheets.
	 * However, any QControl that specifies a StyleSheet file to include is MEANT to have that property be modified / customized.
	 * 
	 * Therefore, there should be little to no need for this attribute.  However, it is here anyway, just in case.
	 *
	 * @var array
	 */
	protected $strIgnoreStyleSheetFileArray = array();
	// protected $strIgnoreStyleSheetFileArray = array('datagrid.css', 'calendar.css', 'textbox.css', 'listbox.css');
	
	protected function Form_Create() {
		parent::Form_Create();
				
		foreach ($this->GetAllControls() as $objControl) {
			// Include any JavaScripts?  The control would have a
			// comma-delimited list of javascript files to include (if applicable)
			if ($strScriptArray = $this->ProcessJavaScriptList($objControl->JavaScripts))
				$strJavaScriptArray = array_merge($strJavaScriptArray, $strScriptArray);

			// Include any StyleSheets?  The control would have a
			// comma-delimited list of stylesheet files to include (if applicable)
			if ($strStyleArray = $this->ProcessStyleSheetList($objControl->StyleSheets))
				$strStyleSheetArray = array_merge($strStyleSheetArray, $strStyleArray);

			// Form Attributes?
			if ($objControl->FormAttributes) {
				$this->strFormAttributeArray = array_merge($this->strFormAttributeArray, $objControl->FormAttributes);
			}
		}
		
	}
	
	public function AddMetaData($name, $content, $http_equiv = false){
		$name = strtolower($name);
		if($name == 'generator') { 
			$this->Generator = $content;
		} elseif($name == 'description') {
			$this->Description = $content;
		} else {
			if ($http_equiv == true) {
				if ($name == 'Content-Type') {
					$this->MimeType = $content;
				}else{
					$this->_arrMetaTags['http-equiv'][$name] = $content;
				}
			} else {
				$this->_arrMetaTags['standard'][$name] = $content;
			}
		}
	}

	public function AddJavascriptFile($strJsFileName) {
		if($this->strJavaScripts) {
			$this->strJavaScripts .= ','.$strJsFileName;
		} else {
			$this->strJavaScripts = $strJsFileName;
		}
	}
	
	public function AddCssFile($strCssFileName) {
		if($this->strStyleSheets) {
			$this->strStyleSheets .= ','.$strCssFileName;
		} else {
			$this->strStyleSheets = $strCssFileName;
		}
	}
	
	public function RenderBegin($blnDisplayOutput = true) {
		// Ensure that RenderBegin() has not yet been called
		switch ($this->intFormStatus) {
			case QFormBase::FormStatusUnrendered:
				break;
			case QFormBase::FormStatusRenderBegun:
			case QFormBase::FormStatusRenderEnded:
				throw new QCallerException('$this->RenderBegin() has already been called');
				break;
			default:
				throw new QCallerException('FormStatus is in an unknown status');
		}
		// Update FormStatus and Clear Included JS/CSS list
		$this->intFormStatus = QFormBase::FormStatusRenderBegun;
		$strToReturn = '';
		$strToReturn .= $this->HtmlHead();
		$strToReturn .= $this->HtmlBodyBegin();
		$strToReturn .= $this->HtmlFormBegin();
		// Perhaps a strFormModifiers as an array to
		// allow controls to update other parts of the form, like enctype, onsubmit, etc.

		// Return or Display
		if ($blnDisplayOutput) {
			print($strToReturn);
			return null;
		} else
			return $strToReturn;
		// Return or Display
		if ($blnDisplayOutput) {
			print($strToReturn);
			return null;
		} else
			return $strToReturn;
	}

	public function RenderEnd($blnDisplayOutput = true) {
		// Ensure that RenderEnd() has not yet been called
		switch ($this->intFormStatus) {
			case QFormBase::FormStatusUnrendered:
				throw new QCallerException('$this->RenderBegin() was never called');
			case QFormBase::FormStatusRenderBegun:
				break;
			case QFormBase::FormStatusRenderEnded:
				throw new QCallerException('$this->RenderEnd() has already been called');
				break;
			default:
				throw new QCallerException('FormStatus is in an unknown status');
		}

		$strToReturn = '';
		$strToReturn .= $this->HtmlFormEnd();
		$strToReturn .= $this->WriteEndScripts();

		$strToReturn .= "\n</div></body></html>";

		// Update Form Status
		$this->intFormStatus = QFormBase::FormStatusRenderEnded;

		// Display or Return
		if ($blnDisplayOutput) {
			print($strToReturn);
			return null;
		} else
			return $strToReturn;
	}

	protected function HtmlFormBegin() {
		$ret = '';
		// Iterate through the form's ControlArray to Define FormAttributes and additional JavaScriptIncludes
		$this->strFormAttributeArray = array();
		
		if (is_array($this->strCustomAttributeArray))
			$this->strFormAttributeArray = array_merge($this->strFormAttributeArray, $this->strCustomAttributeArray);

		// Create $strFormAttributes
		$strFormAttributes = '';
		foreach ($this->strFormAttributeArray as $strKey=>$strValue) {
			$strFormAttributes .= sprintf(' %s="%s"', $strKey, $strValue);
		}

		if ($this->strCssClass)
			$strFormAttributes .= ' class="' . $this->strCssClass . '"';

		// Setup Rendered HTML
		$ret .= sprintf('<form method="post" id="%s" action="%s"%s>', $this->strFormId, QApplication::$RequestUri, $strFormAttributes);
		$ret .= "\r\n";
		return $ret;
	}
	
	
	protected function HtmlHead() {
		$ret = '';
		$ret .= $this->WriteDocType();
		$ret .= "\r\n\t<head>";	
		$ret .= "\r\n\t\t".'<meta http-equiv="Content-Type" content="'.$this->strMimeType.'; charset='.$this->strEncodingType.'" />';
		$ret .= "\r\n\t\t<title>".$this->strPageTitle."</title>";
		$ret .= "\r\n\t\t".'<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />';
		$ret .= $this->WriteStylesheets();
		$ret .= $this->WriteJavaScripts();
		
		$ret .= "\r\n\t</head>";
		return $ret;
	}	
	
	protected function HtmlBodyBegin() {
		return sprintf("	<body%s><div class=\"container_12\">", $this->BodyOnload);
	}

	protected function WriteDocType() {
		$ret = '';
		switch($this->DocType) {
			case "XHTML 1.0 Strict":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
				$ret .= "\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"".$this->strLanguage."\" lang=\"".$this->strLanguage."\">";
				break;
			case "XHTML 1.0 Transitional":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
				$ret .= "\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"".$this->strLanguage."\" lang=\"".$this->strLanguage."\">";
				break;
			case "XHTML 1.0 Frameset":				
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">';
				$ret .= "\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"".$this->strLanguage."\" lang=\"".$this->strLanguage."\">";
				break;
			case "XHTML 1.1":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
				$ret .= "\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"".$this->strLanguage."\">";
				break;
			case "HTML 4.01 Strict":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/html4/strict.dtd">';
				$ret .= '<html lang="'.$this->strLanguage.'">';
				break;
			case "HTML 4.01 Transitional":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/html4/transitioinal.dtd">';
				$ret .= '<html lang="'.$this->strLanguage.'">';
				break;
			case "HTML5":
				$ret .= '<!DOCTYPE html>'."\n".'<html lang="'.$this->strLanguage.'">';
				break;
			case "HTML 3.2":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN">'."\n<html>";
				break;
			case "HTML 2.0":
				$ret .= '<!DOCTYPE html PUBLIC "-//IETF//DTD '.$this->strDocType.'//EN">'."\n<html>";
				break;
			case "XHTML+RDFa 1.0":
				$ret .= '<?xml version="1.0" encoding="'.$this->strEncodingType.'"?>'."\n";
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">';
				$ret .= '<html xmlns="http://www.w3.org/1999/xhtml"
				    xmlns:foaf="http://xmlns.com/foaf/0.1/"
				    xmlns:dc="http://purl.org/dc/elements/1.1/" 
				    version="'.$this->strDocType.'" xml:lang="'.$this->strLanguage.'">';
				break;
			case "XHTML Basic 1.0":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">';
				$ret .= "\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"".$this->strLanguage."\" lang=\"".$this->strLanguage."\">";
				break;
			case "XHTML Basic 1.1":
				$ret .= '<!DOCTYPE html PUBLIC "-//W3C//DTD '.$this->strDocType.'//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">';
				$ret .= "\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"".$this->strLanguage."\" lang=\"".$this->strLanguage."\">";
				break;
			case "XHTML Mobile 1.2":
				$ret .= '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD '.$this->strDocType.'//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">';
				$ret .= "\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"".$this->strLanguage."\">";
				break;
			default:
				throw new QCallerException('Unknown DocType');
				break;
		}
		return $ret;
	}
	
	protected function WriteStylesheets() {
		$ret = '';
		
		$this->strIncludedStyleSheetFileArray = array();
		// Figure out initial list of StyleSheet includes
		
		$strStyleSheetArray = $this->ProcessStyleSheetList($this->strStyleSheets);
		if (!$strStyleSheetArray) {
			$strStyleSheetArray = array();
			$ret .= "\r\n";
		}
		foreach ($this->GetAllControls() as $objControl) {
				// Include any StyleSheets?  The control would have a
				// comma-delimited list of stylesheet files to include (if applicable)
				if ($strScriptArray = $this->ProcessStyleSheetList($objControl->StyleSheets))
					$strStyleSheetArray = array_merge($strStyleSheetArray, $strScriptArray);
		}
		// Include styles that need to be included
		foreach ($strStyleSheetArray as $strScript) {
			$ret .= sprintf('<style type="text/css" media="all">@import "%s/%s";</style>', __VIRTUAL_DIRECTORY__ . __CSS_ASSETS__, $strScript);
			$ret .= "\r\n";
		}
		return $ret;
	}
	
	protected function WriteJavaScripts() {
		$ret = '';
		$this->strIncludedJavaScriptFileArray = array();
		$strJavaScriptArray = $this->ProcessJavaScriptList($this->strJavaScripts);
		foreach ($this->GetAllControls() as $objControl) {
				// Include any JavaScripts?  The control would have a
				// comma-delimited list of js files to include (if applicable)
				if ($strScriptArray = $this->ProcessJavaScriptList($objControl->JavaScripts))
					$strJavaScriptArray = array_merge($strJavaScriptArray, $strScriptArray);
		}// Figure out initial list of JavaScriptIncludes
		if (!$strJavaScriptArray)
			$strJavaScriptArray = array();
		
		// Include javascripts that need to be included
		foreach ($strJavaScriptArray as $strScript) {	
			if(strpos($strScript, "http") === 0){
				$ret .= sprintf('<script type="text/javascript" src="%s"></script>', $strScript);
			}else{
				$ret .= sprintf('<script type="text/javascript" src="%s/%s"></script>', __VIRTUAL_DIRECTORY__ . __JS_ASSETS__, $strScript);
			}
			$ret .= "\r\n";
		}
		return $ret;
	}
	
	protected function WriteMetaTags() {
		$ret = '';
		$ret .= '<meta name="Description" content="'.$this->strDescription.'" />'."\r\n";
		return $ret;
	}
	
	protected function HtmlFormEnd() {
		// Persist Controls (if applicable)
		foreach ($this->objPersistentControlArray as $objControl)
			$objControl->Persist();

		// Clone Myself
		$objForm = clone($this);
		// Render HTML
		$strToReturn = "\r\n<div style=\"display: none;\">\r\n\t";
		$strToReturn .= sprintf('<input type="hidden" name="Qform__FormState" id="Qform__FormState" value="%s" />', QForm::Serialize($objForm));

		$strToReturn .= "\r\n\t";
		$strToReturn .= sprintf('<input type="hidden" name="Qform__FormId" id="Qform__FormId" value="%s" />', $this->strFormId);
		$strToReturn .= "\r\n</div>\r\n";

		// The Following "Hidden Form Variables" are no longer explicitly rendered in HTML, but are now
		// added to the DOM by the QCubed JavaScript Library method qc.initialize():
		// * Qform__FormControl
		// * Qform__FormEvent
		// * Qform__FormParameter
		// * Qform__FormCallType
		// * Qform__FormUpdates
		// * Qform__FormCheckableControls

		foreach ($this->GetAllControls() as $objControl)
			if ($objControl->Rendered)
				$strToReturn .= $objControl->GetEndHtml();

		$strToReturn .= "\r\n</form>";
		return $strToReturn;
	}

	protected function WriteEndScripts() {
		// Setup End Script
		$strEndScript = '';
		
		// First, call regC on all Controls
		$strControlIdToRegister = array();
		foreach ($this->GetAllControls() as $objControl)
			if ($objControl->Rendered)
				array_push($strControlIdToRegister, '"' . $objControl->ControlId . '"');
		if (count($strControlIdToRegister))
			$strEndScript .= sprintf('qc.regCA(new Array(%s)); ', implode(',', $strControlIdToRegister));

		// Next, run any GetEndScrips on Controls and Groupings
		foreach ($this->GetAllControls() as $objControl)
			if ($objControl->Rendered)
				$strEndScript .= $objControl->GetEndScript();
		foreach ($this->objGroupingArray as $objGrouping)
			$strEndScript .= $objGrouping->Render();

		// Run End Script Compressor
		$strEndScriptArray = explode('; ', $strEndScript);
		$strEndScriptCommands = array();
		foreach ($strEndScriptArray as $strEndScript)
			$strEndScriptCommands[trim($strEndScript)] = true;
		$strEndScript = implode('; ', array_keys($strEndScriptCommands));

		// Finally, add any application level js commands
		$strEndScript .= QApplication::RenderJavaScript(false);

		// Next, go through all controls and gather up any JS or CSS to run or Form Attributes to modify
		// due to dynamically created controls
		$strJavaScriptToAddArray = array();
		$strStyleSheetToAddArray = array();
		$strFormAttributeToModifyArray = array();

		foreach ($this->GetAllControls() as $objControl) {
			// Include any JavaScripts?  The control would have a
			// comma-delimited list of javascript files to include (if applicable)
			if ($strScriptArray = $this->ProcessJavaScriptList($objControl->JavaScripts))
				$strJavaScriptToAddArray = array_merge($strJavaScriptToAddArray, $strScriptArray);

			// Include any StyleSheets?  The control would have a
			// comma-delimited list of stylesheet files to include (if applicable)
			if ($strScriptArray = $this->ProcessStyleSheetList($objControl->StyleSheets))
				$strStyleSheetToAddArray = array_merge($strStyleSheetToAddArray, $strScriptArray);

			// Form Attributes?
			if ($objControl->FormAttributes) {
				foreach ($objControl->FormAttributes as $strKey=>$strValue) {
					if (!array_key_exists($strKey, $this->strFormAttributeArray)) {
						$this->strFormAttributeArray[$strKey] = $strValue;
						$strFormAttributeToModifyArray[$strKey] = $strValue;
					} else if ($this->strFormAttributeArray[$strKey] != $strValue) {
						$this->strFormAttributeArray[$strKey] = $strValue;
						$strFormAttributeToModifyArray[$strKey] = $strValue;
					}
				}
			}
		}

		// Finally, render the JS Commands to Execute

		// First, alter any <Form> settings that need to be altered
		foreach ($strFormAttributeToModifyArray as $strKey=>$strValue)
			$strEndScript .= sprintf('document.getElementById("%s").%s = "%s"; ', $this->strFormId, $strKey, $strValue);

		// Next, add any new CSS files that haven't yet been included to the end of the High Priority commands string
		foreach ($strStyleSheetToAddArray as $strScript)
			$strEndScript .= 'qc.loadStyleSheetFile("' . $strScript . '", "all"); ';

		// Next, add any new JS files that haven't yet been included to the BEGINNING of the High Priority commands string
		// (already rendered HP commands up to this point will be placed into the callback)
		foreach (array_reverse($strJavaScriptToAddArray) as $strScript) {
			if ($strEndScript)
				$strEndScript = 'qc.loadJavaScriptFile("' . $strScript . '", function() {' . $strEndScript . '}); ';
			else
				$strEndScript = 'qc.loadJavaScriptFile("' . $strScript . '", null); ';
		}

		// Finally, add QCubed includes path
		$strEndScript = sprintf('qc.jsAssets = "%s"; ', __VIRTUAL_DIRECTORY__ . __JS_ASSETS__) . $strEndScript;
		$strEndScript = sprintf('qc.phpAssets = "%s"; ', __VIRTUAL_DIRECTORY__ . __PHP_ASSETS__) . $strEndScript;
		$strEndScript = sprintf('qc.cssAssets = "%s"; ', __VIRTUAL_DIRECTORY__ . __CSS_ASSETS__) . $strEndScript;
		$strEndScript = sprintf('qc.imageAssets = "%s"; ', __VIRTUAL_DIRECTORY__ . __IMAGE_ASSETS__) . $strEndScript;
		// Create Final EndScript Script
		$strEndScript = sprintf('<script type="text/javascript">qc.registerForm(); %s</script>', $strEndScript);
		
		return $strEndScript;
	}
}
?>