<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Tps extends CI_Controller {

	public function index() {
		echo date ( 'Y-m-d H:i:s' );
	}
	
	// tps/get/server/type
	public function get($server, $type) {
		$data = $this->tick->get_tps ( $server, $type );
		print_r ( $data );
	}
}