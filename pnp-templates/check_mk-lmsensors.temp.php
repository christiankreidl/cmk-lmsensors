<?php

$def[0] = "";
$opt[0] = "";

$check_title = 'Temperatures';

// "SERVICEDESC" , "DISP_SERVICEDESC"
$graphs  = array(
		array ('^Sensor_.*_Temp', '^Sensor (.*)_Temp'),
#		array ('^Sensor_.*(?<!Core\d)_Temp', '^Sensor (.*)_Temp'),
# 		array ('^Sensor_CPU\d+_Core\d+_Temp','^Sensor (CPU\d+_Core\d+)_Temp')
		);

include_once("check_mk-lmsensors.php");

?>
