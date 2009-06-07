<?php
/**
 * Contains the implementation of the QJqDockItem class.
 */

/**
 * QJqDockItem class.  
 *
 * @package Controls
 * @author enzo <enzo@anexusit.com>. Integration by alex94040 <alex94040@yahoo.com>
 *
 */
class QJqDockItem extends QPanel {
	protected $strImageSource;
	protected $strLink;
	protected $strTitle;
	
    public function __construct($objParentObject,$strControlId = null) {
        parent::__construct($objParentObject,$strControlId);
    }	

	public function GetControlHtml() {
		$strToReturn = sprintf('<a href="%s"><img src="%s" alt="%s" title="%s"/></a>'
		, $this->strLink 
		, $this->strImageSource
		, $this->strTitle
		, $this->strTitle
		);
		
		return $strToReturn;
	}

	/**
	 * @access public
	 * @param string $strName
	 * @return mixed
	 */
	public function __get($strName)	{
		switch ($strName) {
			case 'Link': return $this->strLink;
			case 'ImageSource': return $this->strImageSource;
			case 'Title': return $this->strTitle;
			default:
				try {
					return parent::__get($strName);
				} catch (QCallerException $objExc){
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}

	/**
	* @access public
	* @param string $strName
	* @param mixed $mixValue
	*/
	public function __set($strName, $mixValue) {
		$this->blnModified = true;
		try {
			switch ($strName) {
				case 'Link': $this->strLink = QType::Cast($mixValue, QType::String); break;
				case "ImageSource": $this->strImageSource = QType::Cast($mixValue, QType::String); break;
				case "Title": $this->strTitle = QType::Cast($mixValue, QType::String); break;
				default: parent::__set($strName, $mixValue);
			}
		} catch (QInvalidCastException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}
}

?>