<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>TPS Data</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript"
	src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("div.tableCSS").hide();
	$("div.tableCSS:first").show();
	$("li.menuLink").click(function() {
		var toShow = $(this).attr("display");
		$("div.tableCSS").fadeOut().delay(250);
		$("div.tableCSS").each(function(index) {
			if (this.id == toShow) {
				$(this).fadeIn();
			}
		});
	});
});
	</script>
</head>
<body>
	<ul>
		<li class="menuLink" display="single"><a href="#">Single Entities</a></li>
		<li class="menuLink" display="chunk"><a href="#">Chunks</a></li>
		<li class="menuLink" display="type"><a href="#">Entity Types</a></li>
		<li class="menuLink" display="call"><a href="#">Average Calls</a></li>
	</ul>
	<div>
<?php
require_once ("../common/common.inc.php");
$prefix = "tick";
$extension = ".txt";
$dimension = getVar ( "dim" );
$filename = $prefix . "-" . $dimension . $extension;

$data = fileRead ( $filename );
$array = json_decode ( $data, true );
$entityArray = $array [1];
$chunkArray = $array [2];
$typeArray = $array [3];
$callArray = $array [4];

print ("<p>TPS: " . round ( ( float ) $array [0] ["TPS"], 2 ) . "<br />") ;
print ("Last Updated @ " . $array [5] ["updated"] . "</p>") ;

?>
	</div>
<?php
print ("<div class='tableCSS' id='single'>") ;
print ("<table>") ;
print ("<tr><td>%</td><td>Time/Tick</td><td>Entity</td></tr>") ;
foreach ( $entityArray as $key => $value ) {
	print ("<tr>") ;
	foreach ( $value as $key => $value ) {
		print ("<td>$value</td>") ;
	}
	print ("</tr>") ;
}
print ("</table>") ;
print ("</div>") ;

print ("<div class='tableCSS' id='chunk'>") ;
print ("<table>") ;
print ("<tr><td>%</td><td>Time/Tick</td><td>Chunk Position</td></tr>") ;
foreach ( $chunkArray as $key => $value ) {
	print ("<tr>") ;
	foreach ( $value as $key => $value ) {
		print ("<td>$value</td>") ;
	}
	print ("</tr>") ;
}
print ("</table>") ;
print ("</div>") ;

print ("<div class='tableCSS' id='type'>") ;
print ("<table>") ;
print ("<tr><td>%</td><td>Entity</td><td>Time/Tick</td></tr>") ;
foreach ( $typeArray as $key => $value ) {
	print ("<tr>") ;
	foreach ( $value as $key => $value ) {
		print ("<td>$value</td>") ;
	}
	print ("</tr>") ;
}
print ("</table>") ;
print ("</div>") ;

print ("<div class='tableCSS' id='call'>") ;
print ("<table>") ;
print ("<tr><td>%</td><td>Entity</td><td>Average Calls</td></tr>") ;
foreach ( $callArray as $key => $value ) {
	print ("<tr>") ;
	foreach ( $value as $key => $value ) {
		print ("<td>$value</td>") ;
	}
	print ("</tr>") ;
}
print ("</table>") ;
print ("</div>") ;

?>
		</body>
</html>