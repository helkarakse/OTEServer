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
		outputEcho ( $data );
	} else {
		$array = json_decode ( $data, true );
		$entityArray = $array [1];
		$chunkArray = $array [2];
		$typeArray = $array [3];
		$callArray = $array [4];
		?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>TPS Data</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<?php
		echo ("<p>TPS: " . round ( ( float ) $array [0] ["TPS"], 2 ) . "</p>");
		
		echo ("<div class='tableCSS'>");
		echo ("<p>Single Entities</p>");
		echo ("<table>");
		echo ("<tr><td>%</td><td>Time/Tick</td><td>Entity</td></tr>");
		foreach ( $entityArray as $key => $value ) {
			echo ("<tr>");
			foreach ( $value as $key => $value ) {
				echo ("<td>$value</td>");
			}
			echo ("</tr>");
		}
		echo ("</table>");
		echo ("</div>");
		
		echo ("<div class='tableCSS'>");
		echo ("<p>Chunks</p>");
		echo ("<table>");
		echo ("<tr><td>%</td><td>Time/Tick</td><td>Chunk Position</td></tr>");
		foreach ( $chunkArray as $key => $value ) {
			echo ("<tr>");
			foreach ( $value as $key => $value ) {
				echo ("<td>$value</td>");
			}
			echo ("</tr>");
		}
		echo ("</table>");
		echo ("</div>");
		
		echo ("<div class='tableCSS'>");
		echo ("<p>Entity Types</p>");
		echo ("<table>");
		echo ("<tr><td>%</td><td>Entity</td><td>Time/Tick</td></tr>");
		foreach ( $typeArray as $key => $value ) {
			echo ("<tr>");
			foreach ( $value as $key => $value ) {
				echo ("<td>$value</td>");
			}
			echo ("</tr>");
		}
		echo ("</table>");
		echo ("</div>");
		
		echo ("<div class='tableCSS'>");
		echo ("<p>Average Calls</p>");
		echo ("<table>");
		echo ("<tr><td>%</td><td>Entity</td><td>Average Calls</td></tr>");
		foreach ( $callArray as $key => $value ) {
			echo ("<tr>");
			foreach ( $value as $key => $value ) {
				echo ("<td>$value</td>");
			}
			echo ("</tr>");
		}
		echo ("</table>");
		echo ("</div>");
		?>
		</body>
</html>
<?php
	}
}