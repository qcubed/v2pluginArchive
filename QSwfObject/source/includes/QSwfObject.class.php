<?php

/**
 * QSwfObject
 * 
 * This control is a QControl wrapper for the popular SwfObject javascript control. It can be used to embed 
 * Flash media easily into your QForms. You can get more information on SwfObect at 
 * http://code.google.com/p/swfobject/wiki/documentation.  With Alex Rabe's permission I used his PHP SwfObject 
 * class as a guide. Information on Alex's class can be viewed at http://alexrabe.boelinger.com/2008/09/17/swfobject-21/. 
 *
 * @author Steven Warren
 * @copyright 2009
 * @version 1.1
 * @access public
 * @package controls
 * 
 * Added fix when adding flashVars the variable name was missing double quotes.
 *
 * @property integer Width sets width property of the Flash file
 * @property string Height sets Height property of the Flash file
 * @property string Message Alternate message to be displayed if browser does not support Flash
 * @property string SwfUrl The URL of the flash file to be loaded (format is: "major.minor.release" or "major")
 * @property string Version The minimum version of Flash Player needed to play file (defaults to 9.0.0)
 * @property string ExpressInstallSwfurl location of the express install SWF. (default file with source included in image directory)
 */
class QSwfObject extends QControl
{

    private $intWidth = 200;
    private $intHeight = 200;
    private $strSwfUrl;
    private $strVersion = '9.0.0';
    private $bolExpressInstallSwfurl = 'false';
    private $strMessage = 'The <a href="http://www.macromedia.com/go/getflashplayer">Flash Player</a> and <a href="http://www.mozilla.com/firefox/">a browser with Javascript support</a> are needed..';

    private $intId;
    private $strJs;
    private $classname = 'swfobject';
    private $arrFlashvars;
    private $arrParams;
    private $arrAttributes;
    private $strEmbedSWF;

    /**
     * QSwfObject::ParsePostData()
     * 
     * @return
     */
    public function ParsePostData()
    {
    }

    /**
     * QSwfObject::Validate()
     * 
     * @return
     */
    public function Validate()
    {
        return true;
    }

    /**
     * QSwfObject::GetControlHtml()
     * 
     * @return
     */
    public function GetControlHtml()
    {
        // Pull any Attributes
        $strAttributes = $this->GetAttributes();

        // Pull any styles
        if ($strStyle = $this->GetStyleAttributes())
            $strStyle = 'style="' . $strStyle . '"';

        // setup SwfObject
        $this->intId = $this->strControlId;
        $this->arrFlashvars = (is_array($this->arrFlashvars)) ? $this->arrFlashvars :
            array();
        $this->arrParams = (is_array($this->arrParams)) ? $this->arrParams : array();
        $this->arrAttributes = (is_array($this->arrAttributes)) ? $this->arrAttributes :
            array();

        $this->strEmbedSWF = 'swfobject.embedSWF("' . $this->strSwfUrl . '", "' . $this->strControlId . '", "' . $this->intWidth . '", "' . $this->intHeight . '", "' . $this->strVersion . '", ' . $this->bolExpressInstallSwfurl . ', this.flashvars, this.params , this.attr );' . "\n";


        // Return the HTML.
        return sprintf('<div class="%s" id="%s" style="width:%spx; height:%spx;">%s</div>', $this->classname, $this->strControlId, $this->intWidth, $this->intHeight, $this->strMessage);

    }

    /**
     * QSwfObject::__construct()
     *
     * Constructor for this control
     * @param mixed $objParentObject Parent QForm or QControl that is responsible for rendering this control
     * @param string $strControlId optional control ID 
     * @return
     */
    public function __construct($objParentObject, $strControlId = null)
    {
        try {
            parent::__construct($objParentObject, $strControlId);
        }
        catch (QCallerException$objExc) {
            $objExc->IncrementOffset();
            throw $objExc;
        }

        // Setup Control-specific CSS and JS files to be loaded
        $this->AddPluginJavascriptFile('QSwfObject', 'swfobject.js');
        
    }

  /**
     * QSwfObject::GetEndScript()
     * 
     * @return
     */
    public function GetEndScript()
    {
        $strToReturn = parent::GetEndScript();
        $strToReturn .= $this->CreateJavascript();
        return $strToReturn;
    }

