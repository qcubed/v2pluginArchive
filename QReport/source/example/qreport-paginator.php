<?php
 
	require('../../../../includes/configuration/prepend.inc.php');
 
		class ExampleForm extends QForm {
 	
 		protected $rptVendor;

		protected $rptVendorHeaderStyle;
		protected $rptVendorNameStyle;
		protected $rptVendorFooterStyle;
 	
 		protected function Form_Create() {

			$this->rptVendor = new QReport($this);
			$this->rptVendor->BorderColor = "#CCC";
			$this->rptVendor->BorderWidth = 1;
			$this->rptVendor->BorderStyle = QBorderStyle::Solid;
			
			$this->rptVendor->Paginator = new QPaginator($this->rptVendor);
			$this->rptVendor->TotalItemCount = 75;
			$this->rptVendor->ItemsPerPage = 10;

			/**
			 * Report Styles
			 */
			$this->rptVendorHeaderStyle = new QReportCellStyle();
			$this->rptVendorHeaderStyle->BackColor = '#444';
			$this->rptVendorHeaderStyle->ForeColor = '#FFF';

			$this->rptVendorNameStyle = new QReportCellStyle();
			$this->rptVendorNameStyle->BackColor = '#DDD';

			$this->rptVendorFooterStyle = new QReportCellStyle();
			$this->rptVendorFooterStyle->BorderColor = '#000';
			$this->rptVendorFooterStyle->BorderStyle = QBorderStyle::Double;
			$this->rptVendorFooterStyle->BackColor = '#444';
			$this->rptVendorFooterStyle->ForeColor = '#FFF';
			
			$this->rptVendor->SetDataBinder('DataBind_Load');
			
			$this->rptVendor->PushHeaderRow(
										new QReportCell("Name",$this->rptVendorHeaderStyle),
										new QReportCell("Vendor Id",$this->rptVendorHeaderStyle),
										new QReportCell("Amount#1",$this->rptVendorHeaderStyle),
										new QReportCell("Amount#2",$this->rptVendorHeaderStyle),
										new QReportCell("Amount#4",$this->rptVendorHeaderStyle),
										new QReportCell("Amount#5",$this->rptVendorHeaderStyle)
									);
			
 		}
 		
 		public function DataBind_Load(){
 			
			$intOffset = ($this->rptVendor->PageNumber - 1) * $this->rptVendor->ItemsPerPage;						

			for($i=$intOffset;$i<=($intOffset + $this->rptVendor->ItemsPerPage);$i++){
				$objCellArray = array();
				for($j=1;$j<=6;$j++){
				  if($j==1)		
					array_push($objCellArray, new QReportCell($i . "-" . $j,$this->rptVendorNameStyle));
				  else
				  	array_push($objCellArray, new QReportCell($i . "-" . $j));									
				}
			$this->rptVendor->PushRow($objCellArray);
			} 				
 		}
 }
 
 ExampleForm::Run('ExampleForm',dirname(__FILE__) . '/qreport-paginator.tpl.php');
 ?> 