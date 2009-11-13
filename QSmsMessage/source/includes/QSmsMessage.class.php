<?php
    
  /**
   * QSmsMessage
   * 
   * Extends QEmailMessage to add SMS text functionality. 
   * 
   * @package   
   * @author Steven Warren 
   * @version 1.0
   * @access public
   */
  class QSmsMessage extends QEmailMessage {
      
      protected $strMobileNumber = null; // our mobile number
      protected $strCarrier = QSmsCarrierType::Unknown; // Network provider
      
      
      /**
       * QSmsMessage::__construct()
       * 
       * @param mixed $strFrom
       * @param mixed $strTo
       * @param mixed $strSubject
       * @param mixed $strBody
       * @return
       */
      public function __construct($strFrom = null, $strTo = null, $strSubject = null, $strBody = null) {
            
          try {
             parent::__construct($strFrom, $strTo, $strSubject, $strBody);
          } catch (QCallerException $objExc) { 
              $objExc->IncrementOffset(); throw $objExc; 
          }            
        }
        /**
         * QSmsMessage::SmsAddress()
         * 
         * @return
         */
        public function SmsAddress () {
            if ($this->strMobileNumber || $this->strCarrier <> QSmsCarrierType::Unknown){
                $strSmsAddress = $this->strMobileNumber . $this->strCarrier;
                return $strSmsAddress;                
            } else {
                return null;
            }
        }
        
        /**
         * QSmsMessage::__get()
         * 
         * @param mixed $strName
         * @return
         */
        public function __get($strName)
        {
            switch ($strName) {
                case 'MobileNumber': return $this->strMobileNumber;                            
                case 'Carrier': return $this->strCarrier;
				case 'To': return $this->strMobileNumber . $this->strCarrier;
                
                default:
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
        /**
         * QSmsMessage::__set()
         * 
         * @param mixed $strName
         * @param mixed $mixValue
         * @return
         */
        public function __set($strName, $mixValue)
        {
            switch ($strName) {
                case 'MobileNumber':
                    try {
                        return ($this->strMobileNumber = QType::Cast($mixValue, QType::String));
                    }
                    catch (QCallerException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }                
                case 'Carrier':
                    try {
                        return ($this->strCarrier = QType::Cast($mixValue, QType::String));
                    }
                    catch (QCallerException$objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }                
                default:
                    try {
                        return (parent::__set($strName, $mixValue));
                    }
                    catch (QCallerException $objExc) {
                        $objExc->IncrementOffset();
                        throw $objExc;
                    }
            }
        }
              
    }
?>
