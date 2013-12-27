<?php

	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Ticket extends CI_Controller {
		function get_tickets() {
			$this->load->model("ticket_model");
		}

		// adds a new ticket to the db
		function add_ticket() {
			$this->load->model("ticket_model");
			$creator = $this->input->get_post("creator");
			$description = $this->input->get_post("description");
			$position = $this->input->get_post("position");

			if (! empty($creator) && ! empty($description) && ! empty($position)) {
				$success = $this->ticket_model->create_ticket($creator, $description, $position);
				$this->outputJson(array(), $success);
			} else {
				$this->outputJson(array(), FALSE);
			}
		}

		private function outputJson($result, $success) {
			echo(json_encode(array("result" => $result, "success" => $success)));
		}
	}