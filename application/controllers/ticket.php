<?php

	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Ticket extends CI_Controller {
		function get_user_tickets() {
			$this->load->model("ticket_model");
			$username = $this->input->get_post("name");
			if (! empty($username)) {
				$this->outputJson($this->ticket_model->get_user_tickets($username), TRUE);
			} else {
				$this->outputJson(array(), FALSE);
			}
		}

		function get_user_ticket_count() {
			$this->load->model("ticket_model");
			$username = $this->input->get_post("name");
			if (! empty($username)) {
				$this->outputJson($this->ticket_model->get_user_ticket_count($username), TRUE);
			} else {
				$this->outputJson(array(), FALSE);
			}
		}

		// adds a new ticket to the db
		function add_ticket() {
			$this->load->model("ticket_model");
			$creator = $this->input->get_post("creator");
			$description = $this->input->get_post("description");
			$position = $this->input->get_post("position");

			if (! empty($creator) && ! empty($description) && ! empty($position)) {
				$this->ticket_model->create_ticket($creator, $description, $position);
				$this->outputJson(array(), TRUE);
			} else {
				$this->outputJson(array(), FALSE);
			}
		}

		private function outputJson($result, $success) {
			echo(json_encode(array("result" => $result, "success" => $success)));
		}
	}