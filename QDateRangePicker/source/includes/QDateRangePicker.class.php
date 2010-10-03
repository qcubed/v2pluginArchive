<?php
	/**
	 * This file contains the QDateRangePicker class.
	 *
	 * @package Controls
	 *
	 */

	require_once 'QDateRangePickerPreset.class.php';
	require_once 'QDateRangePickerPresetRange.class.php';

	class QCloseEvent extends QEvent {
		const EventName = 'close';
	}

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
	 * @property QJsClosure $OnClose
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
		protected $mixOnClose = null;

		protected static $custom_events = array(
			'QCloseEvent' => 'OnClose',
		);

		protected function makeJsProperty($strProp, $strKey) {
			$objValue = $this->$strProp;
			if (null === $objValue) {
				return '';
			}

			return $strKey . ': ' . JavaScriptHelper::toJsObject($objValue) . ', ';
		}

		private function setJavaScripts() {
			$this->AddPluginJavascriptFile("QDateRangePicker", "daterangepicker.jQuery.js");
			$this->AddPluginCssFile("QDateRangePicker", "collisions.css");
			$this->AddPluginCssFile("QDateRangePicker", "ui.daterangepicker.css");
		}


		public function  __construct($objParentObject, $strControlId = null) {
			parent::__construct($objParentObject, $strControlId);
			$this->setJavaScripts();
		}

		protected function makeJqOptions() {
			$strJson = '';
			$strJson .= $this->makeJsProperty('PresetRanges', 'presetRanges');
			$strJson .= $this->makeJsProperty('Presets', 'presets');
			$strJson .= $this->makeJsProperty('RangeStartTitle', 'rangeStartTitle');
			$strJson .= $this->makeJsProperty('RangeEndTitle', 'rangeEndTitle');
			$strJson .= $this->makeJsProperty('DoneButtonText', 'doneButtonText');
			$strJson .= $this->makeJsProperty('PrevLinkText', 'prevLinkText');
			$strJson .= $this->makeJsProperty('NextLinkText', 'nextLinkText');
			$strJson .= $this->makeJsProperty('EarliestDate', 'earliestDate');
			$strJson .= $this->makeJsProperty('LatestDate', 'latestDate');
			$strJson .= $this->makeJsProperty('RangeSplitter', 'rangeSplitter');
			$strJson .= $this->makeJsProperty('JqDateFormat', 'dateFormat');
			$strJson .= $this->makeJsProperty('CloseOnSelect', 'closeOnSelect');
			$strJson .= $this->makeJsProperty('Arrows', 'arrows');
			$strJson .= $this->makeJsProperty('OnClose', 'onClose');
			return $strJson;
		}

		protected function getJqControlId() {
			if ($this->SecondInput) {
				return $this->Input->ControlId.', #'.$this->SecondInput->ControlId;
			}
			return $this->Input->ControlId;
		}

		protected function getJqSetupFunction() {
			return 'daterangepicker';
		}

		public function GetControlJavaScript() {
			return sprintf('jQuery("#%s").%s({%s})', $this->getJqControlId(), $this->getJqSetupFunction(), $this->makeJqOptions());
		}

		public function GetEndScript() {
			return  $this->GetControlJavaScript() . '; ' . parent::GetEndScript();
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

		/**
		 * returns the property name corresponding to the given custom event
		 * @param QEvent $objEvent the custom event
		 * @return the property name corresponding to $objEvent
		 */
		protected function getCustomEventPropertyName(QEvent $objEvent) {
			$strEventClass = get_class($objEvent);
			if (array_key_exists($strEventClass, QDateRangePicker::$custom_events))
				return QDateRangePicker::$custom_events[$strEventClass];
			return null;
		}


		/**
		 * Wraps $objAction into an object (typically a QJsClosure) that can be assigned to the corresponding Event
		 * property (e.g. OnFocus)
		 * @param QEvent $objEvent
		 * @param QAction $objAction
		 * @return mixed the wrapped object
		 */
		protected function createEventWrapper(QEvent $objEvent, QAction $objAction) {
			$objAction->Event = $objEvent;
			return new QJsClosure($objAction->RenderScript($this));
		}


		/**
		 * If $objEvent is one of the custom events (as determined by getCustomEventPropertyName() method)
		 * the corresponding JQuery event is used and if needed a no-script action is added. Otherwise the normal
		 * QCubed AddAction is performed.
		 * @param QEvent  $objEvent
		 * @param QAction $objAction
		 */
		public function AddAction($objEvent, $objAction) {
			$strEventName = $this->getCustomEventPropertyName($objEvent);
			if ($strEventName) {
				$this->$strEventName = $this->createEventWrapper($objEvent, $objAction);
				if ($objAction instanceof QAjaxAction) {
					$objAction = new QNoScriptAjaxAction($objAction);
					parent::AddAction($objEvent, $objAction);
				} else if (!($objAction instanceof QJavaScriptAction)) {
					throw new Exception('handling of "' . get_class($objAction) . '" actions with "' . get_class($objEvent) . '" events not yet implemented');
				}
			} else {
				parent::AddAction($objEvent, $objAction);
			}
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
				case "OnClose" : return $this->mixOnClose;
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

				case 'OnClose':
					try {
						if ($mixValue instanceof QJavaScriptAction) {
							/** @var QJavaScriptAction $mixValue */
							$mixValue = new QJsClosure($mixValue->RenderScript($this));
						}
						$this->mixOnClose = QType::Cast($mixValue, 'QJsClosure');
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
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
