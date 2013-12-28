<?php

	class Auth_model extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		// returns the authentication data for username
		function get_auth($username) {
			$query = $this->db->get_where("TicketAuth", array("name" => $username));
			if ($query->num_rows() > 0) {
				return $query->first_row();
			} else {
				return array();
			}
		}

		// returns the entire authentication package
		function get_all_auth() {
			$query = $this->db->get("TicketAuth");
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		function set_auth($username, $level) {
			$enumArray = array("Player", "Mod", "Admin", "Dev");
			if ($level > count($enumArray)) {
				$rank = "Unknown";
			} else {
				$rank = $enumArray[$level];
			}

			$this->db->where("name", $username)->update("TicketAuth", array("rank" => $rank, "level" => $level));
		}
	}