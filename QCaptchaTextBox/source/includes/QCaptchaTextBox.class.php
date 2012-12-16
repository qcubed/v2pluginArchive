<?php

	/**
	 * @package Controls
	 *
	 * @property string $CssClass
	 * @property int $Length
	 * @property int $ImageHeight
	 * @property int[] $ForeColor RGB Foreground Color
	 * @property int[] $SignColor RGB Signs color to add noise to the image
	 * @property int[] $BackgroundColor RGB Background Color
	 * @property boolean $AllowUpperCaseLetter
	 * @property boolean $AllowLowerCaseLetter
	 * @property boolean $AllowNumbers
	 * @property boolean $CaseSensitive
	 * @property boolean $AddSign
	 * @property boolean $AddNoise
	 * @property boolean $AddBlur
	 * @property boolean $Required
	 */
	class QCaptchaTextBox extends QTextBox {

		protected $strCssClass = 'captchatextbox';
		protected $intLength = "6";
		protected $intImageHeight = "75";

		/** Manage the color generation*/
		protected $rgbForeColor = array(0, 0, 0); //RGB Fore Color
		protected $rgbSignColor = array(128, 128, 128); //RGB Signs color to add noise to the image.
		protected $rgbBackgroundColor = array(255, 255, 255); //RGB Background Color.

		/** Manage the type of characters included in the string */
		protected $blnAllowUpperCaseLetter = true;
		protected $blnAllowLowerCaseLetter = true;
		protected $blnAllowNumbers = false;
		protected $blnCaseSensitive = true;

		/**
		 * Addition of Extra image manipulation to strengthen the Captcha
		 * Extra processing will require more ressources on the server to generate the images so
		 * you should be careful when activating these option on high traffic server.
		 */
		protected $blnAddSign = true; //Basic filters to include standard security.
		protected $blnAddNoise = false;
		protected $blnAddBlur = false;

		protected $blnRequired = true;

		public function __construct($objParentObject, $strControlId = null) {
			parent::__construct($objParentObject, $strControlId = null);

			$this->RefreshSessionVariables();
		}

		public function RefreshSessionVariables() {
			$strCaptchaParams = '__CAPTCHA_' . $this->ControlId . '_PARAMS__';
			//Makes parameters available through session to make Image generation use them.
			$_SESSION[$strCaptchaParams]['Length'] = $this->intLength;
			$_SESSION[$strCaptchaParams]['ImageHeight'] = $this->intImageHeight;

			/** Manage the color generation*/
			$_SESSION[$strCaptchaParams]['ForeColor'] = $this->rgbForeColor;
			$_SESSION[$strCaptchaParams]['SignColor'] = $this->rgbSignColor;
			$_SESSION[$strCaptchaParams]['BackgroundColor'] = $this->rgbBackgroundColor;

			/** Manage the type of characters included in the string */
			$_SESSION[$strCaptchaParams]['AllowUpperCaseLetter'] = $this->blnAllowUpperCaseLetter;
			$_SESSION[$strCaptchaParams]['AllowLowerCaseLetter'] = $this->blnAllowLowerCaseLetter;
			$_SESSION[$strCaptchaParams]['AllowNumbers'] = $this->blnAllowNumbers;
			$_SESSION[$strCaptchaParams]['CaseSensitive'] = $this->blnCaseSensitive;

			/**
			 * Addition of Extra image manipulation to strengthen the Captcha
			 * Extra processing will require more ressources on the server to generate the images so
			 * you should be careful when activating these option on high traffic server.
			 */
			$_SESSION[$strCaptchaParams]['AddSign'] = $this->blnAddSign;
			$_SESSION[$strCaptchaParams]['AddNoise'] = $this->blnAddNoise;
			$_SESSION[$strCaptchaParams]['AddBlur'] = $this->blnAddBlur;
		}

		//Session variable devrait �tre le ControlId Pr�c�d� du mot Captcha... Parr� dans le GET.
		protected $strCaptchaSessionVariable;

		public function Validate() {
			if (parent::Validate()) {
				// Check against maximum length?
				$strImageText = $_SESSION['__CAPTCHA_' . $this->ControlId . '__'];
				$strInputText = $this->strText;

				//check if we ignore case
				if (!$this->blnCaseSensitive) {
					$strImageText = strtolower($strImageText);
					$strInputText = strtolower($strInputText);
				}

				if ($strImageText != $strInputText) {
					$this->Warning = QApplication::Translate("Captcha validation failed.");
					return false;
				}

				// If we're here, then everything is a-ok.  Return true.
				return true;
			} else {
				return false;
			}
		}

		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				case "CssClass": return $this->strCssClass;
				case "Length": return $this->intLength;
				case "ImageHeight": return $this->intImageHeight;
				case "ForeColor": return $this->rgbForeColor;
				case "SignColor": return $this->rgbSignColor;
				case "BackgroundColor": return $this->rgbBackgroundColor;
				case "AllowUpperCaseLetter": return $this->blnAllowUpperCaseLetter;
				case "AllowLowerCaseLetter": return $this->blnAllowLowerCaseLetter;
				case "AllowNumbers": return $this->blnAllowNumbers;
				case "CaseSensitive": return $this->blnCaseSensitive;
				case "AddSign": return $this->blnAddSign;
				case "AddNoise": return $this->blnAddNoise;
				case "AddBlur": return $this->blnAddBlur;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		protected function GetControlHtml() {
			$strStyle = $this->GetStyleAttributes();
			if ($strStyle)
				$strStyle = sprintf('style="%s"', $strStyle);
			
			// A refresh Captch Button
			$refreshButton = new QLinkButton($this);
			$refreshButton->Text = QApplication::Translate("Refresh CAPTCHA");
			$refreshButton->AddAction(new QClickEvent(), new QAjaxAction($this, "Refresh"));
			
			switch ($this->strTextMode) {
				case QTextMode::MultiLine:
				case QTextMode::Password:
				case QTextMode::SingleLine:
				default:
					$strToReturn = sprintf('<div class="wrapper_captcha"><img class="captcha" src="%s" alt="Security Code" /><span class="captcha-refresh">%s</span><input type="text" name="%s" id="%s" value="' . $this->strFormat . '" %s%s /></div>',
						__PLUGIN_ASSETS__ . "/QCaptchaTextBox/captcha.php?cId=" . $this->strControlId,
						$refreshButton->Render(false);
						$this->strControlId,
						$this->strControlId,
						QApplication::HtmlEntities($this->strText),
						$this->GetAttributes(),
						$strStyle);
			}

			return $strToReturn;
		}

		/////////////////////////
		// Public Properties: SET
		/////////////////////////
		public function __set($strName, $mixValue) {
			$this->blnModified = true;

			switch ($strName) {
				case 'Length' :
					try {
						$this->intLength = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'ImageHeight' :
					try {
						$this->intImageHeight = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'ForeColor' :
					if (!is_array($mixValue) || count($mixValue) != 3 || !is_numeric($mixValue[0]) || !is_numeric($mixValue[1]) || !is_numeric($mixValue[2]))
						throw new QInvalidCastException("Invalid Color, Array of three numeric values expected");
					//Validate values of 0 to 255.
					if ($mixValue[0] < 0 || $mixValue[0] > 255)
						throw new QInvalidCastException("Invalid Color, First parameter must be an integer between 0 and 255.");

					if ($mixValue[1] < 0 || $mixValue[1] > 255)
						throw new QInvalidCastException("Invalid Color, Second parameter must be an integer between 0 and 255.");

					if ($mixValue[2] < 0 || $mixValue[2] > 255)
						throw new QInvalidCastException("Invalid Color, Third parameter must be an integer between 0 and 255.");
					$this->rgbForeColor = $mixValue;
					break;
				case 'SignColor' :
					if (!is_array($mixValue) || count($mixValue) != 3 || !is_numeric($mixValue[0]) || !is_numeric($mixValue[1]) || !is_numeric($mixValue[2]))
						throw new QInvalidCastException("Invalid Color, Array of three numeric values expected");
					//Validate values of 0 to 255.
					if ($mixValue[0] < 0 || $mixValue[0] > 255)
						throw new QInvalidCastException("Invalid Color, First parameter must be an integer between 0 and 255.");

					if ($mixValue[1] < 0 || $mixValue[1] > 255)
						throw new QInvalidCastException("Invalid Color, Second parameter must be an integer between 0 and 255.");

					if ($mixValue[2] < 0 || $mixValue[2] > 255)
						throw new QInvalidCastException("Invalid Color, Third parameter must be an integer between 0 and 255.");
					$this->rgbSignColor = $mixValue;
					break;
				case 'BackgroundColor' :
					if (!is_array($mixValue) || count($mixValue) != 3 || !is_numeric($mixValue[0]) || !is_numeric($mixValue[1]) || !is_numeric($mixValue[2]))
						throw new QInvalidCastException("Invalid Color, Array of three numeric values expected");

					//Validate values of 0 to 255.
					if ($mixValue[0] < 0 || $mixValue[0] > 255)
						throw new QInvalidCastException("Invalid Color, First parameter must be an integer between 0 and 255.");

					if ($mixValue[1] < 0 || $mixValue[1] > 255)
						throw new QInvalidCastException("Invalid Color, Second parameter must be an integer between 0 and 255.");

					if ($mixValue[2] < 0 || $mixValue[2] > 255)
						throw new QInvalidCastException("Invalid Color, Third parameter must be an integer between 0 and 255.");
					$this->rgbBackgroundColor = $mixValue;
					break;
				case 'AllowUpperCaseLetter' :
					try {
						$this->blnAllowUpperCaseLetter = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'AllowLowerCaseLetter' :
					try {
						$this->blnAllowLowerCaseLetter = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'AllowNumbers' :
					try {
						$this->blnAllowNumbers = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'CaseSensitive' :
					try {
						$this->blnCaseSensitive = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'AddSign' :
					try {
						$this->blnAddSign = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'AddNoise' :
					try {
						$this->blnAddNoise = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case 'AddBlur' :
					try {
						$this->blnAddBlur = QType::Cast($mixValue, QType::Boolean);
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

			$this->RefreshSessionVariables();
		}
	}

?>
