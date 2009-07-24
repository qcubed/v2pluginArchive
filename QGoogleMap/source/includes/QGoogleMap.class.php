<?php

class QGoogleMap extends QControl {

	/**
	 *	Google Map API Key
	 *	@var	string
	 **/
	protected $_MapKey;

	/**
	 *	Default Map Sizes
	 *	@var	int
	 **/
	protected $_MapWidth = '500';
	protected $_MapHeight = '300';

	/**
	 *	Default Map Zoom Level
	 *	@var	int
	 **/
	protected $_MapZoom ='13';

	/**
	 *	Address Array Holder
	 *	@var	array
	 **/
	protected $_AddressArr =  array();

	/**
	 *	Info Window Array holder
	 *	@var	array
	 **/
	protected $_InfoWindowTextArr = array();

	/**
	 *	Map Links
	 *	@var	array
	 **/
	protected $_MapMenu = array();

	/**
	 *	Default Marker Icon Color Scheme
	 *	@var	string
	 **/
	protected $_IconColor = 'PACIFICA';

	/**
	 *	Array of Marker Icon Color Schemes
	 *	@var	array
	 **/
	protected $_IconColorArr = array(
							'PACIFICA'		=>'pacifica',
							'YOSEMITE'		=>'yosemite',
							'MOAB'			=>'moab',
							'GRANITE_PINE'	=>'granitepine',
							'DESERT_SPICE'	=>'desertspice',
							'CABO_SUNSET'	=>'cabosunset',
							'TAHITI_SEA'	=>'tahitisea',
							'POPPY'			=>'poppy',
							'NAUTICA'		=>'nautica',
							'DEEP_JUNGLE'	=>'deepjungle',
							'SLATE'			=>'slate'
							);

	/**
	 *	Default Marker Icon Style
	 *	@var	string
	 **/
	protected $_IconStyle = 'GT_FLAT';

	/**
	 *	Array of Marker Icon Styles
	 *	@var	array
	 **/
	protected $_IconStyleArr = array(
							'FLAG'		=>array(
											'DIR'				=>'flag', 
											'ICON_W'			=>31, 
											'ICON_H'			=>35, 
											'ICON_ANCHR_W'		=>4, 
											'ICON_ANCHR_H'		=>27, 
											'INFO_WIN_ANCHR_W'	=>8, 
											'INFO_WIN_ANCHR_H'	=>3
							),
						
							'GT_FLAT'	=>array(
											'DIR'				=>'traditionalflat', 
											'ICON_W'			=>34, 
											'ICON_H'			=>35, 
											'ICON_ANCHR_W'		=>9, 
											'ICON_ANCHR_H'		=>23, 
											'INFO_WIN_ANCHR_W'	=>19, 
											'INFO_WIN_ANCHR_H'	=>0
							),
						
							'GT_PILLOW'	=>array(
											'DIR'				=>'traditionalpillow', 
											'ICON_W'			=>34, 
											'ICON_H'			=>35, 
											'ICON_ANCHR_W'		=>9, 
											'ICON_ANCHR_H'		=>23, 
											'INFO_WIN_ANCHR_W'	=>19, 
											'INFO_WIN_ANCHR_H'	=>0
							),
						
							'HOUSE'		=>array(
											'DIR'				=>'house', 
											'ICON_W'			=>24, 
											'ICON_H'			=>14, 
											'ICON_ANCHR_W'		=>9, 
											'ICON_ANCHR_H'		=>13, 
											'INFO_WIN_ANCHR_W'	=>9, 
											'INFO_WIN_ANCHR_H'	=>0
							),
						
							'PIN'		=>array(
											'DIR'				=>'pin', 
											'ICON_W'			=>31, 
											'ICON_H'			=>24, 
											'ICON_ANCHR_W'		=>17, 
											'ICON_ANCHR_H'		=>22, 
											'INFO_WIN_ANCHR_W'	=>17, 
											'INFO_WIN_ANCHR_H'	=>0
							),
						
							'PUSH_PIN'	=>array(
											'DIR'				=>'pushpin', 
											'ICON_W'			=>40, 
											'ICON_H'			=>41, 
											'ICON_ANCHR_W'		=>7, 
											'ICON_ANCHR_H'		=>38, 
											'INFO_WIN_ANCHR_W'	=>26, 
											'INFO_WIN_ANCHR_H'	=>1
							),
						
							'STAR'		=>array(
											'DIR'				=>'star', 
											'ICON_W'			=>29, 
											'ICON_H'			=>39, 
											'ICON_ANCHR_W'		=>15, 
											'ICON_ANCHR_H'		=>15, 
											'INFO_WIN_ANCHR_W'	=>19, 
											'INFO_WIN_ANCHR_H'	=>7
							));

