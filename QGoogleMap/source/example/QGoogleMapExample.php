<?php
require('../../../../includes/configuration/prepend.inc.php');

class QGoogleMapExample extends QForm {
	protected $objMap;

	protected function Form_Create() {
		$this->objMap = new QGoogleMap($this);
		$this->objMap->MapKey = 'ABQIAAAAHLN_hjOW8DzvIseWe7clKhS1h7_3TK2KmPQk-a69Ag3zxXvAWxRKcaA5KSfv2wsqTuIxEpeczwEV2Q';
		$this->objMap->IconColor = 'NAUTICA';
		$this->objMap->IconStyle = 'HOUSE';
		$this->objMap->AddAddress("1600 Pennsylvania Avenue NW Washington, DC 20500", "This is the White House, where America's president lives.", "The White House");
		$this->objMap->AddAddress("E Capitol St NE & 1st St NE 20001 ", "This is the Capitol Building where laws are made and money is wasted.", "The Capitol Building");
	}
}
QGoogleMapExample::Run('QGoogleMapExample', 'QGoogleMapExample.tpl.php');
?> 