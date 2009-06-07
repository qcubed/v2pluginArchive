<?php
require('../../../../includes/configuration/prepend.inc.php');

class ExampleForm extends QForm {
	//Dock definition
	protected $dckMenuVertical;
	protected $dckMenuHorizontal;

	//Dock Items Vertical
	protected $dckItemHomeV;
	protected $dckItemStudentsV;
	protected $dckItemGroupsV;
	protected $dckItemLevelsV;

	//Dock Items Horizontal
	protected $dckItemHomeH;
	protected $dckItemStudentsH;
	protected $dckItemGroupsH;
	protected $dckItemLevelsH;

	protected function Form_Create() {
		$imageRoot = __PLUGIN_ASSETS__ . "/QJqDock/example/";
		
		$this->dckMenuVertical = new QJqDock($this);
		$this->dckMenuHorizontal = new QJqDock($this);
	
		$this->dckMenuVertical->Align = 'bottom';
		$this->dckMenuVertical->Labels = 'bc'; // bottom center
		$this->dckMenuVertical->Size = 48;
		$this->dckMenuVertical->Distance = 60;
		$this->dckMenuVertical->Coefficient = 1.5;
	
		$this->dckMenuHorizontal->Align = 'left';
		$this->dckMenuHorizontal->Labels = 'none'; // no labels on the vertical one
		$this->dckMenuHorizontal->Size = 32;
		$this->dckMenuHorizontal->Distance = 40;
		$this->dckMenuHorizontal->Coefficient = 2;
	
		// Vertical Items
		$this->dckItemHomeV = new QJqDockItem($this->dckMenuVertical);
		$this->dckItemHomeV->Link = '#';
		$this->dckItemHomeV->ImageSource = $imageRoot . 'home.png';
		$this->dckItemHomeV->Title = QApplication::Translate('Home');
	
		$this->dckItemStudentsV = new QJqDockItem($this->dckMenuVertical);
		$this->dckItemStudentsV->Link = '#';
		$this->dckItemStudentsV->ImageSource =  $imageRoot . 'student.png';
		$this->dckItemStudentsV->Title = QApplication::Translate('Students');
	
		$this->dckItemGroupsV = new QJqDockItem($this->dckMenuVertical);
		$this->dckItemGroupsV->Link = '#';
		$this->dckItemGroupsV->ImageSource = $imageRoot . 'students.png';
		$this->dckItemGroupsV->Title = QApplication::Translate('Groups');
	
		$this->dckItemLevelsV = new QJqDockItem($this->dckMenuVertical);
		$this->dckItemLevelsV->Link = '#';
		$this->dckItemLevelsV->ImageSource = $imageRoot . 'level.png"';
		$this->dckItemLevelsV->Title = QApplication::Translate('Levels');
	
		//Horizontal Items
		$this->dckItemHomeH = new QJqDockItem($this->dckMenuHorizontal);
		$this->dckItemHomeH->Link = '#';
		$this->dckItemHomeH->ImageSource = $imageRoot . 'home.png';
		$this->dckItemHomeH->Title = QApplication::Translate('Home');
	
		$this->dckItemStudentsH = new QJqDockItem($this->dckMenuHorizontal);
		$this->dckItemStudentsH->Link = '#';
		$this->dckItemStudentsH->ImageSource = $imageRoot . 'student.png';
		$this->dckItemStudentsH->Title = QApplication::Translate('Students');
	
		$this->dckItemGroupsH = new QJqDockItem($this->dckMenuHorizontal);
		$this->dckItemGroupsH->Link = '#';
		$this->dckItemGroupsH->ImageSource = $imageRoot . 'students.png';
		$this->dckItemGroupsH->Title = QApplication::Translate('Groups');
	
		$this->dckItemLevelsH = new QJqDockItem($this->dckMenuHorizontal);
		$this->dckItemLevelsH->Link = '#';
		$this->dckItemLevelsH->ImageSource = $imageRoot . 'level.png"';
		$this->dckItemLevelsH->Title = QApplication::Translate('Levels');
	}
}

ExampleForm::Run('ExampleForm','qjqdock.tpl.php');