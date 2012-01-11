<?php

	/**
	 * Control for representing a "Collapsable" panel, that looks like this                                          
	 *  __________________________________________                                                                   
	 * | ________________________________________ |                                                                  
	 * ||[-]           header                    ||                                                                  
	 * ||________________________________________||                                                                  
	 * | ________________________________________ |                                                                  
	 * ||                                        ||                                                                  
	 * ||                                        ||                                                                  
	 * ||              body                      ||                                                                  
	 * ||                                        ||                                                                  
	 * ||________________________________________||                                                                  
	 * |__________________________________________|                                                                  
	 *                                                                                                               
	 * Clicking the toggle button expands/collapses the body but leaves the header visible.                          
	 *                                                                                                               
	 * If UseAjax is false, this is done purely on the client side. This means that the current
	 * state is not communicated back to the control object when the button is clicked.                              
	 * The control also has methods to Expand, Collapse and Toggle programatically.                                  
	 * The header and body are standard QPanel's so you can put anything in them.                                    
	 *                                                                                                               
	 * Note that, when extending this control, most likey you do not want to use it with a template,                 
	 * however you can use templates for the header and the body. If you do use a template for the header            
	 * make sure to render at least the toggle botton.                                                               
	 * 
	 * @property QPanel $Header the header panel
	 * @property QPanel $Body the body panel
	 * @property QImageButton $Button the +/- toggle button
	 * @property boolean $Expanded true if the panel is currently expanded, false if it's collapsed
	 * @property boolean $UseAjax if true, clicking the toggle button will invoke an ajax request back to the control and thus save the current state
	 * @property boolean $ClickableHeader if true the entire header panel (not just the button) can be clicked to toggle the body panel
	 *
	 * @throws QCallerException|QInvalidCastException
	 */
	class QCollapsablePanel extends QPanel {
		protected $pnlHeader;
		protected $pnlBody;
		protected $btnToggle;
		protected $blnClickableHeader = false;
		
		protected $blnExpanded;
		protected $blnUseAjax = false;
		
		protected $strExpandedImagePath;
		protected $strCollapsedImagePath;

		/**
		 * @throws QCallerException
		 * @param QControl|QForm $objParentObject parent object
		 * @param string $strControlId control Id
		 * @param bool $blnExpanded initial state of the body
		 * @param bool $blnUseAjax use ajax actions instead of javascript actions
		 * @param string $strExpandedImagePath the image path for the expanded state image ([-]). Default is QTreeNav's [-] image.
		 * @param string $strCollapsedImagePath the image path for the collapsed state image ([+]). Default is QTreeNav's [+] image.
		 * @param bool $blnClickableHeader if true the entire header panel (not just the button) can be clicked to toggle the body panel
		 */
		public function __construct($objParentObject, $strControlId = null, $blnExpanded = false, $blnUseAjax = true, $strExpandedImagePath = null, $strCollapsedImagePath = null, $blnClickableHeader = false) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
			$this->blnExpanded = $blnExpanded;
			$this->blnUseAjax = $blnUseAjax;
			$this->blnClickableHeader = $blnClickableHeader;
			if (!$this->strExpandedImagePath) {
				$this->strExpandedImagePath =  __IMAGE_ASSETS__."/treenav_expanded.png";
			}
			if (!$this->strCollapsedImagePath) {
				$this->strCollapsedImagePath =  __IMAGE_ASSETS__."/treenav_not_expanded.png";
			}
			
			$this->AutoRenderChildren = true;
			
			$this->btnToggle = new QImageButton($this);
			$this->btnToggle->ImageUrl = $blnExpanded ? $this->strExpandedImagePath : $this->strCollapsedImagePath;

			$this->pnlHeader = new QPanel($this);
			$this->pnlBody = new QPanel($this);

			$this->setBodyVisibility();
			$this->setButtonAction();
		}
		
		protected function setBodyVisibility() {
			if ($this->blnUseAjax) {
				$this->pnlBody->Visible = $this->blnExpanded;
			} else {
				$this->pnlBody->Visible = true;
				$this->pnlBody->DisplayStyle = $this->blnExpanded ? QDisplayStyle::Block : QDisplayStyle::None;
			}
		}

		protected function setButtonAction() {
			$this->btnToggle->RemoveAllActions(QClickEvent::EventName);
			$this->pnlHeader->RemoveAllActions(QClickEvent::EventName);
			if ($this->blnUseAjax) {
				$this->btnToggle->AddAction(new QClickEvent(), new QAjaxControlAction($this, "btnToggle_Click"));
				if ($this->blnClickableHeader) {
					$this->pnlHeader->AddAction(new QClickEvent(), new QAjaxControlAction($this, "btnToggle_Click"));
				}
			} else {
				if ($this->btnToggle instanceof QImageButton) {
					$strCollapseJs = sprintf("function() {jQuery('#%s').toggle(false);jQuery('#%s').attr({src:'%s'});}",
											 $this->pnlBody->ControlId,
											 $this->btnToggle->ControlId,
											 $this->strCollapsedImagePath
					);
					$strExpandJs = sprintf("function() {jQuery('#%s').toggle(true);jQuery('#%s').attr({src:'%s'});}",
											 $this->pnlBody->ControlId,
											 $this->btnToggle->ControlId,
											 $this->strExpandedImagePath
					);
				} else {
					$strCollapseJs = sprintf("function() {jQuery('#%s').toggle(false);}",
											 $this->pnlBody->ControlId
					);
					$strExpandJs = sprintf("function() {jQuery('#%s').toggle(true);}",
											 $this->pnlBody->ControlId
					);
				}
				$strJS = "jQuery('#%s').toggle(%s, %s);";
				if ($this->blnExpanded) {
					QApplication::ExecuteJavaScript(sprintf($strJS, $this->btnToggle->ControlId, $strCollapseJs, $strExpandJs));
					if ($this->blnClickableHeader) {
						QApplication::ExecuteJavaScript(sprintf($strJS, $this->pnlHeader->ControlId, $strCollapseJs, $strExpandJs));
					}
				} else {
					QApplication::ExecuteJavaScript(sprintf($strJS, $this->btnToggle->ControlId, $strExpandJs, $strCollapseJs));
					if ($this->blnClickableHeader) {
						QApplication::ExecuteJavaScript(sprintf($strJS, $this->pnlHeader->ControlId, $strExpandJs, $strCollapseJs));
					}
				}
			}
		}

		public function btnToggle_Click($strFormId, $strControlId, $strParameter) {
			$this->ToggleBody();
		}
		
		public function ToggleBody() {
			if ($this->blnExpanded) {
				$this->CollapseBody();
			} else {
				$this->ExpandBody();
			}
		}
		
		public function ExpandBody() {
			if ($this->blnUseAjax) {
				$this->pnlBody->Visible = true;
			} else {
				$this->pnlBody->Visible = true;
				$this->pnlBody->DisplayStyle = QDisplayStyle::Block;
			}
			if ($this->btnToggle instanceof QImageButton) {
				$this->btnToggle->ImageUrl = $this->strExpandedImagePath;
			}
			$this->blnExpanded = true;
			$this->MarkAsModified();
		}
		
		public function CollapseBody() {
			if ($this->blnUseAjax) {
				$this->pnlBody->Visible = false;
			} else {
				$this->pnlBody->Visible = true;
				$this->pnlBody->DisplayStyle = QDisplayStyle::None;
			}
			if ($this->btnToggle instanceof QImageButton) {
				$this->btnToggle->ImageUrl = $this->strCollapsedImagePath;
			}
			$this->blnExpanded = false;
			$this->MarkAsModified();
		}
		
		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				case "Header": return $this->pnlHeader;
				case "Body": return $this->pnlBody;
				case "Button": return $this->btnToggle;
				case "Expanded": return $this->blnExpanded;
				case "UseAjax": return $this->blnUseAjax;
				case "ClickableHeader": return $this->blnClickableHeader;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
		/////////////////////////
		// Public Properties: SET
		/////////////////////////
		public function __set($strName, $mixValue) {
			$this->blnModified = true;

			switch ($strName) {
				case "Expanded":
					try {
						$this->blnExpanded = QType::Cast($mixValue, QType::Boolean);
						if ($this->blnExpanded) {
							$this->ExpandBody();
						} else {
							$this->CollapseBody();
						}
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "Header":
					try {
						$this->pnlHeader = QType::Cast($mixValue, 'QControl');
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "Body":
					try {
						$this->pnlBody = QType::Cast($mixValue, 'QControl');
						$this->setBodyVisibility();
						$this->setButtonAction();
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "Button":
					try {
						$this->RemoveChildControl($this->btnToggle->ControlId, true);
						$this->btnToggle = QType::Cast($mixValue, 'QControl');
						$this->setButtonAction();
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "UseAjax":
					try {
						$this->blnUseAjax = QType::Cast($mixValue, QType::Boolean);
						$this->setBodyVisibility();
						$this->setButtonAction();
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "ClickableHeader":
					try {
						$this->blnClickableHeader = QType::Cast($mixValue, QType::Boolean);
						$this->setButtonAction();
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
	}
?>
