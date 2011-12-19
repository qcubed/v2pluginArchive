<?php

//require('../../../../includes/configuration/prepend.inc.php');

require('../../../../qcubed.inc.php');


class QChromePhpExample extends QForm {

    protected $btnServer;
    protected $btnAjax;
    protected $btnDB;

    public function Form_Create() {
        $this->btnDB = new QButton($this);
        $this->btnDB->Text = "Test DB Profiling";
        $this->btnDB->AddAction(new QClickEvent(), new QAjaxAction('btnServerDBProfile_Action'));
        
        $this->btnAjax = new QButton($this);
        $this->btnAjax->Text = "Ajax";
        $this->btnAjax->AddAction(new QClickEvent(), new QAjaxAction('btnAjax_Action'));
        
        $this->btnServer = new QButton($this);
        $this->btnServer->Text = "Server";
        $this->btnServer->AddAction(new QClickEvent(), new QServerAction('btnServer_Action'));
    }
    
    
    protected function btnAjax_Action(){
        QChromePhp::log("Start Ajax Test");
		
        QChromePhp::error("This is an error");
        QChromePhp::warn("This is a warning");
        
        QChromePhp::log("Ajax Test Finished");
    }
    
    protected function btnServer_Action(){
        QChromePhp::log("Start Server Test");
        
        QChromePhp::error("This is an error");
        QChromePhp::warn("This is a warning");
        
        QChromePhp::log("Server Test Finished");
    }
    
    
    protected function btnServerDBProfile_Action(){
        QChromePhp::log("Start DB Profile Test");
        
        $db = Person::GetDatabase();
        $db->EnableProfiling();
        Person::QueryArray(
                QQ::NotEqual(QQN::Person()->FirstName,'Helge'),
                QQ::LimitInfo(3)
        );

	QChromePhp::OutputDatabaseProfile($db);
        
        QChromePhp::log("DB Profile Test Finished");
    }


}

QChromePhpExample::Run('QChromePhpExample');
?>