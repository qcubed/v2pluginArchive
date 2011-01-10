<?php 

require('../../../../includes/configuration/prepend.inc.php');

class ExampleForm extends QForm {
	protected $btnRunChromePhp;
	
	protected function Form_Create() {		
		$this->btnRunChromePhp = new QButton($this);
		$this->btnRunChromePhp->Text = 'Run test';
		$this->btnRunChromePhp->AddAction(new QClickEvent(), new QServerAction('btnRunChromePhp_Click'));
	}
	
	// Override Form Event Handlers as Needed
	
	protected function btnRunChromePhp_Click($strFormId, $strControlId, $strParameter) {
		QChromePhp::warn("Start Test");
		
		$db = Person::GetDatabase();
		$db->EnableProfiling();
		Person::QueryArray(
			QQ::NotEqual(QQN::Person()->FirstName,''),
			QQ::LimitInfo(3)
		);
		
		//QChromePhp::OutputDatabaseProfile($db);
		
		QChromePhp::warn("End Test");
	}
}

ExampleForm::Run('ExampleForm','qchromephp.tpl.php');
?>
