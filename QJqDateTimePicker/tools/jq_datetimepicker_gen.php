<?php
require('jq_control.php');

function jq_datetimepicker_gen() {
	$jqControlGen = new JqControlGen();
	$objJqDoc = new JqDoc(null, 'datetimepicker', 'QJqDateTimePicker', 'QDatepickerBox');
	$options = array();
	$options[] = new Option('alwaysSetTime', 'alwaysSetTime', 'Boolean', 'True', '');
	$options[] = new Option('ampm', 'ampm', 'Boolean', 'False', '');
	$options[] = new Option('hour', 'hour', 'Integer', '0', '');
	$options[] = new Option('hourMin', 'hourMin', 'Integer', '0', '');
	$options[] = new Option('hourMax', 'hourMax', 'Integer', '23', '');
	//$options[] = new Option('hourGrid', 'hourGrid', 'Integer', '0', '');
	$options[] = new Option('minute', 'minute', 'Integer', '0', '');
	$options[] = new Option('minuteMin', 'minuteMin', 'Integer', '0', '');
	$options[] = new Option('minuteMax', 'minuteMax', 'Integer', '59', '');
	//$options[] = new Option('minuteGrid', 'minuteGrid', 'Integer', '0', '');
	$options[] = new Option('second', 'second', 'Integer', '0', '');
	$options[] = new Option('secondMin', 'secondMin', 'Integer', '0', '');
	$options[] = new Option('secondMax', 'secondMax', 'Integer', '59', '');
	//$options[] = new Option('secondGrid', 'secondGrid', 'Integer', '0', '');
	$options[] = new Option('showButtonPanel', 'showButtonPanel', 'Boolean', 'True', '');
	$options[] = new Option('showHour', 'showHour', 'Boolean', 'True', '');
	$options[] = new Option('showMinute', 'showMinute', 'Boolean', 'True', '');
	$options[] = new Option('showSecond', 'showSecond', 'Boolean', 'False', '');
	$options[] = new Option('showTime', 'showTime', 'Boolean', 'True', '');
	$options[] = new Option('stepHour', 'stepHour', 'Number', '.05', '');
	$options[] = new Option('stepMinute', 'stepMinute', 'Number', '.05', '');
	$options[] = new Option('stepSecond', 'stepSecond', 'Number', '.05', '');
	$options[] = new Option('jqTimeFormat', 'timeFormat', 'String', 'hh:mm tt', '');
	$options[] = new Option('timeOnly', 'timeOnly', 'Boolean', 'False', '');
	$objJqDoc->options = $options;
	$jqControlGen->GenerateControl($objJqDoc);
}

jq_datetimepicker_gen();

?>
 
