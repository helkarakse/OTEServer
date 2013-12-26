<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Upload extends CI_Controller {
	
	// upload/put/server/type
	public function put($server, $type) {
		$timeNow = date ( "r", time () );
		
		$json = urldecode ( $this->input->post ( "json" ) );
		$array = json_decode ( $text );
		$array [5] ["updated"] = $timeNow;
		
		echo ("Updated at: " . $timeNow);
	}
}