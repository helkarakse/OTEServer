<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Board extends CI_Controller {
	
	// board/display/server/type
	public function show() {
		$server = $this->input->get ( "server" );
		$type = $this->input->get ( "type" );
		
		// load the data from file
		$data = $this->tick->read_tick_data ( $server, $type );
		$tps = $this->tick->get_tps ( $server, $type );
		
		$array = json_decode ( $data, true );
		$entityArray = $array [1];
		$chunkArray = $array [2];
		$typeArray = $array [3];
		$callArray = $array [4];
		
		$data = array (
			"entities" => $entityArray,"chunks" => $chunkArray,"types" => $typeArray,"calls" => $callArray,"tps" => $tps ["tps"],"last_update" => $tps ["last_update"] 
		);
		
		$this->load->view ( "view_board", $data );
	}
}