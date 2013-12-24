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
	echo (json_encode ( array (
		"result" => $data,"success" => true 
	), JSON_NUMERIC_CHECK ));
}

function outputEcho($text) {
	echo ($text);
}

// output the error as a json formatted string
function showError() {
	echo (json_encode ( array (
		"result" => array (),"success" => false 
	), JSON_NUMERIC_CHECK ));
}

// output the success as a json formatted string
function showSuccess() {
	echo (json_encode ( array (
		"result" => array (),"success" => true 
	), JSON_NUMERIC_CHECK ));
}

function fileWrite($filename, $text) {
	$handle = fopen ( $filename, "w" ) or die ( "Error: Could not open the file for writing." );
	fwrite ( $handle, $text );
	fclose ( $handle );
}

function fileRead($filename) {
	$handle = fopen ( $filename, "r" );
	$data = fread ( $handle, filesize ( $filename ) );
	fclose ( $handle );
	return $data;
}

// Converts the timestamp into Facebook style time stamp
function prettyTime($timestamp) {
	$timestamp = ( int ) $timestamp;
	$current_time = time ();
	$diff = $current_time - $timestamp;
	
	$intervals = array (
		'year' => 31556926,'month' => 2629744,'week' => 604800,'day' => 86400,'hour' => 3600,'minute' => 60 
	);
	
	if ($diff == 0) {return 'just now';}
	
	if ($diff < 60) {return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';}
	
	if ($diff >= 60 && $diff < $intervals ['hour']) {
		$diff = floor ( $diff / $intervals ['minute'] );
		return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
	}
	
	if ($diff >= $intervals ['hour'] && $diff < $intervals ['day']) {
		$diff = floor ( $diff / $intervals ['hour'] );
		return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
	}
	
	if ($diff >= $intervals ['day'] && $diff < $intervals ['week']) {
		$diff = floor ( $diff / $intervals ['day'] );
		return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
	}
	
	if ($diff >= $intervals ['week'] && $diff < $intervals ['month']) {
		$diff = floor ( $diff / $intervals ['week'] );
		return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
	}
	
	if ($diff >= $intervals ['month'] && $diff < $intervals ['year']) {
		$diff = floor ( $diff / $intervals ['month'] );
		return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
	}
	
	if ($diff >= $intervals ['year']) {
		$diff = floor ( $diff / $intervals ['year'] );
		return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
	}
}

// changes the time of create_date to time_ago
function convertTime($array) {
	$key = 0;
	foreach ( $array as $row ) {
		$timeAgo = prettyTime ( strtotime ( $row ["update_date"] ) );
		$array [$key] ["time_ago"] = $timeAgo;
		unset ( $array [$key] ["update_date"] );
		$key ++;
	}
}