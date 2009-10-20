<?php

 require('../../../../includes/configuration/prepend.inc.php');

 class TimeSeries extends QForm {

		// flot graph and flot series variables
 		public $flotReport;
		public $juanSeries;
		public $gonzaloSeries;
		public $melissaSeries;
		public $generatedSeries;
		public $trendSeries;
		
		public $dtgFlotDataGrid;


 		protected function Form_Create() {
	
		//example data in seriealized form
	    $DataSet = unserialize('a:8:{s:11:"JUAN CARLOS";a:12:{s:11:"Jan-07-2008";i:8;s:11:"Jan-08-2008";i:1;s:11:"Jan-09-2008";i:4;s:11:"Jan-10-2008";i:5;s:11:"Jan-11-2008";i:5;s:11:"Jan-14-2008";i:7;s:11:"Jan-15-2008";i:1;s:11:"Jan-16-2008";i:4;s:11:"Jan-21-2008";i:5;s:11:"Jan-22-2008";i:2;s:11:"Jan-23-2008";i:7;s:11:"Jan-24-2008";i:2;}s:7:"MELISSA";a:11:{s:11:"Jan-07-2008";i:3;s:11:"Jan-08-2008";i:8;s:11:"Jan-09-2008";i:1;s:11:"Jan-10-2008";i:6;s:11:"Jan-11-2008";i:6;s:11:"Jan-14-2008";i:1;s:11:"Jan-15-2008";i:7;s:11:"Jan-16-2008";i:5;s:11:"Jan-21-2008";i:2;s:11:"Jan-23-2008";i:5;s:11:"Jan-24-2008";i:3;}s:4:"ROEL";a:12:{s:11:"Jan-07-2008";i:4;s:11:"Jan-08-2008";i:3;s:11:"Jan-09-2008";i:5;s:11:"Jan-10-2008";i:8;s:11:"Jan-11-2008";i:7;s:11:"Jan-14-2008";i:4;s:11:"Jan-15-2008";i:6;s:11:"Jan-16-2008";i:6;s:11:"Jan-21-2008";i:1;s:11:"Jan-22-2008";i:1;s:11:"Jan-23-2008";i:1;s:11:"Jan-24-2008";i:7;}s:4:"HUGO";a:10:{s:11:"Jan-07-2008";i:2;s:11:"Jan-08-2008";i:6;s:11:"Jan-09-2008";i:3;s:11:"Jan-10-2008";i:2;s:11:"Jan-14-2008";i:8;s:11:"Jan-15-2008";i:8;s:11:"Jan-16-2008";i:2;s:11:"Jan-21-2008";i:3;s:11:"Jan-22-2008";i:6;s:11:"Jan-24-2008";i:1;}s:4:"ENZO";a:12:{s:11:"Jan-07-2008";i:5;s:11:"Jan-08-2008";i:2;s:11:"Jan-09-2008";i:7;s:11:"Jan-10-2008";i:7;s:11:"Jan-11-2008";i:4;s:11:"Jan-14-2008";i:2;s:11:"Jan-15-2008";i:3;s:11:"Jan-16-2008";i:7;s:11:"Jan-21-2008";i:7;s:11:"Jan-22-2008";i:4;s:11:"Jan-23-2008";i:6;s:11:"Jan-24-2008";i:8;}s:7:"GONZALO";a:12:{s:11:"Jan-07-2008";i:6;s:11:"Jan-08-2008";i:5;s:11:"Jan-09-2008";i:2;s:11:"Jan-10-2008";i:3;s:11:"Jan-11-2008";i:2;s:11:"Jan-14-2008";i:3;s:11:"Jan-15-2008";i:5;s:11:"Jan-16-2008";i:3;s:11:"Jan-21-2008";i:6;s:11:"Jan-22-2008";i:5;s:11:"Jan-23-2008";i:3;s:11:"Jan-24-2008";i:5;}s:7:"KENNETH";a:10:{s:11:"Jan-07-2008";i:5;s:11:"Jan-08-2008";i:7;s:11:"Jan-09-2008";i:8;s:11:"Jan-10-2008";i:1;s:11:"Jan-11-2008";i:1;s:11:"Jan-14-2008";i:5;s:11:"Jan-15-2008";i:4;s:11:"Jan-16-2008";i:3;s:11:"Jan-23-2008";i:4;s:11:"Jan-24-2008";i:6;}s:6:"JEFFRY";a:12:{s:11:"Jan-07-2008";i:7;s:11:"Jan-08-2008";i:4;s:11:"Jan-09-2008";i:6;s:11:"Jan-10-2008";i:4;s:11:"Jan-11-2008";i:3;s:11:"Jan-14-2008";i:6;s:11:"Jan-15-2008";i:2;s:11:"Jan-16-2008";i:8;s:11:"Jan-21-2008";i:4;s:11:"Jan-22-2008";i:3;s:11:"Jan-23-2008";i:2;s:11:"Jan-24-2008";i:4;}}');

		// Sample Data in array form
		$juanData= array (
		    'Jan-07-2008' => 8,
		    'Jan-08-2008' => 1,
		    'Jan-09-2008' => 4,
		    'Jan-10-2008' => 5,
		    'Jan-11-2008' => 5,
		    'Jan-14-2008' => 7,
		    'Jan-15-2008' => 1,
		    'Jan-16-2008' => 4,
		    'Jan-21-2008' => 5,
		    'Jan-22-2008' => 2,
		    'Jan-23-2008' => 7,
		    'Jan-24-2008' => 2,
		);
		
		// note this data set uses timestamps instead of date strings
		$melissaData= array (
		    1199692800 => 3,
		    1199779200 => 8,
		    1199865600 => 1,
			1199952000 => 6,
			1200038400 => 6,
			1200297600 => 1,
			1200384000 => 7,
			1200470400 => 5,
			1200902400 => 2,
			1200988800 => 5,
			1201075200 => 3,
			1201161600 => 3
		
		);
		// set graph options
		$this->flotReport = new QFlot($this);
     	$this->flotReport->DisplayVariables = true;
        $this->flotReport->VariablesTitle = "Players";
        $this->flotReport->XTimeSeries = true;
		$this->flotReport->YMin = 0;
        $this->flotReport->YTickDecimals = 0;
        $this->flotReport->Width = 780;

		// assign a complete array of data, and use default graph options
		$this->juanSeries = new QFlotSeries('Juan Carlos');
		$this->juanSeries->DataSet = $juanData;
		$this->flotReport->AddSeries($this->juanSeries);
		
		// assign a complete array of data, and set some additional graph items
		$this->gonzaloSeries = new QFlotSeries('Gonzalo');
        $this->gonzaloSeries->Lines = true;
        $this->gonzaloSeries->LinesFill = true;
		$this->gonzaloSeries->Points = true;
		$this->gonzaloSeries->DataSet = $DataSet['GONZALO'];
		$this->flotReport->AddSeries($this->gonzaloSeries);
		
		// assign an array of data, notice that this data has 
		// timestamps instead of date strings
		$this->melissaSeries = new QFlotSeries('Melissa');
        $this->melissaSeries->Lines = true;
		$this->melissaSeries->DataSet = $melissaData;
		$this->melissaSeries->XUseTimeStamps = true;
		$this->flotReport->AddSeries($this->melissaSeries);
		
		// show how to add data points individually
		$this->generatedSeries = new QFlotSeries('generated');
        $this->generatedSeries->Lines = true;
		$this->generatedSeries->Points = true;
		$this->generatedSeries->XUseTimeStamps = true;
		
		// base x values on series for melissa. note: I could access it from the 
		// variable $melissaData above, but it can also be grabbed from the series
		// object 
		$i=0;
		foreach(array_keys($this->melissaSeries->DataSet) as $time) {
			// add each point, with some randomness
			$y = $i+rand(-1,1);
			$this->generatedSeries->AddDataPoint($time, $y);
			$i++;
		}
		$this->flotReport->AddSeries($this->generatedSeries);
		
		// show how to add a trend line ( least squares regression )
		// you need to give the makeTrend function the number of secons you want
		// the trend to extend
		$this->trendSeries = $this->flotReport->MakeTrend($this->generatedSeries);
		//Chek
		if($this->trendSeries)
			$this->flotReport->AddSeries($this->trendSeries);
		
		
		// show how to create a datagrid from the graph data
		$this->dtgFlotDataGrid = $this->flotReport->CreateDataGrid($this);
		
 	}
 }

 TimeSeries::Run("TimeSeries");
 ?>
