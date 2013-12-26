<?php
class Tick extends CI_Model {

	function __construct() {
		parent::__construct ();
	}
	
	// returns the tps data from the db
	function get_tps($server, $type) {
		$this->db->select ( "tps, last_update" );
		$this->db->from ( "TickTps" );
		$this->db->where ( array (
			"server" => $server,"type" => $type 
		) );
		$this->db->order_by ( "rowid", "desc" );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		
		if ($query->num_rows () > 0) {
			$row = $query->first_row ();
			$tps = round ( ( float ) $row->tps, 2 );
			
			if ($tps > 20) {
				$tps = "20.00";
			}
			
			return array (
				"tps" => $tps,"last_update" => $row->last_update 
			);
		} else {
			return array (
				"tps" => 0,"last_update" => "" 
			);
		}
	}
	
	// insert the tps data into the db
	function insert_tps($tps, $update, $server, $type) {
		$this->db->insert ( "TickTps", array (
			"server" => $server,"type" => $type,"tps" => $tps,"last_update" => $update 
		) );
		
		return $this->db->insert_id ();
	}

	function insert_players($rowId, $players) {
		if (! empty ( $players )) {
			foreach ( $players as $player ) {
				$this->db->insert ( "TickPlayers", array (
					"tick_id" => $rowId,"name" => $player 
				) );
			}
		}
	}
	
	// writes the tick data to file
	function write_tick_data($json, $server, $type) {
		if (! write_file ( APPPATH . "data/tick-" . $server . "-" . $type . ".txt", $json )) {
			echo ("Failed to write to file.");
		}
	}
	
	// reads the tick data from the file
	function read_tick_data($server, $type) {
		$string = read_file ( APPPATH . "data/tick-" . $server . "-" . $type . ".txt" );
		return $string;
	}
	
	// returns the specific tps data from the db
	// function get_data($rowId, $type) {
	// switch ($type) {
	// case "single" :
	// $query = $this->db->get_where ( "TickEntities", array (
	// "rowid" => $rowId
	// ) );
	// break;
	
	// case "chunk" :
	// $query = $this->db->get_where ( "TickChunks", array (
	// "rowid" => $rowId
	// ) );
	// break;
	
	// case "type" :
	// $query = $this->db->get_where ( "TickTypes", array (
	// "rowid" => $rowId
	// ) );
	// break;
	
	// case "call" :
	// $query = $this->db->get_where ( "TickCalls", array (
	// "rowid" => $rowId
	// ) );
	// break;
	
	// default :
	// return array ();
	// break;
	// }
	
	// if ($query->num_rows () > 0) {
	// return $query;
	// } else {
	// return array ();
	// }
	// }
	
	// add the tick data to the db
	// function add_tick_data($json, $server, $type) {
	// // parse the json input
	// $array = json_decode ( $json );
	// $tps = round ( ( float ) $array [0] ["TPS"], 2 );
	// $entities = $array [1];
	// $chunks = $array [2];
	// $types = $array [3];
	// $calls = $array [4];
	// $last_update = $array [5] ["updated"];
	
	// // insert the tps data first
	// $this->db->insert ( "TickTps", array (
	// "server" => $server,"type" => $type,"tps" => $tps,"last_update" => $last_update
	// ) );
	
	// // get the last inserted id
	// $rowId = $this->db->insert_id ();
	
	// // empty the TickEntity/Chunk/Type/Call tables for size considerations
	// $this->db->empty_table ( "TickEntities" );
	// $this->db->empty_table ( "TickChunks" );
	// $this->db->empty_table ( "TickTypes" );
	// $this->db->empty_table ( "TickCalls" );
	
	// // use the last inserted id as a reference for the other tables
	// foreach ( $entities as $entity ) {
	// $this->db->insert ( "TickEntities", array (
	// "tick_id" => $rowId,"entity" => $entity ["Single Entity"],"time_tick" => $entity
	// ["Time/Tick"],"percent" => $entity ["%"]
	// ) );
	// }
	
	// foreach ( $chunks as $chunk ) {
	// $this->db->insert ( "TickChunks", array (
	// "tick_id" => $rowId,"chunk" => $chunk ["Chunk"],"time_tick" => $chunk ["Time/Tick"],"percent"
	// => $chunk ["%"]
	// ) );
	// }
	
	// foreach ( $types as $type ) {
	// $this->db->insert ( "TickTypes", array (
	// "tick_id" => $rowId,"type" => $type ["All Entities of Type"],"time_tick" => $type
	// ["Time/Tick"],"percent" => $type ["%"]
	// ) );
	// }
	
	// foreach ( $calls as $call ) {
	// $this->db->insert ( "TickCalls", array (
	// "tick_id" => $rowId,"entity" => $call ["Average Entity of Type"],"calls" => $call
	// ["Calls"],"time_tick" => $call ["Time/tick"]
	// ) );
	// }
	// }
}