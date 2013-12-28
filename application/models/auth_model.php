<?php

	class Auth_model extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		// returns the authentication data for username
		function get_auth($username) {
			$query = $this->db->select("name, level")->from("TicketAuth")->where("name", $username)->get();
			if ($query->num_rows() > 0) {
				return $query->first_row();
			} else {
				return array();
			}
		}

		// returns the entire authentication package
		function get_all_auth() {
			$query = $this->db->select("rowid, name, rank, level")->from("TicketAuth")->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		function add_auth($username, $level) {
			$rank = $this->_get_rank($level);
			$timeNow = date('Y-m-d H:i:s');
			$this->db->insert("TicketAuth", array(
				"name"        => trim($username), "level" => trim($level), "rank" => trim($rank),
				"create_date" => $timeNow, "update_date" => $timeNow
			));

			return TRUE;
		}

		function delete_auth($username) {
			$this->db->delete("TicketAuth", array("name" => $username));

			return TRUE;
		}

		function set_auth($username, $level) {
			$rank = $this->_get_rank($level);
			$this->db->where("name", $username)->update("TicketAuth", array("rank" => $rank, "level" => $level));

			return TRUE;
		}

		private function _get_rank($level) {
			$enumArray = array("Player", "Mod", "Admin", "Dev");
			if ($level > count($enumArray)) {
				$rank = "Unknown";
			} else {
				$rank = $enumArray[$level];
			}

			return $rank;
		}
	}