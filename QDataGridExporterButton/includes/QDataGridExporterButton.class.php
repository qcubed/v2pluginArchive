<?php
/*
From ...muse...inspiring me..... (Alex)
I thoght you would write a class like this for your plugin:
class DataGridExporterButton extends QButton {
	public __construct ($objParentObject, QDataGrid $objGrid, $objId) {

	 }
}
What I mean here is that the plugin you'd write would be a special kind of button,
that can be rendered separately from the datagrid.
When created, that button would require a pointer to the QDataGrid that has to be exported.
When the button is clicked, the user gets to download the contents of the datagrid as a CSV file

Option attribute to export datagrid :
	blnDownload_all 	ENTIRE_DATAGRID (default) or CURRENT_PAGE.
	Button Text 		test presence of  CVS (default) or XLS to format download as required.
*/

class QDataGridExporterButton extends QButton {

	protected $objForm;

	protected $datasource = array();
	protected $data  = array();
	protected $token ;

	const ENTIRE_DATAGRID = TRUE;
	const CURRENT_PAGE = FALSE;
	// default to all rows
	//public $blnDowload_all = ENTIRE_DATAGRID;

	protected $blnDowload_all = TRUE;


	public function __construct($objParentObject, $dtgobj)
	{
		parent::__construct($objParentObject, $strControlId);


	$this->Text = "download CVS";
	$this->HtmlEntities = false;

	// QButton at this level not supports image, only text
	//		$this->Text = '<img src="' . __VIRTUAL_DIRECTORY__ . __IMAGE_ASSETS__ . '/save_16.png">' . 'Download CVS';

	$this->AddAction(new QClickEvent(), new QServerControlAction($this, 'buttonCVS_clicked'));

	$this->datasource = $dtgobj;
	$this->data = $dtgobj->DataSource;
	}


