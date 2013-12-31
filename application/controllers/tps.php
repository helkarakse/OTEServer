<?php
	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Tps extends CI_Controller {
		// tps/get/server/type
		public function get() {
			$data = $this->tps_model->get_tps($this->input->get("server"), $this->input->get("type"));
			echo($data ["tps"]);
		}
	}