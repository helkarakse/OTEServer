<?php

	class Tps_model extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		// returns the tps data from the db
		function get_tps($server, $type) {
			$this->db->select("id, tps, last_update");
			$this->db->from("TickTps");
			$this->db->where(array(
				"server" => $server, "type" => $type
			));
			$this->db->order_by("id", "desc");
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				$row = $query->first_row();
				$tps = round(( float ) $row->tps, 2);

				if ($tps > 20) {
					$tps = "20.00";
				}

				$query->free_result();

				return array(
					"id" => $row->id, "tps" => $tps, "last_update" => date("r", $row->last_update)
				);
			} else {
				$query->free_result();

				return array(
					"id" => 0, "tps" => 0, "last_update" => ""
				);
			}
		}

		// insert the tps data into the db
		function insert_tps($tps, $update, $server, $type) {
			$this->db->insert("TickTps", array(
				"server" => $server, "type" => $type, "tps" => $tps, "last_update" => $update
			));

			return $this->db->insert_id();
		}

		function insert_players($id, $players) {
			if (! empty ($players)) {
				$string = implode(', ', $players);
				$this->db->insert("TickPlayers", array(
					"tick_id" => $id, "name" => $string
				));
			}
		}

		// returns an array of players for id
		function get_players($id) {
			$this->db->select("name");
			$this->db->from("TickPlayers");
			$this->db->where(array(
				"tick_id" => $id
			));
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				$players = $query->first_row()->name;
				$query->free_result();

				return explode(",", $players);
			} else {
				$query->free_result();

				return array();
			}
		}

		// returns an array of tps and player counts
		function get_tick_data($server, $type, $limit) {
			$returnArray = array();

			// get the tps data
			$this->db->select("id, tps, last_update");
			$this->db->from("TickTps");
			$this->db->where(array(
				"server" => $server, "type" => $type
			));
			if ($limit != FALSE) {
				$this->db->order_by("id", "desc");
				$this->db->limit($limit);
			}
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$playerArray = $this->get_players($row->id);
					$returnArray [] = array(
						"last_update" => date("r", $row->last_update), "tps" => $row->tps,
						"count"       => count($playerArray)
					);
				}
				$query->free_result();

				return array_reverse($returnArray);
			} else {
				$query->free_result();

				return array();
			}
		}

		// writes the tick data to file
		function write_tick_data($json, $server, $type) {
			if (! write_file(APPPATH . "data/tick-" . $server . "-" . $type . ".txt", $json)) {
				echo("Failed to write to file.");
			}
		}

		// reads the tick data from the file
		function read_tick_data($server, $type) {
			$string = read_file(APPPATH . "data/tick-" . $server . "-" . $type . ".txt");

			return $string;
		}
	}