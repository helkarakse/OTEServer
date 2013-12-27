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
		$players = implode ( ",", $this->tick->get_players ( $tps ["rowid"] ) );
		
		$array = json_decode ( $data, true );
		$entityArray = $array [1];
		$chunkArray = $array [2];
		$typeArray = $array [3];
		$callArray = $array [4];
		
		$data = array (
			"entities" => $entityArray,"chunks" => $chunkArray,"types" => $typeArray,"calls" => $callArray,"tps" => $tps ["tps"],"last_update" => $tps ["last_update"],"players" => $players,
				"playerCount" => count ( explode ( ",", $players ) ) 
		);
		
		$this->load->view ( "view_board", $data );
	}

	public function graph() {
		$server = $this->input->get ( "server" );
		$type = $this->input->get ( "type" );
		$limit = $this->input->get ( "limit" );
		
		if (empty ( $limit )) {
			$limit = FALSE;
		}
		
		$this->load->library ( 'gcharts' );
		$this->gcharts->load ( 'LineChart' );
		$dataTable = $this->gcharts->DataTable ( 'TPS' );
		$dataTable->addColumn ( 'string', 'Timestamp', 'timestamp' );
		$dataTable->addColumn ( 'number', 'TPS', 'tps' );
		$dataTable->addColumn ( 'number', 'Player Count', 'playerCount' );
		
		$dataArray = $this->tick->get_tick_data ( $server, $type, $limit );
		
		foreach ( $dataArray as $data ) {
			$dataTable->addRow ( array (
				date ( "d/m/Y H:i:s", strtotime ( $data ["last_update"] ) ),$data ["tps"],$data ["count"] 
			) );
		}
		
		$this->gcharts->LineChart ( 'TPS' )->setConfig ( 
				array (
					"title" => "TPS",'hAxis' => new hAxis ( array (
					'textPosition' => 'out','slantedText' => TRUE,'slantedTextAngle' => 45 
				) ) 
				) );
		
		$this->load->view ( "view_graph" );
	}
}