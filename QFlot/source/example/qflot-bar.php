 <?php

 require('../../../../includes/configuration/prepend.inc.php');

 class BarForm extends QForm {

 		public $flotReport;


 		protected function Form_Create() {

            $DataSet = unserialize('a:6:{s:8:"Hardware";a:1:{i:1;d:84.2592592592592524169958778657019138336181640625;}s:8:"Software";a:1:{i:2;d:87.1794871794871824022266082465648651123046875;}s:21:"Access & Subscription";a:1:{i:3;d:83.64197530864197460687137208878993988037109375;}s:5:"Other";a:1:{i:4;d:85.185185185185190448464709334075450897216796875;}s:15:"Online Training";a:1:{i:5;d:81.6666666666666714036182384006679058074951171875;}s:14:"Cross-Training";a:1:{i:6;d:85.185185185185190448464709334075450897216796875;}}');
			
		     if(isset($DataSet)){

            	$this->flotReport = new QFlot($this);	
      			$this->flotReport->DisplayVariables = true;
		        $this->flotReport->VariablesTitle = "Startup Types";
				$this->flotReport->YMin = 0;
				$this->flotReport->YMax = 100;
		        $this->flotReport->YTickDecimals = 0;
		        $this->flotReport->XTickDecimals = 0;
		        $this->flotReport->Width = 780;
		        $this->flotReport->XMax = count($DataSet) + 2;
		        $this->flotReport->Name = "Completed Checklist Items by type <br/> Performance Team";
            	
      			
		        foreach($DataSet as $Serie => $Data){
		        	$tempSerie = new QFlotSeries($Serie);
	        		$tempSerie->Bars = true;
					$tempSerie->DataSet = $Data;
					$this->flotReport->AddSeries($tempSerie);
		        }	
		     }		     
 		}
 }

 BarForm::Run("BarForm");
 ?>
