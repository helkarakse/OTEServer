<?php

	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Ticket extends CI_Controller {
		function get_tickets() {

		}

		// adds a new ticket to the db
		function add_ticket() {
			$creator = $this->input->post("creator");
			$description = $this->input->post("description");
			$position = $this->input->post("position");

			if (! empty($creator) && ! empty($description) && ! empty($position)) {
				$success = $this->model_ticket->create_ticket($creator, $description, $position);
				$this->outputJson(array(), $success);
			} else {
				$this->outputJson(array(), FALSE);
			}
		}

		private function outputJson($result, $success) {
			echo(json_encode(array("result" => $result, "success" => $success)));
		}
	}