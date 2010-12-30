<?php
/**
 * Contains the implementation of the QJqDock class.
 */

/**
 * QJqDock class. Implementation of the MacOS-style fisheye control. 
 *
 * @package Controls
 * @author enzo <enzo@anexusit.com>. Integration by alex94040 <alex94040@yahoo.com>
 *
 */
class QJqDock extends QPanel {
	protected $strAlign;
	protected $strLabels;
	protected $fltSize;
	protected $intDistance;
	protected $fltCoefficient;
	
		public function __construct($objParentObject,$strControlId = null) {
			parent::__construct($objParentObject,$strControlId);
			$this->AutoRenderChildren = true;
			$this->setJavaScripts();
		}	

	private function setJavaScripts() {
		$this->AddJavascriptFile(__JQUERY_BASE__);
		$this->AddPluginJavascriptFile("QJqDock", "jquery.jqDock.min.js");
		/*
		$this->AddPluginCssFile("QjQDock", "jqDock.css");
		if (QApplication::IsBrowser(QBrowserType::InternetExplorer)) {
			$this->AddPluginCssFile("QjQDock", "jqDock.css_ie.css");
		}
		*/
	}
	
	public function Render($blnDisplayOutput = true) {
		$strToReturn = parent::Render($blnDisplayOutput);
		QApplication::ExecuteJavaScript(sprintf(
		 "jQuery(document).ready(function() {
				jQuery('#%s').jqDock({
					align: '%s',
					labels: '%s',
					size: %s,
					distance: %s,
					coefficient: %s
					});
			});"
		, $this->strControlId // ID of This Control
		, $this->strAlign // Align
		, $this->strLabels // label orientation
		, $this->fltSize // Size
		, $this->intDistance // Distance
		, $this->fltCoefficient // Coefficient
		));

		return $strToReturn;
	}

	/**
	 * @access public
	 * @param string $strName
	 * @return mixed
	 */
	public function __get($strName)	{
		switch ($strName) {
			case 'Align': return $this->strAlign;
			case 'Labels': return $this->strLabels;
			case 'Size': return $this->fltSize;
			case 'Distance': return $this->intDistance;
			case 'Coefficient': return $this->fltCoefficient;
			default:
				try {
					return parent::__get($strName);
				}
				catch (QCallerException $objExc) {
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
	public function __set($strName, $mixValue)	{
		$this->blnModified = true;
		try {
			switch ($strName) {
				case 'Align': $this->strAlign = QType::Cast($mixValue, QType::String); break;
				case "Labels": $this->strLabels = QType::Cast($mixValue, QType::String); break;
				case "Size": $this->fltSize = QType::Cast($mixValue, QType::Float); break;
				case "Distance": $this->intDistance = QType::Cast($mixValue, QType::Integer); break;
				case "Coefficient": $this->fltCoefficient = QType::Cast($mixValue, QType::Float); break;
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