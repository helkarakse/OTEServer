<?php

	class Issue extends CI_Model {

		function __construct() {
			parent::__construct();
		}

		// returns an array of issues given the auth level of the user and optionally the status
		function get_issues($authLevel, $status = FALSE) {
			if ($authLevel == 1) {
				// mod level
				if ($status) {
					$query = $this->db->get_where("TicketIssue", array("type" => "mod", "status" => $status));
				} else {
					$query = $this->db->get_where("TicketIssue", array("type" => "mod"));
				}
			} elseif ($authLevel >= 2) {
				// admin/dev level
				if ($status) {
					$query = $this->db->get_where("TicketIssue", array("status" => $status));
				} else {
					$query = $this->db->get("TicketIssue");
				}
			}

			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		// returns the details of an issue given the auth level and the id
		function get_issue($authLevel, $id) {
			if ($authLevel == 1) {
				// mod level
				$query = $this->db->get_where("TicketIssue", array("type" => "mod", "rowid" => $id));

			} elseif ($authLevel >= 2) {
				// admin/dev level
				$query = $this->db->get_where("TicketIssue", array("rowid" => $id));
			}

			if ($query->num_rows() > 0) {
				return $query->first_row();
			} else {
				return array();
			}
		}
	}