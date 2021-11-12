<?php

$opt[0] = '';
$def[0] = '';

$check_title = 'Fans';

// "SERVICEDESC" , "DISP_SERVICEDESC"
$graphs  = array(
	      array ('^Sensor_.*fan.*', '^Sensor .*fan.*')
	      );

include_once("check_mk-lmsensors.php");


?>
