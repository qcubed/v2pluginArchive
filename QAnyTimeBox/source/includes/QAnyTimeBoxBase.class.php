<?php
	/* Custom event classes for this control */

	/**
	 * @property array $AjaxOptions Options to pass to jQuery's $.ajax()  method whenever the user dismisses a
	 * 		popup picker or selects a value in an inline picker.
	 * @property boolean $AskEra If true, buttons to select the era (BCE/CE) are shown on the year selector
	 * 		popup, even if the format  specifier does not include the era. If false,
	 * 		buttons to select the era are NOT shown, even if the format specifier
	 * 		includes the era. Normally, era buttons are only shown if the format string
	 * 		specifies the era.
	 * @property boolean $AskSecond If false, buttons for number-of-seconds are not shown on the year selector
	 * 		popup, even if the format  specifier includes seconds. Normally, the
	 * 		buttons are shown if the format string specifies seconds.
	 * @property integer $BaseYear the number to add to two-digit years if the "%y" format  specifier is used.
	 * 		By default, the MySQL convention  that two-digit years are in the range
	 * 		1970 to 2069 is used. The most common alternatives are 1900 and 2000. When
	 * 		using this option, you should also specify the earliest and latest options
	 * 		to the first and last dates in the century, respectively. Refer to the
	 * 		ajaxOptions example.
	 * @property array $DayAbbreviations An array of day abbreviations to replace Sun, Mon, etc. Note:  if a
	 * 		different first day-of-week is specified by option firstDOW, this array
	 * 		should nonetheless start with the desired abbreviation for Sunday.
	 * @property array $DayNames An array of day names to replace Sunday, Monday, etc. Note:  if a different
	 * 		first day-of-week is specified by option firstDOW, this array should
	 * 		nonetheless start with the desired name for Sunday.
	 * @property QDateTime $Earliest String or Date object representing the earliest date/time that a user can
	 * 		select. If a String is specified, it is expected to match the format 
	 * 		specifier. For best results if the field is only used to specify a date, be
	 * 		sure to set the time to 00:00:00. Refer to the ajaxOptions  and extending
	 * 		examples.
	 * @property array $EraAbbreviations An array of era abbreviations to replace BCE and CE. The most common
	 * 		replacements are the obsolete: BC and AD.
	 * @property integer $FirstDOW a value from 0 (Sunday) to 6 (Saturday) stating which day should appear at
	 * 		the beginning of the week. The default is 0  (Sunday). The most common
	 * 		substitution is 1 (Monday). Note:  if custom arrays are specified for
	 * 		dayAbbreviations and dayNames, they should nonetheless begin with the
	 * 		desired value for Sunday. Refer to the earlier popup examples.
	 * @property string $AtDateTimeFormat string specifying the date/time format
	 * @property string $FormatUtcOffset string specifying the format of the UTC offset choices displayed in the
	 * 		picker. Although all specifiers used by the format option are recognized,
	 * 		only those pertaining to UTC offsets (namely %#, %+, %-, %:, %;  and %@)
	 * 		should be used. By default, the picker will extrapolate a format by
	 * 		scanning the format  option for appropriate specifiers and their
	 * 		surrounding characters. Refer to the date/time picker  near the beginning
	 * 		of this page for an example.
	 * @property boolean $HideInput if true, the <input> is "hidden" (the picker appears in its place). This
	 * 		actually sets the border, height, margin, padding and width of the field as
	 * 		small as possible, so it can still get focus. Refer to the date/time picker
	 * 		 near the beginning of this page for an example. Note:  if you try to hide
	 * 		the field using traditional techniques (such as setting display:none), the
	 * 		picker will not behave correctly. This option should only be used with
	 * 		placement:"inline"; otherwise, a popup will only appear (seemingly from
	 * 		nowhere) if the user tabs to the hidden field.
	 * @property string $LabelDayOfMonth HTML to replace the Day of Month label
	 * @property string $LabelDismiss HTML to replace the dismiss popup button's X label
	 * @property string $LabelHour HTML to replace the Hour label. Refer to the earlier popup examples.
	 * @property string $LabelMinute HTML to replace the Minute label. Refer to the earlier popup examples.
	 * @property string $LabelMonth HTML to replace the Month label
	 * @property string $LabelSecond HTML to replace the Second label
	 * @property string $LabelTimeZone HTML to replace the Time Zone label
	 * @property string $LabelTitle HTML for the title of the picker. If not specified, the picker
	 * 		automatically selects a title based on the format  specifier fields. Refer
	 * 		to the earlier popup examples.
	 * @property string $LabelYear HTML to replace the Year label
	 * @property QDateTime $Latest String or Date object representing the latest date/time that a user can
	 * 		select. If a String is specified, it is expected to match the format 
	 * 		specifier. For best results if the field is only used to specify a date, be
	 * 		sure to set the time to 23:59:59. Refer to the ajaxOptions  and extending
	 * 		examples.
	 * @property array $MonthAbbreviations An array of month abbreviations to replace Jan, Feb, etc. Note:  do not use
	 * 		an HTML entity reference (such as &auml;) in a month name or abbreviation;
	 * 		embed the actual character (such as �) instead. Be careful to save your
	 * 		source files under the correct encoding, or the character may not display
	 * 		correctly in all browsers; this often happens when a character code from
	 * 		UTF-8  is saved with ISO-8859-1 encoding (or vice-versa).
	 * @property array $MonthNames An array of month names to replace January, February, etc.
	 * @property string $Placement One of the following strings: 
	 * "popup": the picker appears above its input
	 * 		when the input receives focus, and disappears when it is dismissed. This is
	 * 		the default behavior.
	 * "inline": the picker follows the <input> and remains
	 * 		visible at all times. When choosing this placement, you might prefer to
	 * 		hide the input field using the hideInput option (the correct value will
	 * 		still be submitted with the form). Refer to the date/time picker near the
	 * 		beginning of this page for an example.
	 */

	class QAnyTimeBoxBase extends QTextBox	{
		protected $strJavaScripts = __JQUERY_EFFECTS__;
		protected $strStyleSheets = __JQUERY_CSS__;
		/** @var array */
		protected $arrAjaxOptions;
		/** @var boolean */
		protected $blnAskEra = null;
		/** @var boolean */
		protected $blnAskSecond = null;
		/** @var integer */
		protected $intBaseYear = null;
		/** @var array */
		protected $arrDayAbbreviations;
		/** @var array */
		protected $arrDayNames;
		/** @var QDateTime */
		protected $dttEarliest;
		/** @var array */
		protected $arrEraAbbreviations;
		/** @var integer */
		protected $intFirstDOW;
		/** @var string */
		protected $strAtDateTimeFormat;
		/** @var string */
		protected $strFormatUtcOffset;
		/** @var boolean */
		protected $blnHideInput = null;
		/** @var string */
		protected $strLabelDayOfMonth;
		/** @var string */
		protected $strLabelDismiss;
		/** @var string */
		protected $strLabelHour;
		/** @var string */
		protected $strLabelMinute;
		/** @var string */
		protected $strLabelMonth;
		/** @var string */
		protected $strLabelSecond;
		/** @var string */
		protected $strLabelTimeZone;
		/** @var string */
		protected $strLabelTitle;
		/** @var string */
		protected $strLabelYear;
		/** @var QDateTime */
		protected $dttLatest;
		/** @var array */
		protected $arrMonthAbbreviations;
		/** @var array */
		protected $arrMonthNames;
		/** @var string */
		protected $strPlacement;

		/** @var array $custom_events Event Class Name => Event Property Name */
		protected static $custom_events = array(
		);
		
		protected function makeJsProperty($strProp, $strKey) {
			$objValue = $this->$strProp;
			if (null === $objValue) {
				return '';
			}

			return $strKey . ': ' . JavaScriptHelper::toJsObject($objValue) . ', ';
		}

		protected function makeJqOptions() {
			$strJqOptions = '{';
			$strJqOptions .= $this->makeJsProperty('AjaxOptions', 'ajaxOptions');
			$strJqOptions .= $this->makeJsProperty('AskEra', 'askEra');
			$strJqOptions .= $this->makeJsProperty('AskSecond', 'askSecond');
			$strJqOptions .= $this->makeJsProperty('BaseYear', 'baseYear');
			$strJqOptions .= $this->makeJsProperty('DayAbbreviations', 'dayAbbreviations');
			$strJqOptions .= $this->makeJsProperty('DayNames', 'dayNames');
			$strJqOptions .= $this->makeJsProperty('Earliest', 'earliest');
			$strJqOptions .= $this->makeJsProperty('EraAbbreviations', 'eraAbbreviations');
			$strJqOptions .= $this->makeJsProperty('FirstDOW', 'firstDOW');
			$strJqOptions .= $this->makeJsProperty('AtDateTimeFormat', 'format');
			$strJqOptions .= $this->makeJsProperty('FormatUtcOffset', 'formatUtcOffset');
			$strJqOptions .= $this->makeJsProperty('HideInput', 'hideInput');
			$strJqOptions .= $this->makeJsProperty('LabelDayOfMonth', 'labelDayOfMonth');
			$strJqOptions .= $this->makeJsProperty('LabelDismiss', 'labelDismiss');
			$strJqOptions .= $this->makeJsProperty('LabelHour', 'labelHour');
			$strJqOptions .= $this->makeJsProperty('LabelMinute', 'labelMinute');
			$strJqOptions .= $this->makeJsProperty('LabelMonth', 'labelMonth');
			$strJqOptions .= $this->makeJsProperty('LabelSecond', 'labelSecond');
			$strJqOptions .= $this->makeJsProperty('LabelTimeZone', 'labelTimeZone');
			$strJqOptions .= $this->makeJsProperty('LabelTitle', 'labelTitle');
			$strJqOptions .= $this->makeJsProperty('LabelYear', 'labelYear');
			$strJqOptions .= $this->makeJsProperty('Latest', 'latest');
			$strJqOptions .= $this->makeJsProperty('MonthAbbreviations', 'monthAbbreviations');
			$strJqOptions .= $this->makeJsProperty('MonthNames', 'monthNames');
			$strJqOptions .= $this->makeJsProperty('Placement', 'placement');
			return $strJqOptions.'}';
		}

		protected function getJqControlId() {
			return $this->ControlId;
		}

		protected function getJqSetupFunction() {
			return 'AnyTime_picker';
		}

		public function GetControlHtml() {
			$strToReturn = parent::GetControlHtml();

			$strJs = sprintf('jQuery("#%s").%s(%s)', $this->getJqControlId(), $this->getJqSetupFunction(), $this->makeJqOptions());
			QApplication::ExecuteJavaScript($strJs);
			return $strToReturn;
		}

		/**
		 * returns the property name corresponding to the given custom event
		 * @param QEvent $objEvent the custom event
		 * @return the property name corresponding to $objEvent
		 */
		protected function getCustomEventPropertyName(QEvent $objEvent) {
			$strEventClass = get_class($objEvent);
			if (array_key_exists($strEventClass, QAnyTimeBox::$custom_events))
				return QAnyTimeBox::$custom_events[$strEventClass];
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

		public function __get($strName) {
			switch ($strName) {
				case 'AjaxOptions': return $this->arrAjaxOptions;
				case 'AskEra': return $this->blnAskEra;
				case 'AskSecond': return $this->blnAskSecond;
				case 'BaseYear': return $this->intBaseYear;
				case 'DayAbbreviations': return $this->arrDayAbbreviations;
				case 'DayNames': return $this->arrDayNames;
				case 'Earliest': return $this->dttEarliest;
				case 'EraAbbreviations': return $this->arrEraAbbreviations;
				case 'FirstDOW': return $this->intFirstDOW;
				case 'AtDateTimeFormat': return $this->strAtDateTimeFormat;
				case 'FormatUtcOffset': return $this->strFormatUtcOffset;
				case 'HideInput': return $this->blnHideInput;
				case 'LabelDayOfMonth': return $this->strLabelDayOfMonth;
				case 'LabelDismiss': return $this->strLabelDismiss;
				case 'LabelHour': return $this->strLabelHour;
				case 'LabelMinute': return $this->strLabelMinute;
				case 'LabelMonth': return $this->strLabelMonth;
				case 'LabelSecond': return $this->strLabelSecond;
				case 'LabelTimeZone': return $this->strLabelTimeZone;
				case 'LabelTitle': return $this->strLabelTitle;
				case 'LabelYear': return $this->strLabelYear;
				case 'Latest': return $this->dttLatest;
				case 'MonthAbbreviations': return $this->arrMonthAbbreviations;
				case 'MonthNames': return $this->arrMonthNames;
				case 'Placement': return $this->strPlacement;
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
				case 'AjaxOptions':
					try {
						$this->arrAjaxOptions = QType::Cast($mixValue, QType::ArrayType);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AskEra':
					try {
						$this->blnAskEra = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AskSecond':
					try {
						$this->blnAskSecond = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'BaseYear':
					try {
						$this->intBaseYear = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DayAbbreviations':
					try {
						$this->arrDayAbbreviations = QType::Cast($mixValue, QType::ArrayType);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DayNames':
					try {
						$this->arrDayNames = QType::Cast($mixValue, QType::ArrayType);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Earliest':
					try {
						$this->dttEarliest = QType::Cast($mixValue, QType::DateTime);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EraAbbreviations':
					try {
						$this->arrEraAbbreviations = QType::Cast($mixValue, QType::ArrayType);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FirstDOW':
					try {
						$this->intFirstDOW = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AtDateTimeFormat':
					try {
						$this->strAtDateTimeFormat = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FormatUtcOffset':
					try {
						$this->strFormatUtcOffset = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HideInput':
					try {
						$this->blnHideInput = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelDayOfMonth':
					try {
						$this->strLabelDayOfMonth = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelDismiss':
					try {
						$this->strLabelDismiss = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelHour':
					try {
						$this->strLabelHour = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelMinute':
					try {
						$this->strLabelMinute = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelMonth':
					try {
						$this->strLabelMonth = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelSecond':
					try {
						$this->strLabelSecond = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelTimeZone':
					try {
						$this->strLabelTimeZone = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelTitle':
					try {
						$this->strLabelTitle = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LabelYear':
					try {
						$this->strLabelYear = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Latest':
					try {
						$this->dttLatest = QType::Cast($mixValue, QType::DateTime);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MonthAbbreviations':
					try {
						$this->arrMonthAbbreviations = QType::Cast($mixValue, QType::ArrayType);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MonthNames':
					try {
						$this->arrMonthNames = QType::Cast($mixValue, QType::ArrayType);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Placement':
					try {
						$this->strPlacement = QType::Cast($mixValue, QType::String);
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
