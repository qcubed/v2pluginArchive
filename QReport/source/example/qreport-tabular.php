<?php

require('../../../../includes/configuration/prepend.inc.php');

class ExampleForm extends QForm {
		protected $rptVendor;

		protected $rptVendorHeaderStyle;
		protected $rptVendorNameStyle;
		protected $rptVendorFooterStyle;

		protected $calBeginDate;
		protected $calEndDate;

		protected function Form_Create() {
			$this->calBeginDate = new QDateTimePicker($this);
			$this->calBeginDate->Name = 'From';
			$this->calBeginDate->DateTime = new QDateTime("Now");
			$this->calBeginDate->DateTimePickerType = QDateTimePickerType::Date;

			$this->calEndDate = new QDateTimePicker($this);
			$this->calEndDate->Name = 'To';
			$this->calEndDate->DateTime = new QDateTime("Now");
			$this->calEndDate->DateTimePickerType = QDateTimePickerType::Date;

			/**
			 * Define Report
			 */
			$this->rptVendor = new QReport($this);
			$this->rptVendor->BorderColor = "#CCC";
			$this->rptVendor->BorderWidth = 1;
			$this->rptVendor->BorderStyle = QBorderStyle::Solid;

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

			/**
			 * Bind the Data
			 */
			$this->rptVendor->SetDataBinder('rptVendor_Bind');
		}

		public function rptVendor_Bind() {
			$this->rptVendor->PushRow(
										new QReportCell("Name",$this->rptVendorHeaderStyle),
										new QReportCell("Vendor Id",$this->rptVendorHeaderStyle),
										new QReportCell("Amount",$this->rptVendorHeaderStyle)
									);

			/**
			 * For testing purposes, I threw in a CSV file of data.  See 
			 * below for an example of using Qcodo ORM to do a database 
			 * query.  This is just dummy data that doesn't mean 
			 * anything.
			 */
			$count = $total = 0;
			$fp = fopen("testdata.csv","r");
			while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
				$this->rptVendor->PushRow(	
										new QReportCell($data[2],$this->rptVendorNameStyle),
										new QReportCell($data[0]),
										new QReportCell($data[1])
									);
				$total += $data[1];
				$count++;
			}
			fclose($fp);

			$this->rptVendor->PushRow(
										new QReportCell("Average",$this->rptVendorFooterStyle,2),
										new QReportCell(($total / $count),$this->rptVendorFooterStyle) // Average
									);
			/**
			 * Qcodo ORM Database Query with QReport
			$objVendors = Vendor::LoadAll($objClauses);
			foreach($objVendors as $objVendor) {
				$this->rptVendor->PushRow(	
										new QReportCell($objVendor->Name,$this->rptVendorNameStyle),
										new QReportCell($objVendor->VendorId),
										new QReportCell($objVendor->AccountId)
									);
			}

			$intAverage = Vendor::QuerySingle(
				QQ::All(),
				QQ::Clause(
					QQ::GroupBy(QQN::Vendor()->VendorId),
					QQ::Average(QQN::Vendor()->AccountId,'vendor_average')
				));
			$this->rptVendor->PushRow(
										new QReportCell("Average",$this->rptVendorFooterStyle,2),
										new QReportCell($intAverage->GetVirtualAttribute('vendor_average'),$this->rptVendorFooterStyle)
									);
			 */
		}
}

ExampleForm::Run('ExampleForm',dirname(__FILE__) . '/qreport-tabular.tpl.php');

?>
