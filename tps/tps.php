<?php

function printTps($array) {
	foreach ( $array as $key => $value ) {
		$tps = round ( ( float ) $value, 2 );
		if ($tps > 20) {
			$tps = "20.00";
		}
		print ($tps . "<br />") ;
	}
}

function printUpdated($array) {
	foreach ( $array as $key => $value ) {
		print ($value . "<br />") ;
	}
}

$dimension = isset ( $_GET ["server"] ) ? $_GET ["server"] : "";
$date = isset ( $_GET ["date"] ) ? $_GET ["date"] : false;

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
	
	$handle = fopen ( $filename, "r" ) or die ( "Failed to find required file." );
	$json = fread ( $handle, filesize ( $filename ) );
	fclose ( $handle );
	
	$array = ($json != "") ? json_decode ( $json ) : array ();
	
	(count ( $array ) > 0) ? printTps ( $array [0] ) : print ("Unknown" . "<br />") ;
	
	if ($date == true && count ( $array ) > 0) {
		printUpdated ( $array [5] );
	}
} else {
	echo "Server ID variable required.";
}
?>