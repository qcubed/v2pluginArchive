<?php
/*
From to muse  inspiring me..... (Alex
I thoght you would write a class like this for your plugin:
class DataGridExporter extens QButton {
	  public __construct ($objParentObject, QDataGrid $objGrid, $objId) {
		....
	 }
}
What I mean here is that the plugin you'd write would be a special kind of button,
that can be rendered separately from the datagrid.
When created, that button would require a pointer to the QDataGrid that has to be exported.
When the button is clicked, the user gets to download the contents of the datagrid as a CSV file.
*/



class QDataGridExporter extends QButton {

	protected $objForm;

	protected $datasource = array();
	protected $data  = array();
	protected $token ;

	public function __construct($objParentObject,  $dtgobj) {
		  parent::__construct($objParentObject, $strControlId);


	$this->Text = "download CVS";
	$this->HtmlEntities = false;

	// QButton at this level not supports image, only text
	//		$this->Text = '<img src="' . __VIRTUAL_DIRECTORY__ . __IMAGE_ASSETS__ . '/save_16.png">' . 'Download CVS';

	$this->AddAction(new QClickEvent(), new QServerControlAction($this, 'buttonCVS_clicked'));

	// now get data to export
	// print_r($dtgobj);


	$this->datasource = $dtgobj;
	$this->data = $dtgobj->DataSource;
	}

    // Boring advice of hzdierz (thank you very much!) in mind, now my button works as expected.
    function  buttonCVS_clicked ($strFormId, $strControlId, $strParameter)
    {
        // Dta bind. What will happen if the grid has got a paginator?

        // this two lines confuse paginator an have all pages.
        $this->datasource->ItemsPerPage = 2147483647;
        $this->datasource->PageNumber = 1;

        $this->datasource->DataBind();

        // Get the data
        $data = $this->datasource->DataSource;

        // Get the columns for the header
        $columns = $this->datasource-> GetAllColumns();

        // Get header names
        $header = array();
        foreach($columns as $column){
            // Get the column names but strip off any html tags in case we have got a sort ref.
            $header[] = strip_tags($column->Name);
        }
        //QFirebug::log($header);
        // get thge data rows
        $rows = array();
        foreach($data as $item){
            $values = array();
            foreach($columns as $column){
                // Get the values but strip off any html tags in case we have got a button or so.
                $values[] = strip_tags(QDataGrid::ParseHtml($column->Html,$this->datasource,$column,$item));

            }
            $rows[] = $values;
        }
        //QFirebug::log($rows);

        // Change heaser info
        session_cache_limiter('must-revalidate');        // Blaine's fix for SSL & PHP Sessions
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
        exit();

    }
	// Added by hzdierz - thank's to contribution
    protected function getCsvRowFromArray($arrRow){
        $result = "";
        if(is_array($arrRow)){
            $first=true;

            foreach($arrRow as $item){
                if($first) $result.=$item;
                else $result.=','.$item;
                $first=false;
            }

        }

        return $result;
    }


/*****************************
*  get column step...
****************************
//changed  public from private $objColumnArray in QdataGridBase.class line 247
//		// MISC
//			public $objColumnArray;
//
//	and also optionally changed public from private for function GeHeaderRowHtml()) to see it here
//			QFirebug::log( $this->datasource->GetHeaderRowHtml());

//this works !!!
		QFirebug::log($this->GetCSVHeader());

*/

/*****************************
*	get data step...
****************************
//	I need here help on  how can I get data row
//	(all row as resulted from filter - not only that in page)
//	from passed dtg object

// action done to study
// change public from private GetControlHtml())


// added to avoid error Control cannot be rendered until RenderBegin() has been called on the form.
// $this->objForm->RenderBegin(false);

//	result log display the html table (but only row in that page!!!)
//	 ******** it may be better investigate QPaginatedControl and DataBind()?????
//	but this give error -  This control has already been rendered: c5

		QFirebug::log($this->datasource->GetControlHtml());
		}

*/

}
?>
