<?php
class QSortablePanel extends QPanel {
	
 // I've created pnl array, which will contain of child panels. Note, that you basically have already children available (GetChildControls() or something like that). But having references here is somewhat more clear and easier to use. You can have different child controls, but here you only store panels which are movable inside given control

	protected $strJavaScripts = __JQUERY_EFFECTS__;
	protected $strStyleSheets = __JQUERY_CSS__;

	private $strCallback;

  /**
   * QControl/QForm, which has the method to call in case of MoveCallback($objObject) event.
   */
	protected $objMoveCallbackObject;

  /**
   * Method, which will be called in case of "onselect" MoveCallback event.
   */
	protected $strMoveCallbackMethod;

  /**
   * QControl/QForm, which has the method to call in case of FirstCallback($objObject) event.
   */
	protected $objFirstCallbackObject;

  /**
   * Method, which will be called in case of "onselect" FirstCallback event.
   */
	protected $strFirstCallbackMethod;

  /**
   * QControl/QForm, which has the method to call in case of SetSecondCallback($objObject) event.
   */
	protected $objSecondCallbackObject;

  /**
   * Method, which will be called in case of "onselect" SecondCallback event.
   */
	protected $strSecondCallbackMethod;

  /**
   * QControl/QForm, which has the method to call in case of SetThirdCallback($objObject) event.
   */
	protected $objThirdCallbackObject;

  /**
   * Method, which will be called in case of "Add Button" SetSecondCallback event.
   */
	protected $strThirdCallbackMethod;

  public $pxyMoveRow;
  public $pnlArray = array();
	public $strControlIdList = array();
	public $strMovableControlId;
	public $intMovableIndex;

  public function __construct($objParentObject, $strControlId = null) {
        try {
            parent::__construct($objParentObject, $strControlId);
        } catch (QCallerException $objExc) {
            $objExc->IncrementOffset();
            throw $objExc;
        }
    // proxy for handling move event
    $this->pxyMoveRow = new QControlProxy($this);
    $this->pxyMoveRow->AddAction(new QMoveEvent(), new QAjaxControlAction($this, 'pnlEntry_Move'));
  }

  public function MakeSortable() {

		QApplication::ExecuteJavaScript(sprintf("
			jQuery(function() {
  		jQuery('#ul%s').sortable({handle: '.sortablehandle', cursor: 'progress', scroll: true,
      scrollSensitivity: 30, placeholder: 'sortPlaceholder',  tolerance: 'pointer',
      update: function(event, ui) {
      // what moved
      var strLiId = ui.item.attr('id');
      strLiId = strLiId.substr(0, strLiId.length - 3);
      // where moved
      var strIndex = \$j(this).children('li').index(ui.item);
			// array of all elements
			var strControlIdList = \$j(this).sortable('toArray');
      qc.pA('%s', '%s', 'QMoveEvent', strLiId + '|' + strIndex + '|' + strControlIdList, '%s');
      }
  });

});
        ", $this->strControlId,
        $this->objForm->FormId,
        $this->pxyMoveRow->ControlId,
        $this->objForm->DefaultWaitIcon->ControlId));
    }


	// Add panel to array of sortable panels
  public function AddPanel(QPanel $pnl) {
    $this->pnlArray[$pnl->ControlId] = $pnl;
  }

	// Return the array of sortable panels
  public function GetPanelArray() {
    return $this->pnlArray;
  }

	// Return list of sorted panel control id's
  public function GetPanelArraySeq() {
    return $this->strControlIdList;
  }

	// Reset the array of sortable panels
  public function DestroyPanel() {   
  	$this->pnlArray = array();
		$this->strControlIdList = array();
    return;
  }

