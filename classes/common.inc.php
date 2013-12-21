<?php

// shortcut function to get the global var for $variable
function getVar($variable) {
	return isset ( $_GET [$variable] ) ? $_GET [$variable] : "";
}

// shortcut function to get the global post var for $variable
function getPostVar($variable) {
	return isset ( $_POST [$variable] ) ? $_POST [$variable] : "";
}