	/**
	 *	Default Map Control Style
	 *	@var	string
	 **/
	protected $_MapControl = 'SMALL_PAN_ZOOM';

	/**
	 *	Arrays of Map Control Styles
	 *	@var	array
	 **/
	protected $_MapControlArr = array(
							'NONE',
							'SMALL_PAN_ZOOM',
							'LARGE_PAN_ZOOM',
							'SMALL_ZOOM'
							);

	/**
	 *	Enable/Disable Map Continuous Zooming
	 *	@var	boolean
	 **/
	public $_ContinuousZoom = FALSE;

	/**
	 *
	 *	@var	booleanEnable/Disable Map Double Click Zooming
	 **/
	public $_DoubleClickZoom = FALSE;

	/**
	 *	Enable/Disable Map Scale (Mi/Km)
	 *	@var	boolean
	 **/
	public $_MapScale = TRUE;

	/**
	 *	Enable/Disable Map Inset
	 *	@var	boolean
	 **/
	public $_MapInset = FALSE;

	/**
	 *	Enable/Disable Map Type (Map/Satellite/Hybrid)
	 *	@var	boolean
	 **/
	public $_MapType = FALSE;

	/**
	 *	Index for Address/Info/Menu Arrays
	 *	@var	int
	 **/
	protected $_Index = -1;

	/**
	 * If this control needs to update itself from the $_POST data, the logic to do so
	 * will be performed in this method.
	 */
	public function ParsePostData() {}

	/**
	 *	If this control has validation rules, the logic to do so
	 * will be performed in this method.
	 * @return boolean
	 */
	public function Validate() {return true;}


