<?php

	class Ticket_model extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		function get_tickets_by_status($status) {
			$query = $this->db->get_where("TicketIssue", array("status" => $status));
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		function get_ticket($id) {
			$query = $this->db->get_where("TicketIssue", array("rowid" => $id));
			if ($query->num_rows() > 0) {
				$row = $query->first_row();
				$query->free_result();

				return $row;
			} else {
				return array();
			}
		}

		// return array of user's tickets for username
		function get_user_tickets($username) {
			$query = $this->db->get_where("TicketIssue", array("creator" => $username, "status !=" => "resolved"));
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		function get_user_ticket_count($username) {
			$this->db->select("status, count(status) as count")->from("TicketIssue")->where("creator", $username)->group_by("status");
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		// adds a new ticket to the db given the creator, description and position
		function create_ticket($creator, $description, $position) {
			$timeNow = date('Y-m-d H:i:s');
			$this->db->insert("TicketIssue", array(
				"creator"  => $creator, "description" => $description, "position" => $position, "status" => "new",
				"assigned" => "", "type" => "mod", "notes" => "", "create_date" => $timeNow, "update_date" => $timeNow
			));
		}
	}