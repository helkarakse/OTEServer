<?php
require_once ("../common/common.inc.php");
$dimension = getVar ( "server" );

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
		foreach ($array[0] as $key => $value) {
			$tps = round ( ( float ) $value, 2 );
			if ($tps > 20) {
				$tps = "20.00";
			}
		}
		
		outputEcho ( $tps );
	} else {
		print ("Unknown" . "<br />") ;
	}
} else {
	echo "Server ID variable required.";
}