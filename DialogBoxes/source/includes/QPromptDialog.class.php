<?php

abstract class QPromptDialog extends QDialogBox {
	// internal state; do not modify. Use the provided Set* methods to change 
	// the presentation
	protected $strIntroLabel = "Enter a value:";
	protected $strFirstActionLabel = "Save";
	protected $strSecondActionLabel = "Cancel";

	protected $objParentObject;

	protected $firstActionCallback;
	protected $secondActionCallback;
	
	// Sadly, the controls cannot be declared protected - otherwise .tpl doesn't work.
	public $lblPromptLabel;
	public $lblFirstAction;
	public $lblSecondAction;
	
	public $proxyFirstAction;
	public $proxySecondAction;
	public $lblBottom;
	
	public function __construct($objParentObject, $formFirstActionCallback, $strControlId = null) {
		parent::__construct($objParentObject, $strControlId);

		$this->objParentObject = $objParentObject;
		
		$this->AutoRenderChildren = false;
		$this->MatteClickable = false;

		$this->firstActionCallback = $formFirstActionCallback;

		// By default, this dialog box should be hidden
		$this->Display = false;

		$this->proxyFirstAction = new QControlProxy($objParentObject);
		$this->proxyFirstAction->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'first_action_click'));

		$this->proxySecondAction = new QControlProxy($objParentObject);
		$this->proxySecondAction->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'second_action_click'));

		$this->lblPromptLabel = new QLabel($this);
		$this->lblPromptLabel->HtmlEntities = false;
		
		$this->lblFirstAction = new QLabel($this);
		$this->lblFirstAction->Display = false;

		$this->lblSecondAction = new QLabel($this);
		$this->lblSecondAction->Display = false;

		// The "bottom" label contains all the actionable controls (Save / Cancel "buttons" -
		// hyperlinks with control proxies hooked up)
		$this->lblBottom = new QLabel($this);
		$this->lblBottom->HtmlEntities = false;
		$this->lblBottom->TagName = "center";
		
		// Some visual defaults, feel free to override
		$this->Width = 300;
		$this->Padding = 15;
	}
	
	public function SetIntroLabel($strText) {
		$this->strIntroLabel = $strText . "<br>";
	}
	
	public function SetFirstActionLabel($strText) {
		$this->strFirstActionLabel = $strText;
	}

	public function SetSecondActionLabel($strText) {
		$this->strSecondActionLabel = $strText;
	}

	public function SetSecondActionCallback($strFunctionName) {
		$this->secondActionCallback = $strFunctionName;
	}

	public function GetShowDialogJavaScript() {
		$strOptions = 'autoOpen: false';
		$strOptions .= ', modal: '.($this->blnModal ? 'true' : 'false');
		if ($this->strTitle)
				$strOptions .= ', title: "'.$this->strTitle.'"';
		if ($this->strCssClass)
				$strOptions .= ', dialogClass: "'.$this->strCssClass.'"';
		if (null === $this->strDialogWidth)
				$strOptions .= ", width: 'auto'";
		else if ($this->strDialogWidth)
				$strOptions .= ', width: '. $this->strDialogWidth;
		if (null === $this->strHeight)
				$strOptions .= ", height: 'auto'";
		else if ($this->strHeight)
				$strOptions .= ', height: '. $this->strHeight;
		$strParentId = $this->ParentControl ? $this->ParentControl->ControlId : $this->Form->FormId;
		//move both the dialog and the matte back into the form, to ensure they continue to function
		$strOptions .=	', open: function() {		$j(this).parent().appendTo("#' . $strParentId . '");'.
										'												$j(".ui-widget-overlay").appendTo("#' . $strParentId . '"); }'.
										", close: function() {	qc.pA('" . $this->Form->FormId . "', '" . $this->proxySecondAction->ControlId ."', ".
										"												'QClickEvent', '', '');".
										"												return false; }";

		return sprintf('$j(qc.getW("%s")).dialog({%s}); $j(qc.getW("%s")).dialog("open");', $this->strControlId, $strOptions, $this->strControlId);
		}

	public function ShowDialogBox() {
		$this->lblPromptLabel->Text = $this->strIntroLabel;
		$this->lblFirstAction->Text = $this->strFirstActionLabel;
		$this->lblSecondAction->Text = $this->strSecondActionLabel;
		
		$this->lblBottom->Text =
				"<button class=\"button\" onclick=\"" .
						"qc.pA('" . $this->Form->FormId . "', '" . $this->proxyFirstAction->ControlId . "', 'QClickEvent', '', '');
						\$j(qc.getW('" . $this->strControlId . "')).dialog({close: function() {return false;}});
						\$j(qc.getW('" . $this->strControlId . "')).dialog('close');
						return false;\">" .  $this->lblFirstAction->Text . "</button>" .

				"<button class=\"button\" onclick=\"\$j(qc.getW('" . $this->strControlId . "')).dialog('close'); return false;\">".
						$this->lblSecondAction->Text . "</button>";
						
		parent::ShowDialogBox();
	}

	public abstract function first_action_click();

	public function second_action_click() {
		// The hosting form has the optional ability to 
		// to privode a callback for the cancel click. 		
		
		if ($this->secondActionCallback && strlen($this->secondActionCallback) > 0) {
			$this->objParentObject->{$this->secondActionCallback}();
		}
	}
}
?>