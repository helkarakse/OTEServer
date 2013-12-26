<?php
/*
 * PHP OTEGlasses Config Backup Handler @author Helkarakse <nimcuron@gmail.com>
 */
require_once ("../common/common.inc.php");
$username = getVar ( "name" );
$dimension = getVar ( "dim" );

$text = urldecode ( getPostVar ( "config" ) );
$filename = "./backup/" . $dimension . "-" . $username . ".txt";
$handle = fopen ( $filename, "w" ) or die ( "Error: Could not open the file for writing." );
fwrite ( $handle, $text );
fclose ( $handle );

echo ("Configuration backup successful: " . date ( "r", time () ));
?>