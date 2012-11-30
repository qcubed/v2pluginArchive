<?php

/**
 * QListPanelBase.class.php contains QListPanelBase Class
 * @package Controls
 */

/**
 * QListPanelBase is a control that forms a html-list from it's child controls
 * 
 * This class is intended to be modified.  Please place any custom modifications to QListPanel in the file.  
 * 
 * @package Controls
 */
class QListPanelBase extends QPanel {

	///////////////////////////
	// Private Member Variables
	///////////////////////////
	protected $strTagName = 'ul';
	protected $strDefaultDisplayStyle = QDisplayStyle::Block;
	protected $blnIsBlockElement = true;
	protected $blnHtmlEntities = false;
	/**
	 * The default css class for all QListPanel objects
	 * @var string 
	 */
	protected $strCssClass = "qq_list_panel";
	/**
	 * QListPanel renders its children automatically
	 * @var boolean 
	 */
	protected $blnAutoRenderChildren = true;

	/**
	 * Creates a QListPanel object
	 *
	 * @param QControl|QForm $objParentObject
	 * @param string $strControlId
	 * 		optional id of this Control. In html, this will be set as the value of the id attribute. The id can only
	 *    contain alphanumeric characters.  If this parameter is not passed, QCubed will generate the id
	 */
	public function __construct($objParentObject, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);
		$this->strTemplate = __PLUGINS__ . '/QListPanel/includes/QListPanel.tpl.php';
		$this->AddCssFile("../../plugins/QListPanel/css/style.css");
	}

}

?>