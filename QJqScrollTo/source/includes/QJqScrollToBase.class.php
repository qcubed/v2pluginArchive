<?php

	/**
	 * Base class for QJqScrollTo plugin
	 * 
	 * @property integer $Duration A string or number determining how long the animation will run.
	 * Durations are given in milliseconds; higher values indicate slower animations, not faster ones.
	 * The default duration is 400 milliseconds. The strings 'fast' and 'slow' can be supplied
	 * to indicate durations of 200 and 600 milliseconds, respectively.
	 * @property string $Easing A string indicating which easing function to use for the transition.
	 * The string naming an easing function to use. An easing function specifies the speed at which
	 * the animation progresses at different points within the animation.
	 * The only easing implementations in the jQuery library are the default, called swing,
	 * and one that progresses at a constant pace, called linear.
	 * More easing functions are available with the use of plug-ins, most notably the jQuery UI suite.
	 * @property string $Callback Complete Function.
	 * If supplied, the complete callback function is fired once the animation is complete. 
	 * This can be useful for stringing different animations together in sequence. 
	 * The callback is not sent any arguments, but this is set to the DOM element being animated. 
	 * If multiple elements are animated, the callback is executed once per matched element, not once for the animation as a whole.
	 * @property string $DurationMode The mode to do the duration for 'each' control or for 'all' controls.
	 * @property integer $OffsetTop The additional offset for the top
	 * @property integer $OffsetLeft The additional offset for the left
	 */
	class QJQScrollToActionBase extends QJQScrollToActionGen {
		
		/**
		 * The Id of a control this action should scroll to.
		 * @var string 
		 */
		protected $strControlId = null;
		
		/**
		 * A string or number determining how long the animation will run.
		 * Durations are given in milliseconds; higher values indicate slower animations, not faster ones.
		 * The default duration is 400 milliseconds. The strings 'fast' and 'slow' can be supplied
		 * to indicate durations of 200 and 600 milliseconds, respectively.
		 * @var integer
		 */
		protected $intDuration;
		/**
		 * A string indicating which easing function to use for the transition.
		 * The string naming an easing function to use. An easing function specifies the speed at which
		 * the animation progresses at different points within the animation.
		 * The only easing implementations in the jQuery library are the default, called swing,
		 * and one that progresses at a constant pace, called linear.
		 * More easing functions are available with the use of plug-ins, most notably the jQuery UI suite.
		 * @var string 
		 */
		protected $strEasing;
		/**
		 * Complete Function.
		 * If supplied, the complete callback function is fired once the animation is complete. 
		 * This can be useful for stringing different animations together in sequence. 
		 * The callback is not sent any arguments, but this is set to the DOM element being animated. 
		 * If multiple elements are animated, the callback is executed once per matched element, not once for the animation as a whole.
		 * @var string 
		 */
		protected $strCallback;
		/**
		 * @var string The mode to do the duration for 'each' control or for 'all' controls.
		 */
		protected $strDurationMode;
		/**
		 * The additional offset for the top
		 * @var integer 
		 */
		protected $intOffsetTop;
		/**
		 * The additional offset for the left
		 * @var integer 
		 */
		protected $intOffsetLeft;
		
		/**
		 * Constructs the new QJQScrollToActionBase object
		 * 
		 * @param integer $intOffsetTop The additional offset for the top
		 * @param integer $intOffsetLeft The additional offset for the left
		 * @param QControlBase $objControl The control this action is added in.
		 * @param integer $intDuration A string or number determining how long the animation will run.
		 * Durations are given in milliseconds; higher values indicate slower animations, not faster ones.
		 * The default duration is 400 milliseconds. The strings 'fast' and 'slow' can be supplied
		 * to indicate durations of 200 and 600 milliseconds, respectively.
		 * @param string $strEasing A string indicating which easing function to use for the transition.
		 * The string naming an easing function to use. An easing function specifies the speed at which
		 * the animation progresses at different points within the animation.
		 * The only easing implementations in the jQuery library are the default, called swing,
		 * and one that progresses at a constant pace, called linear.
		 * More easing functions are available with the use of plug-ins, most notably the jQuery UI suite.
		 * @param string $strDurationMode The mode to do the duration for 'each' control or for 'all' controls.
		 * @param string $strCallback Complete Function.
		 * If supplied, the complete callback function is fired once the animation is complete. 
		 * This can be useful for stringing different animations together in sequence. 
		 * The callback is not sent any arguments, but this is set to the DOM element being animated. 
		 * If multiple elements are animated, the callback is executed once per matched element, not once for the animation as a whole.
		 */
		public function  __construct($objControl
			, $intOffsetTop = 0
			, $intOffsetLeft = 0
			, $intDuration = 400
			, $strEasing = "swing"
			, $strDurationMode = "each"
			, $strCallback = "undefined"
		) {
			$this->strControlId = $objControl->ControlId;
			$this->intDuration = $intDuration;
			$this->strEasing = $strEasing;
			$this->strDurationMode = $strDurationMode;
			$this->intOffsetTop = $intOffsetTop;
			$this->intOffsetLeft = $intOffsetLeft;
			$this->strCallback = $strCallback;
			
			$this->setJavaScripts($objControl);
		}

		private function setJavaScripts(QControlBase $objControl) {
			$objControl->AddJavascriptFile(__JQUERY_EFFECTS__);
			$objControl->AddJavascriptFile("../../plugins/QJqScrollTo/js/jquery-scrollto/jquery.scrollto.min.js");
		}

		public function RenderScript(QControl $objControl) {
			return sprintf('$j("#%s").ScrollTo({%s});', $this->strControlId, $this->makeJqOptions());
		}
		
		protected function makeJqOptions() {
			$strCallback = $this->strCallback;
			if ("undefined" != $strCallback) {
				$strCallback = "'" . $strCallback . "'";
			}
			$strJqOptions =
				sprintf("duration: %d, easing: '%s', callback: %s, durationMode: '%s', offsetTop: %d, offsetLeft: %d"
					, $this->intDuration, $this->strEasing, $strCallback
					, $this->strDurationMode, $this->intOffsetTop, $this->intOffsetLeft);
			return $strJqOptions;
		}
		
		/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				case 'Duration':
					/**
					 * Gets the value for intDuration
					 * @return integer
					 */
					return $this->intDuration;

				case 'Easing':
					/**
					 * Gets the value for strEasing
					 * @return string
					 */
					return $this->strEasing;

				case 'Callback':
					/**
					 * Gets the value for strCallback
					 * @return string
					 */
					return $this->strCallback;

				case 'DurationMode':
					/**
					 * Gets the value for strDurationMode
					 * @return string
					 */
					return $this->strDurationMode;

				case 'OffsetTop':
					/**
					 * Gets the value for intOffsetTop
					 * @return integer
					 */
					return $this->intOffsetTop;

				case 'OffsetLeft':
					/**
					 * Gets the value for intOffsetLeft
					 * @return integer
					 */
					return $this->intOffsetLeft;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'Duration':
					/**
					 * Sets the value for intDuration
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intDuration = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Easing':
					/**
					 * Sets the value for strEasing
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEasing = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Callback':
					/**
					 * Sets the value for strCallback
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strCallback = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DurationMode':
					/**
					 * Sets the value for strDurationMode
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strDurationMode = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OffsetTop':
					/**
					 * Sets the value for intOffsetTop
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intOffsetTop = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OffsetLeft':
					/**
					 * Sets the value for intOffsetLeft
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intOffsetLeft = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

	}
?>