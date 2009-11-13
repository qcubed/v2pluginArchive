<?php
class QVisualCalendar extends QControl {

	private $intMonth = 0;
	private $intYear = 0;
	private $intDay = 0;

	protected $selectedDate;
	protected $minSelectableDate;
	protected $maxSelectableDate;
	protected $startMonthYear;

	protected $blnDisabled;

	protected $strLabelForRequiredUnnamed;
	protected $strLabelForRequired;

	protected $strCssClass = 'calendar';

	protected $DateTime;

	public function ParsePostData() {}

	public function GetControlHtml() {
		// Pull any Attributes
		$strAttributes = $this->GetAttributes();

		// Pull any styles
		if ($strStyle = $this->GetStyleAttributes())
		$strStyle = 'style="' . $strStyle . '"';

		if ($this->intMonth == 0) {
			if (isset($this->selectedDate)) {
				$realDate = date("m/d/Y",strtotime($this->selectedDate));
				$realDateArray = explode("/",$realDate);
				$this->intMonth = $realDateArray[0];
				$this->intYear = $realDateArray[2];
			} else {
				$this->intMonth = date('m');
				$this->intYear = date('Y');
			}
		}
		return $this->GenerateCalendar();
	}

	public function GenerateCalendar() {
			
		if ($this->blnDisabled) { // if the control is disabled, show a "greyed" out version

			// next/prev month/year links
			$lnkPrevYear = "&lt;&lt;";
			$lnkPrevMonth = "&lt;";
			$lnkNextMonth = "&gt;";
			$lnkNextYear = "&gt;&gt;";

			// header row, nav links and selected month/year
			$timestamp = mktime(0, 0, 0, $this->intMonth, 1, $this->intYear);
			$myDate = QApplication::Translate(date("F",$timestamp)) . ' ' . date("Y",$timestamp) ;
			$strHeader = sprintf("<table class='main' cellpadding='0' cellspacing='0'><tr><td colspan='7'><table class='header' width='100%%'><tr><td class='navdisabled' style='width: 5px'>%s</td><td class='navdisabled' style='width: 5px'>%s</td><td class='navdisabled'><center>%s</center></td><td class='navdisabled' style='width: 5px'>%s</td><td class='navdisabled'  style='width: 5px'>%s</td></tr></table></td></tr>",$lnkPrevYear,$lnkPrevMonth,$myDate,$lnkNextMonth,$lnkNextYear);

			// day header row
			$strDayHeader = "<tr>";
			$first_day = 0;
			$first_of_month = gmmktime(0,0,0,$this->intMonth,1,$this->intYear);
			$day_names = array();
			for ($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400)
			$strDayHeader .= sprintf("<td class='dayheader'>%s</td>",ucfirst(QApplication::Translate(gmstrftime('%a',$t))));
			$strDayHeader .= "</tr>";

			// beginning the first row of the month, determining which day of the week is the 1st
			list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
			$weekday = ($weekday + 7 - $first_day) % 7;

			$tmp = "<tr>";
			// loop through days belonging to previous month
			for ($x = 0; $x < $weekday; $x++) {
				$tmp .= "<td class='daydisabled'>&nbsp;</td>";
			}

			// loop through days in current month, first week
			$loop = 8 - $weekday;
			for ($x = 1; $x < $loop; $x++) {
				$tmp .= sprintf("<td class='daydisabled'>%d</td>",$x);
			}
			$tmp .= "</tr>";

			// determine number of days in current month and build the rest of those days
			$numDays = cal_days_in_month(CAL_GREGORIAN, $this->intMonth, $this->intYear);
			for ($x = $loop; $x < $numDays+1; $x++) {
				if (($x-$loop) % 7 == 0) {
					$tmp .= "</tr><tr>";
				}
				$tmp .= sprintf("<td class='daydisabled'>%d</td>",$x);
			}

			// output selected date
			$tmp .= "<tr bgcolor='silver'><td colspan='7' align='center' style='border-top: 1px solid'>" . QApplication::Translate("Selected") . ':'  . QApplication::Translate("No Expiration") . "</td></tr>";

		} else { // control is enabled
				
			// these are the navigation parameters, not pretty but functional
			$this->strActionParameter = 100;
			$lnkPrevYear = sprintf("<a href='javascript:void(0);' %s>&lt;&lt;</a>",$this->GetActionAttributes());
			$this->strActionParameter = 101;
			$lnkPrevMonth = sprintf("<a href='javascript:void(0);' %s>&lt;</a>",$this->GetActionAttributes());
			$this->strActionParameter = 102;
			$lnkNextMonth = sprintf("<a href='javascript:void(0);' %s>&gt;</a>",$this->GetActionAttributes());
			$this->strActionParameter = 103;
			$lnkNextYear = sprintf("<a href='javascript:void(0);' %s>&gt;&gt;</a>",$this->GetActionAttributes());

			// header row, nav links and selected month/year
			$timestamp = mktime(0, 0, 0, $this->intMonth, 1, $this->intYear);
			$myDate = QApplication::Translate(date("F",$timestamp)) . ' ' . date("Y",$timestamp) ;
			$strHeader = sprintf("<table class='main' cellpadding='0' cellspacing='0'><tr><td colspan='7'><table class='header' width='100%%'><tr><td class='dateprev' style='width: 5px'>%s</td><td class='dateprev' style='width: 5px'>%s</td><td class='datedisplay'><center>%s</center></td><td class='datenext' style='width: 5px'>%s</td><td class='datenext'  style='width: 5px'>%s</td></tr></table></td></tr>",$lnkPrevYear,$lnkPrevMonth,$myDate,$lnkNextMonth,$lnkNextYear);

			// day header row
			$strDayHeader = "<tr>";
			$first_day = 0;
			$first_of_month = gmmktime(0,0,0,$this->intMonth,1,$this->intYear);
			$day_names = array();
			for ($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400)
			$strDayHeader .= sprintf("<td class='dayheader'>%s</td>",ucfirst(QApplication::Translate(gmstrftime('%a',$t))));
			$strDayHeader .= "</tr>";

			// beginning the first row of the month, determining which day of the week is the 1st
			list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
			$weekday = ($weekday + 7 - $first_day) % 7;

			$tmp = "<tr>";
			// loop through days belonging to the previous month
			for ($x = 0; $x < $weekday; $x++) {
				$tmp .= "<td class='dayprevmonth'>&nbsp;</td>";
			}

			// loop through days in current month, first week
			$loop = 8 - $weekday;
			for ($x = 1; $x < $loop; $x++) {
				// default cssclass to selectable day
				$strClass = "day";
				$intCurrentDate = strtotime($this->intMonth . "/" . $x . "/" . $this->intYear);
				$intMinSelectableDate = ($this->minSelectableDate->IsNull() ? 0:$this->minSelectableDate->Timestamp); 
				$intMaxSelectableDate = ($this->maxSelectableDate->IsNull() ? strtotime('18 Jan 2038'):$this->maxSelectableDate->Timestamp);
				if ($intCurrentDate >= $intMinSelectableDate && $intCurrentDate <= $intMaxSelectableDate) {
					$this->strActionParameter = $x+1;
				} else {
					// current day either occurs before minSelectableDate or after maxSelectableDate so disable it
					$this->strActionParameter = 0;
					$strClass = "daydisabled";
				}
				// if current day is the selected day set on the object, show it as selected
				$timestamp = gmmktime(0,0,0,$this->intMonth,$x+1,$this->intYear);
				$day = QApplication::Translate(date("M",$timestamp)) . ' ' . date("d",$timestamp). ' ' . date("Y",$timestamp);
				if ($day == $this->selectedDate) {
					$strClass = "dayselected";
				}
				// output the day
				$tmp .= sprintf("<td class='%s'><a href='javascript:void(0);' %s>%d</a></td>",$strClass,$this->GetActionAttributes(),$x);
			}
			$tmp .= "</tr>";

			// determine number of days in current month and build the rest of those days
			$numDays = cal_days_in_month(CAL_GREGORIAN, $this->intMonth, $this->intYear);
			for ($x = $loop; $x < $numDays+1; $x++) {
				if (($x-$loop) % 7 == 0) {
					$tmp .= "</tr><tr>";
				}
				// default cssclass to selectable day
				$strClass = "day";
				$intCurrentDate = strtotime($this->intMonth . "/" . $x . "/" . $this->intYear);
				$intMinSelectableDate = ($this->minSelectableDate->IsNull() ? 0:$this->minSelectableDate->Timestamp);
				$intMaxSelectableDate = ($this->maxSelectableDate->IsNull() ? strtotime('18 Jan 2038'):$this->maxSelectableDate->Timestamp);
				if ($intCurrentDate >= $intMinSelectableDate && $intCurrentDate <= $intMaxSelectableDate) {
					$this->strActionParameter = $x+1;
				} else {
					// current day either occurs before minSelectableDate or after maxSelectableDate so disable it
					$this->strActionParameter = 0;
					$strClass = "daydisabled";
				}
				// if current day is the selected day set on the object, show it as selected
				if (date("M d Y",gmmktime(0,0,0,$this->intMonth,$x+1,$this->intYear)) == $this->selectedDate) {
					$strClass = "dayselected";
				}
				// output the day
				$tmp .= sprintf("<td class='%s'><a href='javascript:void(0);' %s>%d</a></td>",$strClass,$this->GetActionAttributes(),$x);
			}
			// output selected date
			if ($this->selectedDate != "") {
				$tmp .= sprintf("<tr bgcolor='silver'><td colspan='7' align='center' style='border-top: 1px solid'>" . QApplication::Translate("Selected") . ": %s</td></tr>",$this->selectedDate);
			} else {
				$tmp .= "<tr bgcolor='silver'><td colspan='7' align='center' style='border-top: 1px solid'>" . QApplication::Translate("Selected") . ':'  . QApplication::Translate("None") . "</td></tr>";
			}
		}

		return $strHeader . $strDayHeader . $tmp .  "</div></table>";
	}

