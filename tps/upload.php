<?php
/*
 * PHP TickProfile Upload Handler @author Helkarakse <nimcuron@gmail.com>
 */
require_once ("../common/common.inc.php");

$prefix = "tick";
$extension = ".txt";
$request = getVar ( "req" );

if ($request == "put") {
	$text = urldecode ( getPostVar ( "json" ) );
	
	$array = json_decode ( $text );
	$array [5] ["updated"] = date ( "r", time () );
	$text = stripslashes ( json_encode ( $array ) );
	
	$dimension = getVar ( "dim" );
	$filename = $prefix . "-" . $dimension . $extension;
	fileWrite ( $filename, $text );
	
	outputEcho ( "Updated at: " . date ( "r", time () ) );
} elseif ($request == "get") {
	$prefix = "tick";
	$extension = ".txt";
	$dimension = getVar ( "dim" );
	$filename = $prefix . "-" . $dimension . $extension;
	
	$data = fileRead ( $filename );
	if (getVar ( "format" ) == "json") {
		outputEcho ( $data );
	} else {
		print_r ( $data );
	}
}