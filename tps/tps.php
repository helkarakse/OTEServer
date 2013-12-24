<?php
$dimension = isset ( getVar ( "server" ) ) ? getVar ( "server" ) : "";
$date = isset ( getVar ( "date" ) ) ? getVar ( "date" ) : false;

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
	
	$handle = fopen ( $filename, "r" ) or die ( "0" );
	$json = fread ( $handle, filesize ( $filename ) );
	fclose ( $handle );
	
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
	
	if ($date == true && count ( $array ) > 0) {
		outputEcho ( $array [5] [0] );
	}
} else {
	echo "Server ID variable required.";
}