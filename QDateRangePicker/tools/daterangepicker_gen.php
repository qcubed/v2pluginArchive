<?php
require('jq_control.php');

function daterangepicker_gen() {
	$jqControlGen = new JqControlGen();
	$objJqDoc = new JqDoc(null, 'daterangepicker', 'QDateRangePicker', 'QPanel');
	$options = array();
	$options[] = new Option('presetRanges', 'presetRanges', 'Array', null, '');
	$options[] = new Option('presets', 'presets', 'Array', null, '');
	$options[] = new Option('rangeStartTitle', 'rangeStartTitle', 'String', '', '');
	$options[] = new Option('rangeEndTitle', 'rangeEndTitle', 'String', '', '');
	$options[] = new Option('doneButtonText', 'doneButtonText', 'String', '', '');
	$options[] = new Option('prevLinkText', 'prevLinkText', 'String', '', '');
	$options[] = new Option('nextLinkText', 'nextLinkText', 'String', '', '');
	$options[] = new Option('earliestDate', 'earliestDate', 'Date', '', '');
	$options[] = new Option('latestDate', 'latestDate', 'Date', '', '');
	$options[] = new Option('rangeSplitter', 'rangeSplitter', 'String', '', '');
	$options[] = new Option('jqDateFormat', 'dateFormat', 'String', '', '');
	$options[] = new Option('closeOnSelect', 'closeOnSelect', 'Boolean', 'True', '');
	$options[] = new Option('arrows', 'arrows', 'Boolean', 'False', '');
	$options[] = new Event('QDateRangePicker', 'onClose', 'onClose', 'rangepickerclose', '');
	$objJqDoc->options = $options;
	$jqControlGen->GenerateControl($objJqDoc);
}

daterangepicker_gen();

?>
 
