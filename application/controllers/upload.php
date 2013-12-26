<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Upload extends CI_Controller {
	
	// upload/put/server/type
	public function put() {
		$server = $this->input->get ( "server" );
		$type = $this->input->get ( "type" );
		$timeNow = date ( "r", time () );
		
		// decode and set the updated key
		$array = json_decode ( urldecode ( $this->input->post ( "json" ) ) );
		$playerArray = json_decode ( urldecode ( $this->input->post ( "players" ) ) );
		$array [5] ["updated"] = $timeNow;
		
		// save the tps data and player list to db
		foreach ( $array [0] as $key => $value ) {
			$tps = $value;
		}
		
		$rowId = $this->tick->insert_tps ( $tps, $timeNow, $server, $type );
		$this->tick->insert_players ( $rowId, $playerArray );
		
		// re encode the json
		$text = stripslashes ( json_encode ( $array ) );
		
		// save the json to file
		$this->tick->write_tick_data ( $text, $server, $type );
		
		echo ("Updated at: " . $timeNow);
	}

	public function get() {
		$server = $this->input->get ( "server" );
		$type = $this->input->get ( "type" );
		
		$string = $this->tick->write_tick_data ( $text, $server, $type );
		
		echo ($string);
	}
}