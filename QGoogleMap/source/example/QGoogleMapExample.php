<?php
require('../../../../includes/configuration/prepend.inc.php');

class QGoogleMapExample extends QForm {
	protected $objMap;

	protected function Form_Create() {
		$this->objMap = new QGoogleMap($this);
		// This needs to be a unique key for each domain. Get yours @ http://code.google.com/apis/maps/signup.html
		$this->objMap->MapKey = 'ABQIAAAAD5ed9hDt-Mvktac_TQQUXBS6ZariomNoMgfABIFXuTLicRrUjRRQ-OHO-iLVRErsZOeNfWXJcCao-g';
		$this->objMap->IconColor = 'NAUTICA';
		$this->objMap->IconStyle = 'HOUSE';
		$this->objMap->MapType = TRUE;
		$this->objMap->ContinuousZoom = TRUE;
		$this->objMap->MapInset = TRUE;
		$this->objMap->AddAddress("1600 Pennsylvania Avenue NW Washington, DC 20500", "This is the White House, where America's president lives.", "The White House");
		$this->objMap->AddAddress("E Capitol St NE & 1st St NE 20001 ", "This is the Capitol Building where laws are made and money is wasted.", "The Capitol Building");
	}
}
QGoogleMapExample::Run('QGoogleMapExample', 'QGoogleMapExample.tpl.php');
?> 