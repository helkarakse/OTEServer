<?php

	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Auth extends CI_Controller {
		function get_auth() {
			$this->load->model("auth_model");
			$username = $this->input->get_post("name");
			if (! empty($username)) {
				output_json($this->auth_model->get_auth($username), TRUE);
			} else {
				output_json(array(), FALSE);
			}
		}

		function get_auth_package() {
			$this->load->model("auth_model");
			output_json($this->auth_model->get_all_auth(), TRUE);
		}
	}