<?php
class QTabPanel extends QBlockControl {
	const TabPanelSwitchSpeedNormal = 'normal';
	const TabPanelSwitchSpeedFast = 'fast';
	const TabPanelSwitchSpeedSlow = 'slow';

	protected $strActiveBGColor;
	protected $strInactiveBGColor;
	protected $intCurrentSection = 0;
	protected $intActiveTab = 1;
	protected $blnSwitchWithFade = true;
	protected $blnSwitchWithSlide = true;
	protected $strSwitchSpeed;
	protected $blnAutoHeight = false;
	protected $blnTabsOnBottom = false;
	protected $arrSections;

	public function __construct($objParentObject, $strControlId = null) {
	if ($objParentObject) {
		parent::__construct($objParentObject, $strControlId);
	}

	$this->setFiles();
}

private function setFiles() {
	$this->AddJavascriptFile(__JQUERY_BASE__);
	$this->AddPluginJavascriptFile("QTabPanel", "jquery.tabs.js");

	$this->AddPluginCssFile("QTabPanel", "jquery.tabs.css");
	if (QApplication::IsBrowser(QBrowserType::InternetExplorer)) {
		$this->AddPluginCssFile("QTabPanel", "jquery.tabs-ie.css");
	}
}		
	
	public function __get($strName) {
		switch ($strName) {
			case 'ActiveBGColor': return $this->strActiveBGColor;
			case 'InactiveBGColor': return $this->strInactiveBGColor;
			case 'CurrentSection': return $this->intCurrentSection;
			case 'ActiveTab': return $this->intActiveTab;
			case 'TabPanelStatus': return $this->intTabPanelStatus;
			case 'SwitchWithFade': return $this->blnSwitchWithFade;
			case 'SwitchWithSlide': return $this->blnSwitchWithSlide;
			case 'SwitchSpeed': return $this->strSwitchSpeed;
			case 'AutoHeight': return $this->blnAutoHeight;
			case 'TabsOnBottom': return $this->blnTabsOnBottom;
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
				case 'ActiveBGColor': return ($this->strActiveBGColor = QType::Cast($mixValue, QType::String));
				case 'InactiveBGColor': return ($this->strInactiveBGColor = QType::Cast($mixValue, QType::String));
				case 'CurrentSection': return ($this->intCurrentSection = QType::Cast($mixValue, QType::Integer));
				case 'ActiveTab': 				
					try {
						return ($this->intActiveTab = QType::Cast($mixValue, QType::Integer));
						break;
					} catch (QInvalidCastException $objExc) {
						return ($this->intActiveTab = 0);
					} 
				case 'TabPanelStatus': return ($this->intTabPanelStatus = QType::Cast($mixValue, QType::Integer));
				case 'SwitchWithFade': return ($this->blnSwitchWithFade = QType::Cast($mixValue, QType::Boolean));
				case 'SwitchWithSlide': return ($this->blnSwitchWithSlide = QType::Cast($mixValue, QType::Boolean));
				case 'SwitchSpeed':
						if ($mixValue == QTabPanel::TabPanelSwitchSpeedNormal || $mixValue == QTabPanel::TabPanelSwitchSpeedFast || $mixValue == QTabPanel::TabPanelSwitchSpeedSlow)
							return ($this->strSwitchSpeed = QType::Cast($mixValue, QType::String));
						else {
							$objExc = new QCallerException('Invalid TabSwitchSpeed');
							$objExc->DecrementOffset();
							throw $objExc;
							return null;
						}
				// For some reason, using AutoHeight can sometimes cause the browser (at least IE7) to choke
				// Use with caution
				case 'AutoHeight': return ($this->blnAutoHeight = QType::Cast($mixValue, QType::Boolean));
				case 'TabsOnBottom':
					$this->blnTabsOnBottom = QType::Cast($mixValue, QType::Boolean);
					$this->CssClass = $this->blnTabsOnBottom ? 'bottom' : '';
					return $this->blnTabsOnBottom;
				default:
					return (parent::__set($strName, $mixValue));
			}
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}
	
	protected function BuildToc() {
		$intTab = 1;
		$strToc = "\n\t\t\t<ul>\n";

		// Create the TOC
		foreach ($this->GetChildControls() as $objControl) {
			// For nested tab panels - skip if the current object is a QTabPanelSection
			if(!($objControl instanceof QTabPanelSection))
				continue;

			// TOC
			if(!($strTitle = $objControl->Title))
				$strTitle = 'Tab '.$intTab;
			$strToc .= sprintf("\t\t\t\t<li><a href='#%sqtab%s'><span>%s</span></a></li>\n",
				$this->strControlId,
				$intTab,
				$strTitle
			);

			$this->arrSections[$intTab] = $objControl->ControlId;
			$intTab++;
		}

		return $strToc . "\t\t\t</ul>\n";
	}

