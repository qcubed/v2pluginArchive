<?php

/**
 * @property string DownloadFormat
 * @property string DownloadMode
 * @property string AllowableTags
 * @property int[] ColumnIndexArray
 */
class QDataGridExporterButton extends QButton {
	private $dtgSourceDatagrid = array();
	private $strAllowableTags = '';
	private $intColumnIndexArray = null;

	const DOWNLOAD_ENTIRE_DATAGRID = 1;
	const DOWNLOAD_CURRENT_PAGE = 2;
	private $intDownloadMode;
	
	const EXPORT_AS_XLS = 1;
	const EXPORT_AS_CSV = 2;
	private $intExportFormat;

	public function __construct($objParentObject, QPaginatedControl $dtgobj, $strControlId = null)	{
		parent::__construct($objParentObject, $strControlId);

		$this->Text = "Download";
		$this->intExportFormat = self::EXPORT_AS_CSV;
		$this->intDownloadMode = self::DOWNLOAD_ENTIRE_DATAGRID;
	
		$this->AddAction(new QClickEvent(), new QServerControlAction($this, 'btnExport_clicked'));
	
		$this->dtgSourceDatagrid = $dtgobj;
	}


	public function __get($strName)	{
		switch ($strName) {
			case "AllowableTags": return $this->strAllowableTags;
			case "DownloadFormat": return $this->intExportFormat;
			case "DownloadMode": return $this->intDownloadMode;
			case "ColumnIndexArray": return $this->intColumnIndexArray;
			default:
				try {
					return parent::__get($strName);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}
	
	public function __set($strName,$mixValue)	{
		switch ($strName) {
			case "AllowableTags":
				try {
						$this->strAllowableTags = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

			case "DownloadFormat":
				try {
						$this->intExportFormat = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

			case "DownloadMode":
				try {
						$this->intDownloadMode = QType::Cast($mixValue, QType::Integer);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

			case "ColumnIndexArray":
				try {
						$this->intColumnIndexArray = QType::Cast($mixValue, QType::ArrayType);
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

	private function streamCSV() {
		$data = $this->dtgSourceDatagrid->DataSource;
		$columns = $this->GetColumns();

		// Get header names
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
				// $values[] = strip_tags(QDataGrid::ParseHtml($column->Html,$this->dtgSourceDatagrid,$column,$item));
				$tmp = strip_tags(QDataGrid::ParseHtml($column->Html,$this->dtgSourceDatagrid,$column,$item));
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
	}

	protected function getColumns() {
		$allColumns = $this->dtgSourceDatagrid->GetAllColumns();
		if (is_null($this->intColumnIndexArray)) {
			return $allColumns;
		}
		$columns = array();
		$c = count($allColumns);
		foreach ($this->intColumnIndexArray as $idx) {
			if ($idx < 0 || $idx >= $c)
				continue;
			$columns[] = $allColumns[$idx];
		}
		return $columns;
	}
	
	private function streamXLS() {
		$data = $this->dtgSourceDatagrid->DataSource;
		$columns = $this->GetColumns();
		
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
					$tmp = strip_tags(QDataGrid::ParseHtml($column->Html,$this->dtgSourceDatagrid,$column,$item), $this->strAllowableTags);
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

			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=";
			echo QApplication::$EncodingType;
			echo "\" />\n";

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
	}


	public function btnExport_clicked ($strFormId, $strControlId, $strParameter) {
		// Data bind. What will happen if the grid has got a paginator?

		// this two lines confuse paginator an have all pages.
		//QFirebug::log($this->intDownloadMode);
		if($this->intDownloadMode == self::DOWNLOAD_ENTIRE_DATAGRID) {
			if ($this->dtgSourceDatagrid->Paginator) {
				$this->dtgSourceDatagrid->ItemsPerPage = 2147483647;
				$this->dtgSourceDatagrid->PageNumber = 1;
			}
		}
		$this->dtgSourceDatagrid->DataBind();

		switch ($this->intExportFormat) {
			case self::EXPORT_AS_CSV:
				$this->streamCSV();
				break;
			case self::EXPORT_AS_XLS: 
				$this->streamXLS();
				break;
			default: 
				throw new QCallerException("Invalid export format: " . $this->intExportFormat);
		}
		
		exit();
	}

	private function format_XLS_head() {
		$result = "\n";
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
	} 

	private function getCsvRowFromArray($arrRow){
		$result = "";
		if(is_array($arrRow)){
			$first = true;
			foreach($arrRow as $item){
				if($first) {
				  $result .= $item;
				} else {
				  $result .= ','.$item;
				}
				$first = false;
			}
		}
		return $result;
	}

	private function getRowFromArray($arrRow){
		$result = "";
		if(is_array($arrRow)){
			foreach($arrRow as $item){
				$result .= $item;
			}
		}
		return $result;
	}
	
	private function excel_patch_num($tmp){
		
		// Excel get confused..and loose precision forcing exponential
		// if $item is numeric, but more than 15 character
		$test = "";
		if ((is_numeric($tmp)=== true)) {
			if ((strlen($tmp)>=16)) {
				$test = "C:" . $tmp;
			} else {
				$test = $tmp;
			}
		}
		else {
			$test=$tmp;
		}
		return $test;
	
	}
} 
?>
