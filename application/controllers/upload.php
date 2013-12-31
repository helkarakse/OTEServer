<?php
	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Upload extends CI_Controller {

		// upload/put/server/type
		public function put() {
			$this->load->model("tps_model");
			$server = $this->input->get("server");
			$type = $this->input->get("type");
			$timeNow = time();

			// decode and set the updated key
			$array = json_decode(urldecode($this->input->post("json")));
			$playerArray = json_decode(urldecode($this->input->post("players")));
			$array [5] ["updated"] = date("r", $timeNow);

			// save the tps data and player list to db
			foreach ($array [0] as $key => $value) {
				$tps = $value;
			}

			$rowId = $this->tps_model->insert_tps($tps, $timeNow, $server, $type);
			if (! empty ($playerArray)) {
				$this->tps_model->insert_players($rowId, $playerArray);
			}

			// re encode the json
			$text = stripslashes(json_encode($array));

			// save the json to file
			$this->tps_model->write_tick_data($text, $server, $type);

			echo("Updated at: " . date("r", $timeNow));
		}

		public function get() {
			$this->load->model("tps_model");
			$server = $this->input->get("server");
			$type = $this->input->get("type");

			$string = $this->tps_model->read_tick_data($server, $type);

			echo($string);
		}
	}