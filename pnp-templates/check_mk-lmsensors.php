<?php
# PNP4Nagios template for check_mk lmsensors.* check
# Author: Wouter de Geus <benv-check_mk@junerules.com>
# Inspired by check_mk-hp_blade_psu.php

$colors = array("FF0000", "00FF00", "0000FF", "E38217", "FCD116", "8B7500", "C73F17", "EE4000", "691F01", "FF7722");

if (!function_exists('getAllSensorFiles')) {
	function getAllSensorFiles($path, $check_match) {
		$files = array();
		if($h = opendir($path)) {
			while(($file = readdir($h)) !== false) {
				if(preg_match($check_match, $file, $aRet))
					$files[] = $aRet[0];
			}
			natcasesort($files);
			closedir($h);
		}
		return $files;
	}
}

if (!isset($colors[0]))
	$colors = array("FF0000", "00FF00", "0000FF");

#	throw new Kohana_exception(print_r($graphs,TRUE));
foreach($graphs AS $graph) {
   $services = $this->tplGetServices($NAGIOS_HOSTNAME, $graph[0]);

   foreach($services as $key=>$val){
      #
      # get the data for a given Host/Service
      $a = $this->tplGetData($val['host'],$val['service']);
      #
      # Throw an exception to debug the content of $a
      # Just to get Infos about the Array Structure
      #
      #throw new Kohana_exception(print_r($a,TRUE));

      if(preg_match("/" . $graph[1] . "/", $a['MACRO']['DISP_SERVICEDESC'], $aRet)) {
         $ds_name = $aRet[1];
      } else {
         $ds_name = $a['MACRO']['DISP_SERVICEDESC'];
      }

      $opt[0] = "--vertical-label \"" . $a['DS']['0']['UNIT'] . "\" --title \"" . $check_title . "\" ";
      $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
      $def[0]    .= rrd::line1("a$key", rrd::color($key), $ds_name, "LINE1");
      $def[0]    .= rrd::gprint("a$key", array("LAST", "AVERAGE", "MAX"), "%.1lf%s");
   }
}
 /*
$graphnum = 0;
foreach($graphs AS $graph) {
		$path = dirname($RRDFILE[1]);
		$check_match = $graph[0];
		$check_title = $graph[1];
		$check_verticallabel =  $graph[2];
		

		if(isset($check_match)) {
			$files = getAllSensorFiles($path, $check_match);
		} elseif(preg_match('/^Sensor_([a-zA-Z]+)/', basename($RRDFILE[1]), $aRet)) {
			$check_match = $aRet[1];
			$files = getAllSensorFiles($path, $check_match);
		} else {
			$files = array($RRDFILE[1]);
		}

		if (count($files) != 0) { 
			$opt[$graphnum] = "--vertical-label \"$check_verticallabel\" --title \"$check_title\" ";
			$def[$graphnum] = "";

			$i = 0;
			foreach($files AS $file) {
				$color = array_shift($colors); array_push($colors, $color);

 				$name  = str_replace('_', ' ', str_replace('.rrd', '', $file));

				$def[$graphnum] .= "DEF:var$i=$path/$file:$DS[1]:AVERAGE " ;
				$vt = $name;
				if (strlen($vt) < 24)
					$vt .= str_repeat (' ', 24 - strlen($name));

				if($i == 0)
					$def[$graphnum] .= "LINE1:var$i#$color:\"$vt\" " ;
				else
					$def[$graphnum] .= "LINE1:var$i#$color:\"$vt\" " ;
				$def[$graphnum] .= "GPRINT:var$i:LAST:\"%6.1lf last \" ";
				$def[$graphnum] .= "GPRINT:var$i:MAX:\"%6.1lf max \" ";
				$def[$graphnum] .= "GPRINT:var$i:AVERAGE:\"%6.2lf  avg \\n\" ";
				$i++;
			}

			$graphnum++;
		}
} */
?>