	public function __set($strName,$mixValue)
	{
		switch ($strName)
		{
			case "blnDowload_all":
				try {
						$this->blnDowload_all = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

			default:
				try {
					parent::__set($strName, $mixValue);
					break;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}


	// Boring advice of hzdierz (thank you very much!) in mind, now my button works as expected.
	function  buttonCVS_clicked ($strFormId, $strControlId, $strParameter)
	{
		// Data bind. What will happen if the grid has got a paginator?

		// this two lines confuse paginator an have all pages.
		//QFirebug::log($this->blnDowload_all);
		if($this->blnDowload_all)
		{
			$this->datasource->ItemsPerPage = 2147483647;
			$this->datasource->PageNumber = 1;
		}
		$this->datasource->DataBind();

		// Get the data
		$data = $this->datasource->DataSource;

		// Get the columns for the header
		$columns = $this->datasource-> GetAllColumns();

		//select exporter format
		$format = "CVS";
		// in text button present xls XLS or any upper lower combination
		if (stripos(($this->Text), 'xls')!==false)
			$format = "XLS";

		switch ($format){			case "XLS":
			{
				// Get table header names
				$theader = array();
				$theader[] = "<table>";
				$theader[] = "<thead>";
				$theader[] = "<tr>";
				foreach($columns as $column){
				// Get the column names but strip off any html tags in case we have got a sort ref.
					$theader[] = sprintf("\n<td>%s</td>" ,strip_tags($column->Name));
				}
				$theader[] = "\n</tr></thead>";
				//QFirebug::log($theader);

				// get the data rows
				$rows = array();
					foreach($data as $item){
					$values = array();
					foreach($columns as $column){
						// Get the values but strip off any html tags in case we have got a button or so.
						$tmp = strip_tags(QDataGrid::ParseHtml($column->Html,$this->datasource,$column,$item));
						// Excel get confused..and loose precision forcing exponential
						// if $column content is numeric, but more than 15 character
						$tmp = $this->excel_patch_num($tmp);
						$values[] = sprintf("\n<td>%s</td>", $tmp);
						}
					$rows[] = $values;
					}
				//QFirebug::log($rows);

				 $Html_open='<html xmlns:o="urn:schemas-microsoft-com:office:office"
					xmlns:x="urn:schemas-microsoft-com:office:excel"
					xmlns="http://www.w3.org/TR/REC-html40">
					<head>';
				$Html_open = str_replace("\t","", $Html_open);
				echo $Html_open;
				// Change header info

				session_cache_limiter('must-revalidate');		// Blaine's fix for SSL & PHP Sessions
				header("Pragma: hack"); // IE chokes on "no cache", so set to something, anything, else.
				$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT";
				header($ExpStr);

				header("Content-type: text/xls");
				header("Content-disposition: xls; filename=" . date("Y-m-d") ."_datagrid_export.xls");
				// excel xml info ( tested with my office 2000 - to have datagrid and active cell a1)

				echo $this->format_XLS_head();
				// Spit out table header
				echo $this->getRowFromArray($theader);
				echo "\n<tbody>";
				// Spit out rows
				foreach($rows as $row){
					echo "\n<tr>";
					echo $this->getRowFromArray($row);
					echo "\n</tr>";
				}
				echo "</tbody>\n</table>\n</body>\n</html>";
				break;
			} //end case download xls

			default:	// CVS
			{				// Get header names
				$header = array();
				foreach($columns as $column){
					// Get the column names but strip off any html tags in case we have got a sort ref.
					$header[] = strip_tags($column->Name);
				}
				//QFirebug::log($header);

				// get the data rows
				$rows = array();
				foreach($data as $item){
					$values = array();
					foreach($columns as $column){
						// Get the values but strip off any html tags in case we have got a button or so.
						// $values[] = strip_tags(QDataGrid::ParseHtml($column->Html,$this->datasource,$column,$item));
						$tmp = strip_tags(QDataGrid::ParseHtml($column->Html,$this->datasource,$column,$item));
						// Excel get confused..and loose precision forcing exponential
						// if $column content is numeric, but more than 15 character
						$tmp = $this->excel_patch_num($tmp);
						$values[] = $tmp;
					}
				$rows[] = $values;
				}
				//QFirebug::log($rows);

				// Change heaser info
				session_cache_limiter('must-revalidate');		// Blaine's fix for SSL & PHP Sessions
				header("Pragma: hack"); // IE chokes on "no cache", so set to something, anything, else.
				$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT";
				header($ExpStr);

				header("Content-type: text/csv");
				header("Content-disposition: csv; filename=" . date("Y-m-d") ."_datagrid_export.csv");

				// Spit out header
				echo $this->getCsvRowFromArray($header);
				echo "\n";
				// Spit out rows
				foreach($rows as $row){
					echo $this->getCsvRowFromArray($row);
					echo "\n";
				}

			} //end default (download cvs)
		} // end switch case
		exit();
	}

	protected function format_XLS_head()
	{
		$result = "\n";
		// space present only to render xml stucture idented
		$result .= '<!--[if gte mso 9]><xml>
				 <x:ExcelWorkbook>
				  <x:ExcelWorksheets>
				   <x:ExcelWorksheet>
				    <x:Name>2010-01-16_datagrid_export</x:Name>
				    <x:WorksheetOptions>
				     <x:Selected/>
				     <x:DisplayGridlines/>
				     <x:Panes>
				      <x:Pane>
				       <x:Number>3</x:Number>
				       <x:ActiveRow>1</x:ActiveRow>
				       <x:ActiveCol>1</x:ActiveCol>
				      </x:Pane>
				     </x:Panes>
				     <x:ProtectContents>False</x:ProtectContents>
				     <x:ProtectObjects>False</x:ProtectObjects>
				     <x:ProtectScenarios>False</x:ProtectScenarios>
				    </x:WorksheetOptions>
				   </x:ExcelWorksheet>
				  </x:ExcelWorksheets>
				  <x:WindowHeight>10230</x:WindowHeight>
				  <x:WindowWidth>18075</x:WindowWidth>
				  <x:WindowTopX>360</x:WindowTopX>
				  <x:WindowTopY>60</x:WindowTopY>
				  <x:ProtectStructure>False</x:ProtectStructure>
				  <x:ProtectWindows>False</x:ProtectWindows>
				 </x:ExcelWorkbook>
				</xml><![endif]-->
				</head>
				<body>';
		// remove tabs
		$result = str_replace("\t","",$result);
		return $result;
	} // end of function format_XLS_head

	// Added by hzdierz - thank's to contribution
	protected function getCsvRowFromArray($arrRow){
		$result = "";
		if(is_array($arrRow)){
			$first=true;
			foreach($arrRow as $item){
				if($first)
				  $result.=$item;
				else
				  $result.=','.$item;
				$first=false;
			}
		}
		return $result;
	}

	// Added by hzdierz (modified by grossini for xls)- thank's to contribution
	protected function getRowFromArray($arrRow){
		$result = "";
		if(is_array($arrRow)){
			//$first=true;
			foreach($arrRow as $item){
				$result.=$item;
			}
		}
		return $result;
	}

	protected function excel_patch_num($tmp){		// Excel get confused..and loose precision forcing exponential
		// if $item is numeric, but more than 15 character
		$test = "";
		if ((is_numeric($tmp)=== true))
		{
			if ((strlen($tmp)>=16))
				$test = "C:".$tmp;
			else $test = $tmp;
		}
		else
			$test=$tmp;
		return $test;	}
} // end of class
?>
