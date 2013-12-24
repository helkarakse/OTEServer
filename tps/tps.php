<?php
require_once ("../common/common.inc.php");
$dimension = getVar ( "server" )
$date = getVar ( "server" )

if ($dimension != "") {
	switch ($dimension) {
		case "rr1" :
			$filename = "tick-" . substr ( $dimension, - 1 ) . ".txt";
			break;
		
		case "rr2" :
			$filename = "tick-" . substr ( $dimension, - 1 ) . ".txt";
			break;
		
		case "unleashed" :
			$filename = "tick-5.txt";
			break;
		
		case "dw20" :
			$filename = "tick-" . $dimension . ".txt";
			break;
		
		case "horizons" :
			$filename = "tick-" . $dimension . ".txt";
			break;
		
		default :
			$filename = "default.txt";
			break;
	}
	
	$json = fileRead($filename);
	
	$array = ($json != "") ? json_decode ( $json ) : array ();
	
	if (! empty ( $array )) {
		$tps = round ( ( float ) $array [0] [0], 2 );
		if ($tps > 20) {
			$tps = "20.00";
		}
		
		outputEcho ( $tps );
	} else {
		print ("Unknown" . "<br />") ;
	}
	
	if (!empty($date) && count ( $array ) > 0) {
		outputEcho ( $array [5] [0] );
	}
} else {
	echo "Server ID variable required.";
}