	public function __construct($objParentObject, $strControlId = null) {
		try {
			parent::__construct($objParentObject, $strControlId);
			
			$this->minSelectableDate = new QDateTime();
			$this->maxSelectableDate = new QDateTime();
			
			$this->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'Navigate_Click'));
			$this->AddAction(new QClickEvent(), new QTerminateAction());

			$this->strLabelForRequired = QApplication::Translate('%s is required');
			$this->strLabelForRequiredUnnamed = QApplication::Translate('Required');
		} catch (QCallerException $objExc) { $objExc->IncrementOffset(); throw $objExc; }

		$this->setFiles();
	}

	private function setFiles() {
		$this->AddPluginCssFile("QVisualCalendar", "qvisualcalendar.css");
	}
	
	public function Navigate_Click($strFormId, $strControlId, $strParameter) {
		$this->blnModified = true;
			
		switch ($strParameter) {
			case 0: // do nothing
				break;
			case 100: // previous year
				$this->intYear -= 1;
				break;
			case 101: // previous month
				if ($this->intMonth == 1) {
					$this->intMonth = 12;
					$this->intYear -= 1;
				} else {
					$this->intMonth -= 1;
				}
				break;
			case 102: // next month
				if ($this->intMonth == 12) {
					$this->intMonth = 1;
					$this->intYear += 1;
				} else {
					$this->intMonth += 1;
				}
				break;
			case 103:  // next year
				$this->intYear += 1;
				break;
			default:
				$timestamp = gmmktime(0,0,0,$this->intMonth,$strParameter,$this->intYear);
				$this->selectedDate = QApplication::Translate(date("M",$timestamp)) . ' ' . date("d",$timestamp). ' ' . date("Y",$timestamp) ;
				$this->DateTime = QDateTime::FromTimestamp($timestamp);
		}
	}

	public function Validate() {
		$this->strValidationError = "";
			
		// not sure where else to do this
		if ($this->blnDisabled) {
			$this->selectedDate = "";
		}

		// Check for Required
		if ($this->blnRequired) {
			if (strlen($this->selectedDate) == 0) {
				if ($this->strName)
				$this->strValidationError = sprintf($this->strLabelForRequired, $this->strName);
				else
				$this->strValidationError = $this->strLabelForRequiredUnnamed;
				return false;
			}
		}
		return true;
	}

	public function GetJavaScriptAction() {
		return "onclick";
	}

	/////////////////////////
	// Public Properties: GET
	/////////////////////////
	public function __get($strName) {
		switch ($strName) {

			case "SelectedDate": return $this->selectedDate;					
			case "LabelForRequired": return $this->strLabelForRequired;
			case "LabelForRequiredUnnamed": return $this->strLabelForRequiredUnnamed;
			case "DateTime": return $this->DateTime;

			default:
				try {
					return parent::__get($strName);
				} catch (QCallerException $objExc) { $objExc->IncrementOffset(); throw $objExc; }
		}
	}

	/////////////////////////
	// Public Properties: SET
	/////////////////////////
	public function __set($strName, $mixValue) {
		$this->blnModified = true;

		switch ($strName) {
			case "Disabled":
				try {
					$this->blnDisabled = QType::Cast($mixValue, QType::Boolean);
					if ($this->blnDisabled) {
						$this->Required = false;
					} else {
						$this->Required = true;
					}
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case "LabelForRequired":
				try {
					$this->strLabelForRequired = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
			case "LabelForRequiredUnnamed":
				try {
					$this->strLabelForRequiredUnnamed = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
					
			case "DateTime":
				try {
					$this->DateTime = QType::Cast($mixValue, QType::DateTime);
					$timestamp = $this->DateTime->Timestamp;
					$this->selectedDate = QApplication::Translate(date("M",$timestamp)) . ' ' . date("d",$timestamp). ' ' . date("Y",$timestamp) ;
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
					
			case "StartMonthYear":
				$this->startMonthYear = $mixValue;
				break;
			case "SelectedDate":
				$this->selectedDate = $mixValue;
				break;
			case "MinSelectableDate":
				//$this->minSelectableDate = $mixValue;
				$this->minSelectableDate = QType::Cast($mixValue, QType::DateTime);
				break;
			case "MaxSelectableDate":
				//$this->maxSelectableDate = $mixValue;
				$this->maxSelectableDate = QType::Cast($mixValue, QType::DateTime);
				break;

			default:
				try {
					return (parent::__set($strName, $mixValue));
				} catch (QCallerException $objExc) { $objExc->IncrementOffset(); throw $objExc; }
		}
	}
}
?>