	public function Render($blnDisplayOutput = true) {
		$this->RenderHelper(func_get_args(), __FUNCTION__);

		if ($strStyle = $this->GetStyleAttributes())
			$strStyle = sprintf('style="%s"', $strStyle);
		
		$strToc = $this->blnTabsOnBottom ? '' : $this->BuildToc();

		// The actual tab headers
		$strToReturn = sprintf("<div id='%s_ctl'>\n\t\t<div id='%s' %s%s>%s",
			$this->strControlId,
			$this->strControlId,
			$this->GetAttributes(),
			$strStyle,
			$strToc
		);
	
		foreach ($this->GetChildControls() as $objControl) {                    
			$strToReturn.= $objControl->Render(false);
		}

		$strToReturn.= $this->RenderEnd($blnDisplayOutput);

		// Return or Display
		if ($blnDisplayOutput) {
			print ($strToReturn);
			return null;
		} else {
			return $strToReturn;
		}
	}

	public function RenderEnd($blnDisplayOutput = true) {
		if(!$this->blnRendering || $this->blnRendered) {
			throw new QCallerException('$this->RenderBegin() was never called');
		}
		
		$this->blnRendering = false;
		$this->blnRendered = true;
		$this->blnOnPage = true;

		$strToReturn = ($this->blnTabsOnBottom ? $this->BuildToc() : "") . "\n\t\t</div>\n\t</div>";

		if ($this->blnDropTarget)
			$strToReturn .= sprintf('<span id="%s_ctldzmask" style="position:absolute;"><span style="font-size: 1px">&nbsp;</span></span>',
			$this->strControlId
		);

		// Display or Return
		if ($blnDisplayOutput) {
			print ($strToReturn);
			return null;
		} else {
			return $strToReturn;
		}
	}
	
	public function GetEndScript() {
		$strSwitchStyles = '' ;
		
		if ($this->blnSwitchWithSlide || $this->blnSwitchWithSlide || $this->blnAutoHeight || $this->strSwitchSpeed){
			//Fix to avoid issues in IE.
			$strSwitchStyles = 'fx: {';
				if($this->blnSwitchWithSlide) $strSwitchStyles.='height: \'toggle\'';
				if($this->blnSwitchWithSlide && $this->blnSwitchWithFade) $strSwitchStyles.=","; 
				if($this->blnSwitchWithFade) $strSwitchStyles.='opacity: \'toggle\'';
				if(($this->blnSwitchWithSlide || $this->blnSwitchWithFade) && $this->strSwitchSpeed) $strSwitchStyles.=",";
				if($this->strSwitchSpeed)      $strSwitchStyles.=sprintf('speed: \'%s\',', $this->strSwitchSpeed);
				if(($this->blnSwitchWithSlide || $this->blnSwitchWithFade || $this->strSwitchSpeed) && $this->blnAutoHeight) $strSwitchStyles.=","; 
				if($this->blnAutoHeight)	  $strSwitchStyles.= 'autoheight: true';
			$strSwitchStyles.='},'; 			
		}
		return sprintf('$(\'#%s > ul\').tabs({ selected: %s,  %s  select: function(tab) {'
			. 'qc.recordControlModification(\'%s\', "ActiveTab", tab.id);} });',
					$this->strControlId,
					$this->intActiveTab,
					$strSwitchStyles,
					$this->strControlId,
					$this->strControlId
			);
	}
	
	// by carlos silva - carlos.silva@cminds.eu	
	public function DisableTabs($tabs){		
		QApplication::ExecuteJavaScript(sprintf("$('#%s > ul').tabs({ disabled: [%s] });",$this->strControlId,$tabs));
	}
	
	public function SelectTab($tab){		
		QApplication::ExecuteJavaScript(sprintf("$('#%s > ul').tabs({ select: %s });",$this->strControlId,$tab));		
	}
	
	public function EnableTab($tab){		
		QApplication::ExecuteJavaScript(sprintf("$('#%s > ul').tabs({ enable: %s });",$this->strControlId,$tab));		
	}

	//http://www.qcodo.com/forums/topic.php/1482/1/2/?strSearch=qtabpanel
	protected function ValidateControlAndChildren(QControl $objControl) {
		// Initially Assume Validation is True
		$blnToReturn = true;

		// Check the Control Itself
		if (!$objControl->Validate()) {
			$objControl->MarkAsModified();
			$blnToReturn = false;
		}

		// Recursive call on Child Controls
		foreach ($objControl->GetChildControls() as $objChildControl)
			// Only Enabled and Visible and Rendered controls should be validated
			if (($objChildControl->Visible) && ($objChildControl->Enabled) && ($objChildControl->RenderMethod) && ($objChildControl->OnPage))
				if (!$this->ValidateControlAndChildren($objChildControl))
					$blnToReturn = false;

		return $blnToReturn;
	}

	public function validate() {
		foreach ($this->GetChildControls() as $objChildControl) {
			if (!$this->ValidateControlAndChildren($objChildControl)) {
				return false;
			}
		}
		
		return true;
	}
}
?>