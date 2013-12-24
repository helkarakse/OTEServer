<?php
/*
 * PHP TickProfile DataDump Handler @author Helkarakse <nimcuron@gmail.com>
 */
require_once ("../common/common.inc.php");

$prefix = "tick";
$extension = ".txt";
$request = getVar ( "req" );

if ($request == "push") {
	$text = urldecode ( getPostVar ( "json" ) );
	
	$array = json_decode ( $text );
	$array [5] ["updated"] = date ( "r", time () );
	$text = stripslashes ( json_encode ( $array ) );
	
	$dimension = getVar ( "dim" );
	$filename = $prefix . "-" . $dimension . $extension;
	fileWrite ( $filename, $text );
	
	outputEcho ( "Updated at: " . date ( "r", time () ) );
} else if ($request == "show") {
	$dimension = getVar ( "dim" );
	$filename = $prefix . "-" . $dimension . $extension;
	
	$data = fileRead ( $filename );
	
	if (getVar ( "output" ) == "json") {
		outputJson ( $data );
	} else {
		$array = json_decode ( $data, true );
		echo ("<p>TPS: " . round ( ( float ) $array [0] ["TPS"], 2 ) . "</p>");
		
		$entityArray = $array [1];
		$chunkArray = $array [2];
		$typeArray = $array [3];
		$callArray = $array [4];
		
		echo ("<table border='1'>");
		echo ("<tr><th>%</th><th>Time/Tick</th><th>Entity</th></tr>");
		foreach ( $entityArray as $key => $value ) {
			echo ("<tr>");
			foreach ( $value as $key => $value ) {
				if ($key == "Single Entity") {
					echo ("<td>$value</td>");
				} else {
					echo ("<td>$value</td>");
				}
			}
			echo ("</tr>");
		}
		echo ("</table>");
	}
}
?>