	// This method is run, when QMoveEvent fires
  public function pnlEntry_Move($strFormId, $strControlId, $strParameter) {
    // param = what_moved_control_id|where_to_moved_index|control_ids_in_new_sequence
    //alert($strParameter);
    $strParamArray = explode('|', $strParameter);
    if (count($strParamArray) != 3) {
      return false;
    }
		$this->strControlIdList = array();
    $this->strMovableControlId = $strParamArray[0];
    $this->intMovableIndex = (int) $strParamArray[1]; // new index of control moved
		$this->strControlIdList = $strParamArray[2]; // string of sortable controls in new sequence

    // If you have any custom code to add, you can set this callback and do it here
		$objControl = $this->objMoveCallbackObject;
  	$strMethod = $this->strMoveCallbackMethod;
   	if ($objControl) {
			$objControl->$strMethod($this->strMovableControlId,$this->intMovableIndex,$this->strControlIdList);
   	}
  }

  //Find selected Control Step for First Callback
	public function FirstCallBack($strFormId,$strControlId) {
	  //loop through panels
		$intindex = 0;
    foreach ($this->pnlArray as $pnly) {
      //save panel control
      $pnlControlsave = $pnly->ControlId;
      foreach ($pnly->GetChildControls() as $pnlcontrol) {
        //find the button. if it matches the button selected, process it
        if ($pnlcontrol instanceof QButton && $pnlcontrol->ControlId == $strControlId){
					$objControl = $this->objFirstCallbackObject;
        	$strMethod = $this->strFirstCallbackMethod;
        	if ($objControl) {
            	$objControl->$strMethod($intindex);
        	}
					return;
        }
      }
    	$intindex++;
    }
  }

  //Find selected Control Step for Second Callback
	public function SecondCallBack($strFormId,$strControlId) {
	  //loop through panels
		$intindex = 0;
    foreach ($this->pnlArray as $pnly) {
      //save panel control
      $pnlControlsave = $pnly->ControlId;
      foreach ($pnly->GetChildControls() as $pnlcontrol) {
        //find the button. if it matches the button selected, process it
        if ($pnlcontrol instanceof QButton && $pnlcontrol->ControlId == $strControlId){
					$objControl = $this->objSecondCallbackObject;
        	$strMethod = $this->strSecondCallbackMethod;
        	if ($objControl) {
            	$objControl->$strMethod($intindex);
        	}
					return;
        }
      }
    	$intindex++;
    }
  }

  //Find selected Control Step for Second Callback
	public function ThirdCallBack($strFormId,$strControlId) {
	  //loop through panels
		$intindex = 0;
    foreach ($this->pnlArray as $pnly) {
      //save panel control
      $pnlControlsave = $pnly->ControlId;
      foreach ($pnly->GetChildControls() as $pnlcontrol) {
        //find the button. if it matches the button selected, process it
        if ($pnlcontrol instanceof QButton && $pnlcontrol->ControlId == $strControlId){
					$objControl = $this->objThirdCallbackObject;
        	$strMethod = $this->strThirdCallbackMethod;
        	if ($objControl) {
            	$objControl->$strMethod($intindex);
        	}
					return;
        }
      }
    	$intindex++;
    }
  }

    /**
     * Sets object and callback to method, which is performed when QMoveEvent fires
     * @param QControl|QForm $objControl
     * @param string $strMethod
     */
    public function SetMoveCallback($objControl, $strMethod) {
        $this->objMoveCallbackObject = $objControl;
        $this->strMoveCallbackMethod = $strMethod;
    }

    /**
     * Sets object and callback to method
     * @param QControl|QForm $objControl
     * @param string $strMethod
     */
    public function SetFirstCallback($objControl, $strMethod) {
        $this->objFirstCallbackObject = $objControl;
        $this->strFirstCallbackMethod = $strMethod;
    }

    /**
     * Sets object and callback to method
     * @param QControl|QForm $objControl
     * @param string $strMethod
     */
    public function SetSecondCallback($objControl, $strMethod) {
        $this->objSecondCallbackObject = $objControl;
        $this->strSecondCallbackMethod = $strMethod;
    }

    /**
     * Sets object and callback to method
     * @param QControl|QForm $objControl
     * @param string $strMethod
     */
    public function SetThirdCallback($objControl, $strMethod) {
        $this->objThirdCallbackObject = $objControl;
        $this->strThirdCallbackMethod = $strMethod;
    }
}

?>