    // For any HTML code that needs to be rendered at the END of the QForm when this control is INITIALLY rendered.
    //		public function GetEndHtml() {
    //			$strToReturn = parent::GetEndHtml();
    //			return $strToReturn;
    //		}
    /**
     * QSwfObject::CreateJavascript()
     * 
     * @return
     */
    private function CreateJavascript()
    {
        //Build javascript
        $this->strJs = "\nvar " . $this->intId . " = {\n";
        $this->strJs .= $this->AddJsParameters('params', $this->arrParams) . ",\n";
        $this->strJs .= $this->AddJsParameters('flashvars', $this->arrFlashvars) . ",\n";
        $this->strJs .= $this->AddJsParameters('attr', $this->arrAttributes) . ",\n";
        $this->strJs .= "\tstart : function() {" . "\n\t\t";
        $this->strJs .= $this->strEmbedSWF;
        $this->strJs .= "\t}\n}\n";
        $this->strJs .= $this->intId . '.start();';

        return $this->strJs;
    }
    /**
     * QSwfObject::AddFlashvars()
     * 
     * This method passes FlashVars to your SWF file using Key:Value pairs.
     * 
     * @param mixed $key
     * @param mixed $value
     * @param string $default
     * @param string $type
     * @param string $prefix
     * @return
     */
    public function AddFlashvars($key, $value, $default = '', $type = '', $prefix = '')
    {

        if (is_bool($value))
            $value = ($value) ? "true" : "false";

        if ($type == "bool")
            $value = ($value == "1") ? "true" : "false";

        // do not add the variable if we hit the default setting
        if ($value == $default)
            return;

        $this->arrFlashvars[$key] = $prefix . $value;
        return;
    }

    /**
     * QSwfObject::AddParams()
     * 
     * You can use the following optional Flash specific param elements :
     *	play
     * 	loop
     * 	menu
     * 	quality
     * 	scale
     * 	salign
     * 	wmode
     * 	bgcolor
     * 	base
     * 	swliveconnect
     * 	flashvars
     * 	devicefont 
     * 	allowscriptaccess
     * 	seamlesstabbing 
     * 	allowfullscreen 
     * 	allownetworking  
     * 
     * @param string $key
     * @param string $value
     * @param string $default
     * @param string $type
     * @param string $prefix
     * @return
     */
    public function AddParams($key, $value, $default = '', $type = '', $prefix = '')
    {

        if (is_bool($value))
            $value = ($value) ? "true" : "false";

        if ($type == "bool")
            $value = ($value == "1") ? "true" : "false";

        // do not add the variable if we hit the default setting
        if ($value == $default)
            return;

        $this->arrParams[$key] = $prefix . $value;
        return;
    }

    /**
     * QSwfObject::AddAttributes()
     * 
     * You can add the following often-used optional attributes to the object element:
     * id (NOTE: when undefined, the object element automatically inherits the id from the alternative content container element)
     * name
     * styleclass (used instead of class, because this is also an ECMA4 reserved keyword)
     * align 
     * 
     * @param string $key
     * @param string $value
     * @param string $default
     * @param string $type
     * @param string $prefix
     * @return
     */
    public function AddAttributes($key, $value, $default = '', $type = '', $prefix =
        '')
    {

        if (is_bool($value))
            $value = ($value) ? "true" : "false";

        if ($type == "bool")
            $value = ($value == "1") ? "true" : "false";

        // do not add the variable if we hit the default setting
        if ($value == $default)
            return;

        $this->arrAttributes[$key] = $prefix . $value;
        return;
    }

    /**
     * QSwfObject::AddJsParameters()
     * 
     * @param string $name
     * @param string $params
     * @return
     */
    private function AddJsParameters($name, $params)
    {
        $list = '';
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                if (!empty($list))
                    $list .= ",";
                $list .= "\n\t\t";
                $list .= sprintf('"%s" : "%s"', $key, $value );
            }
        }
        $js = "\t" . $name . ' : {' . $list . '}';
        return $js;
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    /**
     * QSwfObject::__get()
     * 
     * @param string $strName
     * @return
     */
    public function __get($strName)
    {
        switch ($strName) {
            case 'Width':
                return $this->intWidth;
            case 'Height':
                return $this->intHeight;
            case 'Message':
                return $this->strMessage;
            case 'SwfUrl':
                return $this->strSwfUrl;
            case 'Version':
                return $this->strVersion;
            case 'ExpressInstallSwfurl':
                return $this->bolExpressInstallSwfurl;
            default:
                try {
                    return parent::__get($strName);
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    /**
     * QSwfObject::__set()
     * 
     * @param string $strName
     * @param mixed $mixValue
     * @return
     */
    public function __set($strName, $mixValue)
    {
        $this->blnModified = true;

        switch ($strName) {
            case 'Width':
                try {
                    return ($this->intWidth = QType::Cast($mixValue, QType::Integer));
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case 'Height':
                try {
                    return ($this->intHeight = QType::Cast($mixValue, QType::Integer));
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case 'Message':
                try {
                    return ($this->strMessage = QType::Cast($mixValue, QType::String));
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case 'SwfUrl':
                try {
                    return ($this->strSwfUrl = QType::Cast($mixValue, QType::String));
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case 'Version':
                try {
                    return ($this->strVersion = QType::Cast($mixValue, QType::String));
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case 'ExpressInstallSwfurl':
                try {
                    return ($this->bolExpressInstallSwfurl = QType::Cast($mixValue, QType::Boolean));
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            default:
                try {
                    return (parent::__set($strName, $mixValue));
                }
                catch (QCallerException$objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }
}
?>