<?php
	/**
	 * @property string $DateTimeFormat
 	 */
	class QAnyTimeBox extends QAnyTimeBoxBase
	{
		protected $strDateTimeFormat = "YYYY-MM-DD hhhh:mm:ss"; // %Y-%m-%d %T

		// map the AnyTime format specs to QCodo QDateTime format specs.
		//qcodo	anytime			php	Description
		//-------------------------------------------------
		//MMMM	%M			F	Month as full name (e.g., March)
		//MMM	%b			M	Month as three-letters (e.g., Mar)
		//MM	%m			m	Month as an integer with leading zero (e.g., 03)
		//M	%c			n	Month as an integer (e.g., 3)
		//DDDD	%W			l	Day of week as full name (e.g., Wednesday)
		//DDD	%a			D	Day of week as three-letters (e.g., Wed)
		//DD	%d			d	Day as an integer with leading zero (e.g., 02)
		//D	%e			j	Day as an integer (e.g., 2)
		//YYYY	%Y			Y	Year as a four-digit integer (e.g., 1977)
		//YY	%y			y	Year as a two-digit integer (e.g., 77)
		//hhhh	%H			H	24-hour format of an hour with leading zeros (00 through 23)
		//hhh	%k			G	24-hour format of an hour without leading zeros (0 through 23)
		//hh	%I			h	12-hour format of an hour with leading zeros (01 through 12)
		//h		%l 			g	12-hour format of an hour without leading zeros (1 through 12)
		//mm	%i			i	Minutes with leading zeros (00 to 59)
		//ss	%S			s	Seconds, with leading zeros (00 through 59)
		//zz	%p			A	Uppercase Ante meridiem and Post meridiem (AM or PM)
		//ttt	%@			T	Timezone abbreviation (EST, MDT ...)
		static private $mapQC2AT = array(
			'MMMM' => '%M',
			'MMM' => '%b',
			'MM' => '%m',
			'M' => '%c',
			'DDDD' => '%W',
			'DDD' => '%a',
			'DD' => '%d',
			'D' => '%e',
			'YYYY' => '%Y',
			'YY' => '%y',
			'hhhh' => '%H',
			'hhh' => '%k',
			'hh' => '%I',
			'h' => '%l',
			'mm' => '%i',
			'ss' => '%S',
			'zz' => '%p',
			'ttt' => '%@',
			);
		static private $mapAT2QC = null;

		static public function qcFrmt($jqFrmt) {
			if (!QCalendar::$mapJQ2QC) {
				QCalendar::$mapJQ2QC = array_flip(QAnyTimeBox::$mapQC2AT);
			}
			return strtr($jqFrmt, QAnyTimeBox::$mapAT2QC);
		}

		static public function atFrmt($qcFrmt) {
			return strtr($qcFrmt, QAnyTimeBox::$mapQC2AT);
		}

		public function __construct($objParentObject, $strControlId = null) {
			parent::__construct($objParentObject, $strControlId);
			
			$this->AddPluginJavascriptFile("QAnyTimeBox", "anytimec.js");
			$this->AddPluginCssFile("QAnyTimeBox", "anytimec.css");
		}

		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				case "DateTimeFormat" :
				case "DateFormat":
					return $this->strDateTimeFormat;
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
				case "DateTimeFormat":
				case "DateFormat":
					$this->strDateTimeFormat = $mixValue;
					$this->strAtDateTimeFormat = QAnyTimeBox::atFrmt($this->strDateTimeFormat);
					break;

				case "AtDateTimeFormat":
					parent::__set($strName, $mixValue);
					$this->strDateTimeFormat = QAnyTimeBox::qcFrmt($this->strAtDateTimeFormat);
					break;

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