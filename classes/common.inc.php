<?php

// shortcut function to get the global var for $variable
function getVar($variable) {
	return isset ( $_GET [$variable] ) ? $_GET [$variable] : "";
}

// shortcut function to get the global post var for $variable
function getPostVar($variable) {
	return isset ( $_POST [$variable] ) ? $_POST [$variable] : "";
}

// output the array as a json formatted string
function outputJson($data) {
	echo (json_encode ( array ("result" => $data,"success" => true 
	) ));
}

// output the error as a json formatted string
function showError() {
	echo (array ("result" => array (),"success" => false 
	));
}

// output the success as a json formatted string
function showSuccess() {
	echo (array ("result" => array (),"success" => true 
	));
}