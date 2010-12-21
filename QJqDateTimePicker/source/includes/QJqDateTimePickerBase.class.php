<?php
	/* Custom event classes for this control */

	/**
	 * @property boolean $AlwaysSetTime 
	 * @property boolean $Ampm 
	 * @property integer $Hour 
	 * @property integer $HourMin 
	 * @property integer $HourMax 
	 * @property integer $Minute 
	 * @property integer $MinuteMin 
	 * @property integer $MinuteMax 
	 * @property integer $Second 
	 * @property integer $SecondMin 
	 * @property integer $SecondMax 
	 * @property boolean $ShowButtonPanel 
	 * @property boolean $ShowHour 
	 * @property boolean $ShowMinute 
	 * @property boolean $ShowSecond 
	 * @property boolean $ShowTime 
	 * @property integer $StepHour 
	 * @property integer $StepMinute 
	 * @property integer $StepSecond 
	 * @property string $JqTimeFormat 
	 * @property boolean $TimeOnly 
	 */

	class QJqDateTimePickerBase extends QDatepickerBox	{
		protected $strJavaScripts = __JQUERY_EFFECTS__;
		protected $strStyleSheets = __JQUERY_CSS__;
		/** @var boolean */
		protected $blnAlwaysSetTime = null;
		/** @var boolean */
		protected $blnAmpm = null;
		/** @var integer */
		protected $intHour;
		/** @var integer */
		protected $intHourMin;
		/** @var integer */
		protected $intHourMax = null;
		/** @var integer */
		protected $intMinute;
		/** @var integer */
		protected $intMinuteMin;
		/** @var integer */
		protected $intMinuteMax = null;
		/** @var integer */
		protected $intSecond;
		/** @var integer */
		protected $intSecondMin;
		/** @var integer */
		protected $intSecondMax = null;
		/** @var boolean */
		protected $blnShowButtonPanel = null;
		/** @var boolean */
		protected $blnShowHour = null;
		/** @var boolean */
		protected $blnShowMinute = null;
		/** @var boolean */
		protected $blnShowSecond = null;
		/** @var boolean */
		protected $blnShowTime = null;
		/** @var integer */
		protected $intStepHour = null;
		/** @var integer */
		protected $intStepMinute = null;
		/** @var integer */
		protected $intStepSecond = null;
		/** @var string */
		protected $strJqTimeFormat;
		/** @var boolean */
		protected $blnTimeOnly = null;

		/** @var array $custom_events Event Class Name => Event Property Name */
		protected static $custom_events = array(
		);
		
		public function  __construct($objParentObject, $strControlId = null) {
			parent::__construct($objParentObject, $strControlId);
			$this->AddPluginJavascriptFile("QJqDateTimePicker", "jquery-ui-timepicker-addon-0.6.2.min.js");
			$this->AddPluginCssFile("QJqDateTimePicker", "jquery-ui-timepicker-addon-0.6.2.css");
		}

		protected function makeJsProperty($strProp, $strKey) {
			$objValue = $this->$strProp;
			if (null === $objValue) {
				return '';
			}

			return $strKey . ': ' . JavaScriptHelper::toJsObject($objValue) . ', ';
		}

		protected function makeJqOptions() {
			$strJqOptions = parent::makeJqOptions();
			if ($strJqOptions) $strJqOptions .= ', ';
			$strJqOptions .= $this->makeJsProperty('AlwaysSetTime', 'alwaysSetTime');
			$strJqOptions .= $this->makeJsProperty('Ampm', 'ampm');
			$strJqOptions .= $this->makeJsProperty('Hour', 'hour');
			$strJqOptions .= $this->makeJsProperty('HourMin', 'hourMin');
			$strJqOptions .= $this->makeJsProperty('HourMax', 'hourMax');
			$strJqOptions .= $this->makeJsProperty('Minute', 'minute');
			$strJqOptions .= $this->makeJsProperty('MinuteMin', 'minuteMin');
			$strJqOptions .= $this->makeJsProperty('MinuteMax', 'minuteMax');
			$strJqOptions .= $this->makeJsProperty('Second', 'second');
			$strJqOptions .= $this->makeJsProperty('SecondMin', 'secondMin');
			$strJqOptions .= $this->makeJsProperty('SecondMax', 'secondMax');
			$strJqOptions .= $this->makeJsProperty('ShowButtonPanel', 'showButtonPanel');
			$strJqOptions .= $this->makeJsProperty('ShowHour', 'showHour');
			$strJqOptions .= $this->makeJsProperty('ShowMinute', 'showMinute');
			$strJqOptions .= $this->makeJsProperty('ShowSecond', 'showSecond');
			$strJqOptions .= $this->makeJsProperty('ShowTime', 'showTime');
			$strJqOptions .= $this->makeJsProperty('StepHour', 'stepHour');
			$strJqOptions .= $this->makeJsProperty('StepMinute', 'stepMinute');
			$strJqOptions .= $this->makeJsProperty('StepSecond', 'stepSecond');
			$strJqOptions .= $this->makeJsProperty('JqTimeFormat', 'timeFormat');
			$strJqOptions .= $this->makeJsProperty('TimeOnly', 'timeOnly');
			if ($strJqOptions) $strJqOptions = substr($strJqOptions, 0, -2);
			return $strJqOptions;
		}

		protected function getJqControlId() {
			return $this->ControlId;
		}

		protected function getJqSetupFunction() {
			return 'datetimepicker';
		}

		public function GetControlJavaScript() {
			return sprintf('jQuery("#%s").%s({%s})', $this->getJqControlId(), $this->getJqSetupFunction(), $this->makeJqOptions());
		}

		public function GetEndScript() {
			return  $this->GetControlJavaScript() . '; ' . parent::GetEndScript();
		}

		/**
		 * returns the property name corresponding to the given custom event
		 * @param QEvent $objEvent the custom event
		 * @return the property name corresponding to $objEvent
		 */
		protected function getCustomEventPropertyName(QEvent $objEvent) {
			$strEventClass = get_class($objEvent);
			if (array_key_exists($strEventClass, QJqDateTimePicker::$custom_events))
				return QJqDateTimePicker::$custom_events[$strEventClass];
			return parent::getCustomEventPropertyName($objEvent);
		}

		public function __get($strName) {
			switch ($strName) {
				case 'AlwaysSetTime': return $this->blnAlwaysSetTime;
				case 'Ampm': return $this->blnAmpm;
				case 'Hour': return $this->intHour;
				case 'HourMin': return $this->intHourMin;
				case 'HourMax': return $this->intHourMax;
				case 'Minute': return $this->intMinute;
				case 'MinuteMin': return $this->intMinuteMin;
				case 'MinuteMax': return $this->intMinuteMax;
				case 'Second': return $this->intSecond;
				case 'SecondMin': return $this->intSecondMin;
				case 'SecondMax': return $this->intSecondMax;
				case 'ShowButtonPanel': return $this->blnShowButtonPanel;
				case 'ShowHour': return $this->blnShowHour;
				case 'ShowMinute': return $this->blnShowMinute;
				case 'ShowSecond': return $this->blnShowSecond;
				case 'ShowTime': return $this->blnShowTime;
				case 'StepHour': return $this->intStepHour;
				case 'StepMinute': return $this->intStepMinute;
				case 'StepSecond': return $this->intStepSecond;
				case 'JqTimeFormat': return $this->strJqTimeFormat;
				case 'TimeOnly': return $this->blnTimeOnly;
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
			$this->blnModified = true;

			switch ($strName) {
				case 'AlwaysSetTime':
					try {
						$this->blnAlwaysSetTime = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Ampm':
					try {
						$this->blnAmpm = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Hour':
					try {
						$this->intHour = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HourMin':
					try {
						$this->intHourMin = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HourMax':
					try {
						$this->intHourMax = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Minute':
					try {
						$this->intMinute = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MinuteMin':
					try {
						$this->intMinuteMin = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MinuteMax':
					try {
						$this->intMinuteMax = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Second':
					try {
						$this->intSecond = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SecondMin':
					try {
						$this->intSecondMin = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SecondMax':
					try {
						$this->intSecondMax = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShowButtonPanel':
					try {
						$this->blnShowButtonPanel = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShowHour':
					try {
						$this->blnShowHour = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShowMinute':
					try {
						$this->blnShowMinute = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShowSecond':
					try {
						$this->blnShowSecond = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShowTime':
					try {
						$this->blnShowTime = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'StepHour':
					try {
						$this->intStepHour = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'StepMinute':
					try {
						$this->intStepMinute = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'StepSecond':
					try {
						$this->intStepSecond = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'JqTimeFormat':
					try {
						$this->strJqTimeFormat = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'TimeOnly':
					try {
						$this->blnTimeOnly = QType::Cast($mixValue, QType::Boolean);
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

?>
