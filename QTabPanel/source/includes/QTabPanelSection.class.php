<?php
class QTabPanelSection extends QPanel {
	protected $strTitle;

	const TabPanelSectionStatusUnrendered = 1;
	const TabPanelSectionStatusRenderBegun = 2;
	const TabPanelSectionStatusRenderEnded = 3;
	protected $intTabPanelSectionStatus = QTabPanelSection::TabPanelSectionStatusUnrendered;

	protected $intCurrentSection;
	protected $strParentControlId;

	public function __construct($objParentObject, $strControlId = null) {
		if(!($objParentObject instanceof QTabPanel)) {
			throw new QCallerException('ParentObject of QTabPanelSection must be a QTabPanel');
		}

		// Increment and get the current section for parent
		$this->CurrentSection = ++ $objParentObject->CurrentSection;
		$this->ParentControlId = $objParentObject->ControlId;

		try {
			parent::__construct($objParentObject,$strControlId);
		} catch (QCallerException $objExc) {
			$objExc->incrementOffset();
			throw $objExc;
		}
	}

	// And our public getter/setters
	public function __get($strName) {
		switch ($strName) {
			case 'Title': return $this->strTitle;
			case 'TabPanelSectionStatus': return $this->intTabPanelSectionStatus;
			case 'CurrentSection': return $this->intCurrentSection;
			case 'ParentControlId': return $this->strParentControlId;
			default:
				try {
					return parent::__get($strName);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}

	public function __set($strName, $mixValue) {
		// Whenever we set a property, we must set the Modified flag to true
		$this->blnModified = true;

		try {
			switch ($strName) {
				case 'Title': return ($this->strTitle = QType::Cast($mixValue, QType::String));
				case 'TabPanelSectionStatus': return ($this->intTabPanelSectionStatus = QType::Cast($mixValue, QType::Integer));
				case 'CurrentSection': return ($this->intCurrentSection = QType::Cast($mixValue, QType::Integer));
				case 'ParentControlId': return ($this->strParentControlId = QType::Cast($mixValue, QType::String));
				default:
					return (parent::__set($strName, $mixValue));
			}
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	public function Render($blnDisplayOutput = true) {
		// Ensure that RenderBegin() has not yet been called
		switch ($this->intTabPanelSectionStatus) {
			case QTabPanelSection::TabPanelSectionStatusUnrendered:
			case QTabPanelSection::TabPanelSectionStatusRenderEnded:
				break;
			case QTabPanelSection::TabPanelSectionStatusRenderBegun:
				throw new QCallerException('$this->RenderBegin() has already been called');
				break;
			default:
				throw new QCallerException('TabPanelSectionStatus is in an unknown status');
		}

		// Update TabPanelSectionStatus
		$this->intTabPanelSectionStatus = QTabPanelSection::TabPanelSectionStatusRenderBegun;

		// Create the Section
		$strContent = sprintf("\t<div id='%sqtab%s'>",
			$this->ParentControlId,
			$this->intCurrentSection
		);

		// Nothing else to return
		$strToReturn = $strContent;

		foreach ($this->GetChildControls() as $objControl) {
			if($objControl instanceof QTabPanel || $objControl instanceof QTabPanelSection) {
				$strToReturn.= $objControl->Render(false);
			} else {
                    if($objControl->Name)
                        $strToReturn.= $objControl->RenderWithName(false);
                    else
                        $strToReturn.= $objControl->Render(false);	
            }
		}

		$strToReturn .=   $this->RenderEnd($blnDisplayOutput);

		// Return or Display
		if ($blnDisplayOutput) {
			print ($strToReturn);
			return null;
		} else {
			return $strToReturn;
		}
	}

	public function RenderEnd($blnDisplayOutput = true) {
		// Ensure that RenderEnd() has not yet been called
		switch ($this->intTabPanelSectionStatus) {
			case QTabPanelSection::TabPanelSectionStatusUnrendered:
				throw new QCallerException('$this->RenderBegin() was never called');
			case QTabPanelSection::TabPanelSectionStatusRenderBegun:
				break;
			case QTabPanelSection::TabPanelSectionStatusRenderEnded:
				throw new QCallerException('$this->RenderEnd() has already been called');
				break;
			default:
				throw new QCallerException('TabPanelSectionStatus is in an unknown status');
		}

		// That's all!
		$strToReturn = "\t</div>";

		// Update TabPanelSection Status
		$this->intTabPanelSectionStatus = QTabPanelSection::TabPanelSectionStatusRenderEnded;

		// Display or Return
		if ($blnDisplayOutput) {
			print ($strToReturn);
			return null;
		} else {
			return $strToReturn;
		}
	}
}
?>