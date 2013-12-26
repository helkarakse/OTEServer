<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Board extends CI_Controller {
	
	// board/display/server/type
	public function display($server, $type) {
		$filename = "";
		switch ($server) {
			case "rr" :
				if ($type == "1") {
					$filename = "tick-1";
				} elseif ($type == "2") {
					$filename = "tick-2";
				}
				break;
			
			case "ftb" :
				if ($type == "unleashed") {
					$filename = "tick-5";
				}
				break;
			
			default :
				break;
		}
		
		if (! empty ( $filename )) {
			$string = read_file ( APPPATH . "data/" . $filename . ".txt" );
			echo $string;
		} else {
			show_error ( "Error: Unknown server or type." );
		}
	}
}