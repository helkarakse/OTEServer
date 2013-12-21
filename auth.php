<?php
/*
 * Auth.php Script for handling the data driven aspect of the authentication that CC will request
 * @author Helkarakse (nimcuron@gmail.com) @version 1.0
 */
require_once ("./classes/auth.inc.php");
require_once ("./classes/common.inc.php");

// Variables
$auth = new Auth ();

// Command parser
$command = getVar ( "cmd" );
if (! empty ( $command )) {
	switch ($command) {
		case "get_auth" :
			$username = getPostVar ( "name" );
			if (! empty ( $username )) {
				$auth = $auth->getAuth ( $username );
				echo ($auth ["auth_level"]);
			} else {
				echo ("A required field cannot be empty.");
			}
			break;
		
		default :
			echo ("A required field cannot be empty.");
			break;
	}
} else {
	echo ("A required field cannot be empty.");
}
?>