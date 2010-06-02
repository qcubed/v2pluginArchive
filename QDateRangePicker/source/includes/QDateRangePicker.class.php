<?php
	/**
	 * This file contains the QDateRangePicker class.
	 *
	 * @package Controls
	 *
	 */

	require_once 'JavaScriptHelper.class.php';
	require_once 'QDateRangePickerPreset.class.php';
	require_once 'QDateRangePickerPresetRange.class.php';

	/*
	 * @package Controls
	 * 
	 * @property QControl $Input
	 * @property QControl $SecondInput
	 * @property array $PresetRangesArray
	 * @property array $PresetsArray
	 * @property string $RangeStartTitle
	 * @property string $RangeEndTitle
	 * @property string $DoneButtonText
	 * @property string $PrevLinkText
	 * @property string $NextLinkText
	 * @property mixed $EarliestDate
	 * @property mixed $LatestDate
	 * @property string $RangeSplitter
	 * @property string $DateFormat
	 * @property string $JqDateFormat
	 * @property boolean $CloseOnSelect
	 * @property boolean $Arrows
	 *
	 */
	class QDateRangePicker extends QPanel {
		protected $strJavaScripts = __JQUERY_EFFECTS__;
		protected $strStyleSheets = __JQUERY_CSS__;
		protected $blnTwoInputs = false;
		protected $txtInput;
		protected $txtSecondInput;
		protected $objPresetRangesArray = null;
		protected $objPresetsArray = null;
		protected $strRangeStartTitle;
		protected $strRangeEndTitle;
		protected $strDoneButtonText;
		protected $strPrevLinkText;
		protected $strNextLinkText;
		protected $mixEarliestDate;
		protected $mixLatestDate;
		protected $strRangeSplitter = '-';
		protected $strDateFormat;
		protected $strJqDateFormat;
		protected $blnCloseOnSelect = false;
		protected $blnArrows = false;

		private function makeJsProperty($strProp, $strKey = null, $strQuote = "'") {
			$objValue = $this->$strProp;
			if (null === $objValue) return '';
			if (null === $strKey) {
				//$strKey = lcfirst($strProp); // lcfirst is only available in php >= 5.3
				$strKey = strtolower(substr($strProp,0,1)).substr($strProp,1);
			}

			return $strKey . ': ' . JavaScriptHelper::toJson($objValue, $strQuote) . ', ';
		}

		private function setJavaScripts() {
			$this->AddJavascriptFile(__JQUERY_BASE__);
			$this->AddPluginJavascriptFile("QDateRangePicker", "daterangepicker.jQuery.js");
			$this->AddPluginCssFile("QDateRangePicker", "collisions.css");
			$this->AddPluginCssFile("QDateRangePicker", "ui.daterangepicker.css");
		}


		public function  __construct($objParentObject, $strControlId = null) {
			parent::__construct($objParentObject, $strControlId);
			$this->setJavaScripts();
		}

		public function toJson() {
			$strJson = '{';
			$strJson .= $this->makeJsProperty('PresetRanges');
			$strJson .= $this->makeJsProperty('Presets');
			$strJson .= $this->makeJsProperty('RangeStartTitle');
			$strJson .= $this->makeJsProperty('RangeEndTitle');
			$strJson .= $this->makeJsProperty('DoneButtonText');
			$strJson .= $this->makeJsProperty('PrevLinkText');
			$strJson .= $this->makeJsProperty('NextLinkText');
			$strJson .= $this->makeJsProperty('EarliestDate');
			$strJson .= $this->makeJsProperty('LatestDate');
			$strJson .= $this->makeJsProperty('RangeSplitter');
			$strJson .= $this->makeJsProperty('JqDateFormat', 'dateFormat');
			$strJson .= $this->makeJsProperty('CloseOnSelect');
			$strJson .= $this->makeJsProperty('Arrows');
			return substr($strJson, 0, -2).'}';
		}

		public function GetControlHtml() {
			$strToReturn = parent::GetControlHtml();

			$inputs = '#'.$this->Input->ControlId;
			if ($this->SecondInput) {
				$inputs .= ', #'.$this->SecondInput->ControlId;
			}
			$strJs = sprintf('jQuery("%s").daterangepicker(', $inputs);
			$strJs .= $this->toJson();
			$strJs .= ')';
			QApplication::ExecuteJavaScript($strJs);
			return $strToReturn;
		}

		public function AddPreset(QDateRangePickerPreset $preset, $strLabel = null) {
			if (!$strLabel) $strLabel = $preset->DefaultLabel;
			if (null === $this->objPresetsArray) $this->objPresetsArray = array();
			$this->objPresetsArray[$preset->Preset] = $strLabel;
		}

		public function RemovePreset(QDateRangePickerPreset $preset) {
			if ($this->objPresetsArray)
				unset($this->objPresetsArray[$preset->Preset]);
		}

		public function RemoveAllPresets() {
			$this->objPresetsArray = array();
		}

		public function ResetToDefaultPresets() {
			$this->objPresetsArray = null;
		}

		public function AddPresetRange(QDateRangePickerPresetRange $presetRange) {
			if (null === $this->objPresetRangesArray) $this->objPresetRangesArray = array();
			array_push($this->objPresetRangesArray, $presetRange);
		}

		public function RemovePresetRange(QDateRangePickerPresetRange $presetRange) {
			if ($this->objPresetRangesArray) {
				while (($key = array_search($presetRange, $this->objPresetRangesArray)) !== false) {
					unset($this->objPresetRangesArray[$key]);
				}
				// reindex
				$this->objPresetRangesArray = array_values($this->objPresetRangesArray);
			}
		}

		public function RemoveAllPresetRanges() {
			$this->objPresetRangesArray = array();
		}

		public function ResetToDefaultPresetRanges() {
			$this->objPresetRangesArray = null;
		}

		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				case "Input" : return $this->txtInput;
				case "SecondInput" : return $this->txtSecondInput;
				case "PresetRanges" : return $this->objPresetRangesArray;
				case "Presets" : return $this->objPresetsArray;
				case "RangeStartTitle" : return $this->strRangeStartTitle;
				case "RangeEndTitle" : return $this->strRangeEndTitle;
				case "DoneButtonText" : return $this->strDoneButtonText;
				case "PrevLinkText" : return $this->strPrevLinkText;
				case "NextLinkText" : return $this->strNextLinkText;
				case "EarliestDate" : return $this->mixEarliestDate;
				case "LatestDate" : return $this->mixLatestDate;
				case "RangeSplitter" : return $this->strRangeSplitter;
				case "DateFormat" : return $this->strDateFormat;
				case "JqDateFormat" : return $this->strJqDateFormat;
				case "CloseOnSelect" : return $this->blnCloseOnSelect;
				case "Arrows" : return $this->blnArrows;
				default :
					try {
						return parent::__get($strName);
					}
					catch (QCallerException $objExc) {
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
				case "Input" : {
					try {
						$this->txtInput = QType::Cast($mixValue, 'QControl');
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "SecondInput" : {
					try {
						$this->txtSecondInput = QType::Cast($mixValue, 'QControl');
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "PresetRanges" : {
					try {
						$this->objPresetRangesArray = QType::Cast($mixValue, QType::ArrayType);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "Presets" : {
					try {
						$this->objPresetArray = QType::Cast($mixValue, QType::ArrayType);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "RangeStartTitle" : {
					try {
						$this->strRangeStartTitle = QType::Cast($mixValue, QType::String);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "RangeEndTitle" : {
					try {
						$this->strRangeEndTitle = QType::Cast($mixValue, QType::String);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "DoneButtonText" : {
					try {
						$this->strDoneButtonText = QType::Cast($mixValue, QType::String);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "PrevLinkText" : {
					try {
						$this->strPrevLinkText = QType::Cast($mixValue, QType::String);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "NextLinkText" : {
					try {
						$this->strNextLinkText = QType::Cast($mixValue, QType::String);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "EarliestDate" : {
					$this->mixEarliestDate = $mixValue;
					break;
				}

				case "LatestDate" : {
					$this->mixLatestDate = $mixValue;
					break;
				}

				case "RangeSplitter" : {
					try {
						$this->strRangeSplitter = QType::Cast($mixValue, QType::String);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "JqDateFormat": {
					try {
						$this->strJqDateFormat = QType::Cast($mixValue, QType::String);
						$this->strDateFormat = QCalendar::qcFrmt($this->strJqDateFormat);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "DateFormat": {
					try {
						$this->strDateFormat = QType::Cast($mixValue, QType::String);
						$this->strJqDateFormat = QCalendar::jqFrmt($this->strDateFormat);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "CloseOnSelect" : {
					try {
						$this->blnCloseOnSelect = QType::Cast($mixValue, QType::Boolean);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				case "Arrows" : {
					try {
						$this->blnArrows = QType::Cast($mixValue, QType::Boolean);
						break;
					}
					catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				}

				default :
					try {
						parent::__set($strName, $mixValue);
					}
					catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
					break;
			}
		}

	}


?>
