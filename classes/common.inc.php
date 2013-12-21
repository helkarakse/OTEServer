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
	), JSON_NUMERIC_CHECK ));
}

// output the error as a json formatted string
function showError() {
	echo (json_encode ( array ("result" => array (),"success" => false 
	), JSON_NUMERIC_CHECK ));
}

// output the success as a json formatted string
function showSuccess() {
	echo (json_encode ( array ("result" => array (),"success" => true 
	), JSON_NUMERIC_CHECK ));
}