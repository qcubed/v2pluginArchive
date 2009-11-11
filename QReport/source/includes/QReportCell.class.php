<?php

	class QReportCell extends QBaseClass {

		public $intColumn;
		public $intRow;
		public $intColSpan;
		public $intRowSpan;
		public $strCellTag;

		protected $mixCellContent;
		protected $objCellStyle;

		public function __construct($mixCellContent, $objCellStyle = null, $strCellTag = 'td', $intColSpan = 1, $intRowSpan = 1) {
			$this->mixCellContent = $mixCellContent;
			$this->objCellStyle = $objCellStyle;
			$this->strCellTag = $strCellTag;
			$this->intColSpan = $intColSpan;
			$this->intRowSpan = $intRowSpan;
		}

		public function Render() {
			if(!is_null($this->objCellStyle))
				return $this->objCellStyle->DataFormatter($this->mixCellContent);
			else
				return $this->mixCellContent;
		}

		public function GetAttributes() {
			$strToReturn = "";
			if(!is_null($this->objCellStyle)) {
				$strToReturn .= $this->objCellStyle->GetAttributes();
			}

			if($this->intColSpan > 1) {
				$strToReturn .= sprintf('colspan="%d" ',$this->intColSpan);
			}

			if($this->intRowSpan > 1) {
				$strToReturn .= sprintf('rowspan="%d" ',$this->intRowSpan);
			}

			return $strToReturn;
		}

		public function __get($strName) {
			switch ($strName) {
				case "CellTag": return $this->strCellTag;
				case "ColSpan": return $this->intColSpan;
				case "RowSpan": return $this->intRowSpan;
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
			switch ($strName) {
				// APPEARANCE
				case "CellTag": 
					try {
						$this->strCellTag = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "ColSpan": 
					try {
						$this->intColSpan = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "RowSpan": 
					try {
						$this->intRowSpan = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "Content":
					try {
						$this->mixCellContent = $mixValue;
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
