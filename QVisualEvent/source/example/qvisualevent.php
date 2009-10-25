<?php
	require('../../../../includes/configuration/prepend.inc.php');

	// Define the Qform with all our Qcontrols
	class ExamplesForm extends QForm {
		// Local declarations of our Qcontrols
		protected $txtInputA;
		protected $txtInputB;
		protected $btnButtonA;
		protected $btnButtonB;
		protected $btnButtonC;
		
		//QVisualEvent property object
		protected $objQVE;

		// Initialize our Controls during the Form Creation process
		protected function Form_Create() {
			// Define the Label
			$this->txtInputA = new QTextBox($this);
			$this->txtInputA->Name = 'Input A';
			$this->txtInputA->CssClass = 'inputA';

			$this->txtInputB = new QTextBox($this);
			$this->txtInputB->Name = 'Input B';
			$this->txtInputB->CssClass = 'inputB';			
			
			// Define the Button
			$this->btnButtonA = new QButton($this);
			$this->btnButtonA->Text = 'Button A';
			$this->btnButtonA->CssClass = 'buttonA';			


			$this->btnButtonB = new QButton($this);
			$this->btnButtonB->Text = 'Button B';
			$this->btnButtonB->CssClass = 'buttonB';
			
			$this->btnButtonC = new QButton($this);
			$this->btnButtonC->Text = 'Click me to see Visual Events';	
			$this->btnButtonC->AddAction(new QClickEvent(), new QAjaxAction('btnButtonC_Click'));		
			
			$this->btnButtonB->AddJavascriptFile(__JQUERY_BASE__);
			QApplication::ExecuteJavaScript('$(".inputA").bind("click",function(e){var str = "( " + e.pageX + ", " + e.pageY + " )";  alert("Input A Click happened! " + str);});');
			QApplication::ExecuteJavaScript('$(".inputB").bind("keyup",function(e){alert("Key Typed:" + e.keyCode);});');
			QApplication::ExecuteJavaScript('$(".buttonA").bind("click",function(e){alert("Button A was clicked");});');
			QApplication::ExecuteJavaScript('$(".buttonB").bind("click",function(e){alert("Button B was clicked");});');

			$this->objQVE = new QVisualEvent($this);
		}
							
		protected function btnButtonC_Click($strFormId, $strControlId, $strParameter) {	
			//Call to render Visual Events
			$this->objQVE->Init();
		}
	}

	// Run the Form we have defined
	ExamplesForm::Run('ExamplesForm');
?>
