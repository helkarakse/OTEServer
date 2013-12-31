<?php

	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Ticket extends CI_Controller {
		function get_user_tickets() {
			$username = $this->input->get_post("name");
			if (! empty($username)) {
				$output = array();
				$data = $this->ticket_model->get_user_tickets($username);
				foreach ($data as $row) {
					$output[] = array(
						"description" => $row->description, "status" => $row->status,
						"time_ago"    => pretty_time(strtotime($row->create_date))
					);
				}

				output_json($output, TRUE);
			} else {
				output_json(array(), FALSE);
			}
		}

		function get_user_ticket_count() {
			$username = $this->input->get_post("name");
			if (! empty($username)) {
				output_json($this->ticket_model->get_user_ticket_count($username), TRUE);
			} else {
				output_json(array(), FALSE);
			}
		}

		// adds a new ticket to the db
		function add_ticket() {
			$creator = $this->input->get_post("creator");
			$description = $this->input->get_post("description");
			$position = $this->input->get_post("position");

			if (! empty($creator) && ! empty($description) && ! empty($position)) {
				$this->ticket_model->create_ticket($creator, $description, $position);
				output_json(array(), TRUE);
			} else {
				output_json(array(), FALSE);
			}
		}
	}