	/**
	 *	QGoogleMap Constructor
	 *	@return	void
	 **/
	public function __construct($objParentObject, $strControlId = null) {
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) { $objExc->IncrementOffset(); throw $objExc; }
	}

	/////////////////////////
	// Public Properties: SET
	/////////////////////////
	public function __set($strName, $mixValue) {
		$this->blnModified = true;

		switch ($strName) {
			/**
			 *	Set Map Width
			 */
			case 'MapWidth':
				try {
					$this->_MapWidth = QType::Cast($mixValue, QType::Integer);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Set Map Zoom Level
				 */
			case 'MapZoom' :
				try {
					$this->_MapZoom = QType::Cast($mixValue, QType::Integer);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Set Map hHeight
				 */
			case 'MapHeight' :
				try {
					$this->_MapHeight = QType::Cast($mixValue, QType::Integer);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Set Marker Icon Color Scheme
				 * 	options{'PACIFICA','YOSEMITE','MOAB','GRANITE_PINE','DESERT_SPICE',
				 *		'CABO_SUNSET','TAHITI_SEA','POPPY','NAUTICA','SLATE'}
				 * 	default = 'PACIFICA'
				 */
			case 'IconColor' :
				try {
					$this->_IconColor = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Set Marker Icon Style Scheme
				 * 	options{'FLAG','GT_FLAT','GT_PILLOW','HOUSE','PIN','PUSH_PIN','STAR'}
				 * 	default = 'GT_FLAT'
				 */
			case 'IconStyle' :
				try {
					$this->_IconStyle = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Set Map Control Type
				 * 	options{'NONE','SMALL_PAN_ZOOM','LARGE_PAN_ZOOM','SMALL_ZOOM'}
				 * 	default = 'SMALL_PAN_ZOOM'
				 */
			case 'MapControl' :
				try {
					$this->_MapControl = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Enable/Disable Continuous Zoom Default=FALSE
				 */
			case 'ContinuousZoom' :
				try {
					$this->_ContinuousZoom = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Enable/Disable Double-Click Zoom Default=FALSE
				 */
			case 'DoubleClickZoom' :
				try {
					$this->_DoubleClickZoom = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Enable/Disable Map Scale Default=FALSE
				 */
			case 'MapScale' :
				try {
					$this->_MapScale = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Enable/Disable Map Inset Default=FALSE
				 */
			case 'MapInset' :
				try {
					$this->_MapInset = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Enable/Disable Map Type Default=FALSE
				 */
			case 'MapType' :
				try {
					$this->_MapType = QType::Cast($mixValue, QType::Boolean);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				/**
				 *	Set Google Maps API KEY
				 */
			case 'MapKey' :
				try {
					$this->_MapKey = QType::Cast($mixValue, QType::String);
					break;
				} catch (QInvalidCastException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


			default:
				try {
					parent::__set($strName, $mixValue);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				break;
		}
	}

	/**
	 *	Add Address(es)
	 **/
	public function AddAddress($address, $info = null, $str = null) {
		$this->_Index++;
		$this->_AddressArr[$this->_Index] = $address;
		$this->_InfoWindowTextArr[$this->_Index] = $info;
		$this->_MapMenu[$this->_Index] = $str;
	}

	/**
	 *	Generate JS Code
	 **/
	public function BuildJS() {
		$ret = "";

		$cnt_add = count($this->_AddressArr);

		$color = $this->_IconColorArr[$this->_IconColor];
		$dir = $this->_IconStyleArr[$this->_IconStyle]['DIR'];

		$icon_w  = $this->_IconStyleArr[$this->_IconStyle]['ICON_W'];
		$icon_h  = $this->_IconStyleArr[$this->_IconStyle]['ICON_H'];

		$icon_anchr_w  = $this->_IconStyleArr[$this->_IconStyle]['ICON_ANCHR_W'];
		$icon_anchr_h  = $this->_IconStyleArr[$this->_IconStyle]['ICON_ANCHR_H'];

		$info_win_anchr_w  = $this->_IconStyleArr[$this->_IconStyle]['INFO_WIN_ANCHR_W'];
		$info_win_anchr_h  = $this->_IconStyleArr[$this->_IconStyle]['INFO_WIN_ANCHR_H'];

		# start of JS
		$ret .= "<script type=\"text/javascript\">\n";
		$ret .= "var gmarkers = [];\n";
		$ret .= "var address = [];\n";
		$ret .= "var points = [];\n";
			
		$ret .= "if(GBrowserIsCompatible()) { \n";
		$ret .= "	var map = new GMap2(document.getElementById('map_canvas')); \n";

		# handle map continuous zooming
		$ret .= ($this->_ContinuousZoom==TRUE)?"	map.enableContinuousZoom(); \n":"";

		# handle map double click zooming
		$ret .= ($this->_DoubleClickZoom==TRUE)?"	map.enableDoubleClickZoom(); \n":"";

		# handle map controls
		$mapCtrl = "";
		switch ($this->_MapControl) {
			case 'NONE':
				$mapCtrl = "";
				break;

			case 'SMALL_PAN_ZOOM':
				$mapCtrl = "map.addControl(new GSmallMapControl()); \n";
				break;

			case 'LARGE_PAN_ZOOM':
				$mapCtrl = "map.addControl(new GLargeMapControl()); \n";
				break;

			case 'SMALL_ZOOM':
				$mapCtrl = "map.addControl(new GSmallZoomControl()); \n";
				break;
					
			default;
			break;

		} # end switch
		$ret .= "	$mapCtrl";

		# handle map scale (mi/km)
		$ret .= ($this->_MapScale==TRUE)?"	map.addControl(new GScaleControl()); \n":"";

		# handle map type (map/satellite/hybrid)
		$ret .= ($this->_MapType==TRUE)?"	map.addControl(new GMapTypeControl()); \n":"";

		# handle map inset
		$ret .= ($this->_MapInset==TRUE)?"	map.addControl(new GOverviewMapControl()); \n":"";

		$ret .= "	var geocoder = new GClientGeocoder(); \n";
		$ret .= "	var icon = new GIcon(); \n";
		$ret .= "	icon.image = 'http://google.webassist.com/google/markers/$dir/$color.png'; \n";
		$ret .= "	icon.shadow = 'http://google.webassist.com/google/markers/$dir/shadow.png'; \n";
		$ret .= "	icon.iconSize = new GSize($icon_w,$icon_h); \n";
		$ret .= "	icon.shadowSize = new GSize($icon_w,$icon_h); \n";
		$ret .= "	icon.iconAnchor = new GPoint($icon_anchr_w,$icon_anchr_h); \n";
		$ret .= "	icon.infoWindowAnchor = new GPoint($info_win_anchr_w,$info_win_anchr_h); \n";
		$ret .= "	icon.printImage = 'http://google.webassist.com/google/markers/$dir/$color.gif'; \n";
		$ret .= "	icon.mozPrintImage = 'http://google.webassist.com/google/markers/$dir/{$color}_mozprint.png'; \n";
		$ret .= "	icon.printShadow = 'http://google.webassist.com/google/markers/$dir/shadow.gif'; \n";
		$ret .= "	icon.transparent = 'http://google.webassist.com/google/markers/$dir/{$color}_transparent.png'; \n\n";

		# loop set address(es)
		for ($i=$cnt_add-1; $i>=0; $i--) {

			$ret .= "	var address_$i = {\n";
			$ret .= "	  infowindowtext: '".addslashes($this->_InfoWindowTextArr[$i])."',\n";
			$ret .= "	  full: '".addslashes($this->_AddressArr[$i])."'\n";
			$ret .= "	};\n\n";

			$ret .= "	address[$i] = address_$i.infowindowtext;\n\n";

			$ret .= "	geocoder.getLatLng (\n";
			$ret .= "	  address_$i.full,\n";
			$ret .= "	  function(point) {\n";
			$ret .= "		if(point) {\n";
			$ret .= "		  points[$i] = point; \n";
			$ret .= "		  map.setCenter( point, $this->_MapZoom );\n";
			$ret .= "		  var marker = new GMarker( point, icon );\n";
			$ret .= "		  GEvent.addListener(marker, 'click', function() {\n";
			$ret .= "			marker.openInfoWindowHtml( address_$i.infowindowtext );\n";
			$ret .= "		  });\n";

			$ret .= "		  map.addOverlay(marker);\n";

			# show only info window to the first set address
			if ($i===0)
			$ret .= "		  marker.openInfoWindowHtml( address_$i.infowindowtext );\n";

			$ret .= "		  gmarkers[$i] = marker;\n";

			$ret .= "		}\n";
			$ret .= "		else {\n";
			$ret .= "		  map.setCenter(new GLatLng( 37.4419, -122.1419 ), $this->_MapZoom );\n";
			$ret .= "		}\n";
			$ret .= "	  }\n";
			$ret .= "	); // end geocoder.getLatLng\n\n";

		}
		$ret .= "} // end if\n\n";

		$ret .= "function mapMenu(i) {\n";
		$ret .= "   if (gmarkers[i]) {\n";
		$ret .= "	  gmarkers[i].openInfoWindowHtml(address[i]);\n";
		$ret .= "	  map.setCenter( points[i], $this->_MapZoom );\n";
		$ret .= "   } else {\n";
		$ret .= "	  var htstring = address[i];\n";
		$ret .= "	  var stripped = htstring.replace(/(<([^>]+)>)/ig,'');\n";
		$ret .= "	  alert( 'Location not found: ' +  stripped );\n";
		$ret .= "   } /*endif*/\n";
		$ret .= "} /*end function */\n";

		$ret .= "</script>\n";

		return $ret;
	}

	/**
	 *	Generate JS call for Map Key (static) this was supposed to go in the head, but would require more user intervention.
	 *	@return: string (The HTML to call the Google Map API)
	 **/
	public function GetAPIHTML() {
		return "<script type=\"text/javascript\" src=\"http://maps.google.com/maps?file=api&v=2&key={$this->_MapKey}\"></script>\n";
	}

	/**
	 *	Generate Map Menu for Multiple Addresses (static)
	 * @return: string
	 **/
	public function GetMapMenu() {
		$ret = "<ul id=\"map_menu\"> \n";
		$loop = count($this->_AddressArr);
		for ($i=0; $i<$loop; $i++) {
			$ret .=	"<li><a href=\"javascript:void($i);\" onclick=\"javascript:mapMenu($i);\">{$this->_MapMenu[$i]}</a></li>\n";
		}
		$ret .= "</ul> \n";
		return $ret;
	}

	/**
	 *	Generate Map HTML (static)
	 * @return: string (The Google Map)
	 **/
	public function GetControlHtml() {
		return sprintf('%s %s<div id="map_canvas" style="width: %spx; height: %spx;"></div> %s <script type="text/javascript">window.onunload = function() { GUnload(); }</script>',$this->GetAPIHTML(),$this->GetMapMenu(),$this->_MapWidth,$this->_MapHeight,$this->BuildJS());
	}
}
?>