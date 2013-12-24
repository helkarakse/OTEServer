<?php
/*
 * PHP OTEGlasses Config Backup Handler @author Helkarakse <nimcuron@gmail.com>
 */
$username = $_GET ["name"];
$dimension = $_GET ["dim"];

$text = urldecode ( $_POST ["config"] );
$filename = "./backup/" . $dimension . "-" . $username . ".txt";
$handle = fopen ( $filename, "w" ) or die ( "Error: Could not open the file for writing." );
fwrite ( $handle, $text );
fclose ( $handle );

echo ("Configuration backup successful: " . date ( "r", time () ));
?>