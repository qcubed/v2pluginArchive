<?php

	class QReport extends QPaginatedControl {
		///////////////////////////
		// Private Member Variables
		///////////////////////////
		// APPEARANCE
		protected $objAlternateRowStyle = null;
		protected $strBorderCollapse = QBorderCollapse::NotSet;
		protected $objOverrideRowStyleArray = null;
		protected $objRowStyle = null;

		// LAYOUT
		protected $intCellPadding = -1;
		protected $intCellSpacing = -1;
		protected $strGridLines = QGridLines::None;
		protected $blnShowHeader = true;
		protected $blnShowFooter = false;

		// Data
		protected $objData = array();
		protected $objHeader = array();
		protected $intCurrentRow = 0;

		protected $strTemplate;
		protected $strText;
		protected $blnHtmlEntities = false;
		
		// MISC
		protected $strLabelForNoneFound;
		protected $strLabelForPaginated;

		public function __construct($objParentObject, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException  $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}


			// Labels
			$this->strLabelForNoneFound = QApplication::Translate('<b>Results:</b> No %s found.');
			$this->strLabelForPaginated = QApplication::Translate('<b>Results:</b>&nbsp;%s&nbsp;%s-%s&nbsp;of&nbsp;%s.');
		}
		//////////
		// Methods
		//////////
		public function PushRow() {
			$this->intCurrentRow++;
			$objData = array();
			foreach(func_get_args() as $objArg) {
				if (!($objArg instanceof QReportCell)){
					if(!is_array($objArg))
						throw new QCallerException("Object isn't a QReportCell");
					else {
						foreach($objArg as $objCell){
							if (!($objCell instanceof QReportCell))		
								throw new QCallerException("object isn't a QReportCell");
							array_push($objData,$objCell);
						}	
					}
							
				}
				else
					array_push($objData,$objArg);
			}
			array_push($this->objData,$objData);
		}

		public function PushHeaderRow() {

			$objData = array();
			foreach(func_get_args() as $objArg) {
				if (!($objArg instanceof QReportCell)){
					if(!is_array($objArg))
						throw new QCallerException("Object isn't a QReportCell");
					else {
						foreach($objArg as $objCell){
							if (!($objCell instanceof QReportCell))		
								throw new QCallerException("object isn't a QReportCell");
							array_push($objData,$objCell);
						}	
					}
							
				}
				else
					array_push($objData,$objArg);
			}
			array_push($this->objHeader,$objData);
		}

		public function AddRow($objRow) {
			$this->intCurrentRow++;
			/**
			 * TODO Check that $objRow contains QReportCell's
			 */
			array_push($this->objData,$objRow->objCells);
		}
		
		public function CellCount() {
			$intCount = 0;
			foreach($objData as $objCellRow) {
				$intCount += sizeof($objCellRow);
			}
			return $intCount;
		}

		public function ParsePostData() {}

		public function Clear() {
			$this->objData = array();
		}

		protected function GetControlHtml() {
			$this->DataBind();

			// Setup Style
			$strStyle = $this->GetStyleAttributes();
			if ($strStyle)
				$strStyle = sprintf('style="%s"', $strStyle);

			$intMaxCols = 0;
			$strReportBodyRows = array();
			
			//Render Headers
			foreach($this->objHeader as $objHeaderCellRow) {
				$strHeaderCellsRow = array();
				foreach($objHeaderCellRow as $objHeaderCell) {						
					array_push($strHeaderCellsRow,sprintf('<td %s>%s</td>',
						$objHeaderCell->GetAttributes(),
						$objHeaderCell->Render()
					));
				}
				array_push($strReportBodyRows,sprintf('<tr>%s</tr>',implode("\n",$strHeaderCellsRow)));
			}
						
			// Render Data Cells
			foreach($this->objData as $objCellRow) {
				$i = 0;
				$strRowCells = array();
				foreach($objCellRow as $objCell) {						
					array_push($strRowCells,sprintf('<td %s>%s</td>',
						$objCell->GetAttributes(),
						$objCell->Render()
					));
					$intMaxCols = (++$i > $intMaxCols?$i:$intMaxCols);
				}

				array_push($strReportBodyRows,sprintf('<tr>%s</tr>',
					implode("\n",$strRowCells)
				));
			}

			$strReportBody = sprintf('<tbody>%s</tbody>',
				implode("\n",$strReportBodyRows)
			);

			$strToReturn = sprintf('<table id="%s" %s%s>',$this->strControlId,$this->GetAttributes(),$strStyle);
			
			if ($this->objPaginator)
				$strToReturn .= "<caption>\r\n" . $this->GetPaginatorRowHtml($this->objPaginator) . "</caption>\r\n";
			
			$strToReturn.= sprintf('%s</table>',$strReportBody);

			$this->objData = array();
			
			return $strToReturn;
		}
		
			protected function GetPaginatorRowHtml($objPaginator) {
			$strToReturn = "  <span class=\"right\">";
			$strToReturn .= $objPaginator->Render(false);
			$strToReturn .= "</span>\r\n  <span class=\"left\">";
			if ($this->TotalItemCount > 0) {
				$intStart = (($this->PageNumber - 1) * $this->ItemsPerPage) + 1;
				$intEnd = $intStart + count($this->objData) - 1;
				$strToReturn .= sprintf($this->strLabelForPaginated,
					$this->strNounPlural,
					$intStart,
					$intEnd,
					$this->TotalItemCount);
			} else {
				$intCount = count($this->objData);
				if ($intCount == 0)
					$strToReturn .= sprintf($this->strLabelForNoneFound, $this->strNounPlural);
				else if ($intCount == 1)
					$strToReturn .= sprintf($this->strLabelForOneFound, $this->strNoun);
				else
					$strToReturn .= sprintf($this->strLabelForMultipleFound, $intCount, $this->strNounPlural);
			}

			$strToReturn .= "</span>\r\n";

			return $strToReturn;
		}		

		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				// APPEARANCE
				case "AlternateRowStyle": return $this->objAlternateRowStyle;
				case "BorderCollapse": return $this->strBorderCollapse;
				case "RowStyle": return $this->objRowStyle;

				// LAYOUT
				case "CellPadding": return $this->intCellPadding;
				case "CellSpacing": return $this->intCellSpacing;
				case "GridLines": return $this->strGridLines;
				case "ShowHeader": return $this->blnShowHeader;
				case "ShowFooter": return $this->blnShowFooter;

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
			switch ($strName) {
				// APPEARANCE
				case "AlternateRowStyle":
					try {
						$this->objAlternateRowStyle = QType::Cast($mixValue, "QDataGridRowStyle");
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "BorderCollapse":
					try {
						$this->strBorderCollapse = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "RowStyle":
					try {
						$this->objRowStyle = QType::Cast($mixValue, "QDataGridRowStyle");
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
					
				// LAYOUT
				case "CellPadding":
					try {
						$this->intCellPadding = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "CellSpacing":
					try {
						$this->intCellSpacing = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "GridLines":
					try {
						$this->strGridLines = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "ShowHeader":
					try {
						$this->blnShowHeader = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "ShowFooter":
					try {
						$this->blnShowFooter = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						parent::__set($strName, $mixValue);
						break;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}