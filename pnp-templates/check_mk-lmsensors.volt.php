<?php

$opt[0] = '';
$def[0] = '';

$check_title = 'Voltages';

// "SERVICEDESC" , "DISP_SERVICEDESC"
$graphs  = array(
	      array ('^Sensor_.*(in\d+|\d+\s*V|VCore|volt|bat|vid|DDR)', '^Sensor .*(in\d+|\d+\s*V|VCore|volt|bat|vid|DDR)')
	      );

include_once("check_mk-lmsensors.php");

?>
