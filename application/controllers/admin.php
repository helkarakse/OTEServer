<?php
	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Admin extends CI_Controller {
		public function index() {
			$credentials = array();
			$credentials['admin'] = array(
				"username" => "admin", "password" => "b56W765u3K"
			);

			$this->form_validation->set_rules('user_name', 'username', 'required');
			$this->form_validation->set_rules('user_pass', 'password', 'required');
			$this->form_validation->set_error_delimiters('<em>', '</em>');

			if ($this->input->post('login') && $this->form_validation->run()) {
				$user_name = $this->input->post('user_name');
				$user_pass = $this->input->post('user_pass');

				if (array_key_exists($user_name, $credentials)) {
					if ($user_pass == $credentials[$user_name]['password']) {
						$this->session->set_userdata(array("is_logged_in" => TRUE));
						redirect(site_url(array("c" => "admin", "m" => "main")), "refresh");
					} else {
						$this->session->set_flashdata('message', 'Incorrect password.');
						redirect(site_url(array("c" => "admin", "m" => "index")), "refresh");
					}
				} else {
					$this->session->set_flashdata('message', 'A user does not exist for the username specified.');
					redirect(site_url(array("c" => "admin", "m" => "index")), "refresh");
				}
			} else {
				$this->load->view("admin/view_login");
			}
		}

		public function logout() {
			$this->session->sess_destroy();
			redirect(site_url(array("c" => "admin", "m" => "index")));
		}

		public function main() {
			if ($this->session->userdata("is_logged_in")) {
				$data = array(
					"Resonant Rise 1"    => array(
						"tps"   => $this->tps_model->get_tps("rr", "1")["tps"],
						"count" => count($this->tps_model->get_players($this->tps_model->get_tps("rr", "1")["id"]))
					), "Resonant Rise 2" => array(
						"tps"   => $this->tps_model->get_tps("rr", "2")["tps"],
						"count" => count($this->tps_model->get_players($this->tps_model->get_tps("rr", "2")["id"]))
					), "FTB Unleashed"   => array(
						"tps"   => $this->tps_model->get_tps("ftb", "unleashed")["tps"],
						"count" => count($this->tps_model->get_players($this->tps_model->get_tps("ftb", "unleashed")["id"]))
					)
				);

				$this->load->view("admin/view_template", array("body" => "admin/view_main", "data" => $data));
			} else {
				redirect(site_url(array("c" => "admin")));
			}
		}

		public function board() {
			if ($this->session->userdata("is_logged_in")) {
				$server = $this->input->get("server");
				$type = $this->input->get("type");

				if ($server == "rr" && $type == 1) {
					$dynmap_url = "http://rr.otegamers.com:8123/";
				} elseif ($server == "rr" && $type == 2) {
					$dynmap_url = "http://rr2.otegamers.com:8124/";
				} elseif ($server == "ftb" && $type == "unleashed") {
					$dynmap_url = "http://unleashed.otegamers.com:8123/";
				}

				// load the data from file
				$data = $this->tps_model->read_tick_data($server, $type);
				$tps = $this->tps_model->get_tps($server, $type);
				$playerArray = $this->tps_model->get_players($tps ["id"]);
				$players = implode(",", $playerArray);

				if ($data == "") {
					$array = array(array(), array(), array(), array(), array());
				} else {
					$array = json_decode($data, TRUE);
				}

				$entityArray = $array [1];
				$chunkArray = $array [2];
				$typeArray = $array [3];
				$callArray = $array [4];

				$tmpArray = array();
				foreach ($entityArray as $entity) {
					$matches = array();
					preg_match("/^(.*)\s(.*),(.*),(.*):(.*)/", $entity["Single Entity"], $matches);
					// only create dynmap url if dimension is 0
					if ($matches[5] == 0) {
						$url = $dynmap_url . "?worldname=world&mapname=flat&zoom=4&x={$matches[2]}&y={$matches[3]}&z={$matches[4]}";
					} else {
						$url = "";
					}

					// make the position string regardless
					$position = $matches[2] . ", " . $matches[3] . ", " . $matches[4];

					$entity["name"] = $matches[1];
					$entity["position"] = $position;
					$entity["dynmap_url"] = $url;
					$tmpArray[] = $entity;
				}

				$entityArray = $tmpArray;

				$tmpArray = array();
				foreach ($chunkArray as $chunk) {
					$matches = array();
					if ($server != "ftb") {
						preg_match("/^(.*):\s(.*),\s(.*)/", $chunk["Chunk"], $matches);

						$chunkX = $matches[2] * 16;
						$chunkZ = $matches[3] * 16;

						// only create dynmap url if dimension is 0
						if ($matches[1] == 0) {
							$url = $dynmap_url . "?worldname=world&mapname=flat&zoom=4&x={$chunkX}&y=0&z={$chunkZ}";
						} else {
							$url = "";
						}

						$chunk["Chunk"] = $matches[2] . ", " . $matches[3];
						$chunk["position"] = $chunkX . ", " . $chunkZ;
						$chunk["dynmap_url"] = $url;
					} else {
						// ftb server is 1.5, no chunk dim
						preg_match("/^(.*),\s(.*)/", $chunk["Chunk"], $matches);
						$chunkX = $matches[1] * 16;
						$chunkZ = $matches[2] * 16;

						$chunk["position"] = $chunkX . ", " . $chunkZ;
						$chunk["dynmap_url"] = "";
					}
					$tmpArray[] = $chunk;
				}

				$chunkArray = $tmpArray;

				$data = array(
					"entities"    => $entityArray, "chunks" => $chunkArray, "types" => $typeArray,
					"calls"       => $callArray, "tps" => $tps ["tps"], "last_update" => $tps ["last_update"],
					"players"     => $players, "playerCount" => count($playerArray),
					"script"      => "admin/view_board_scripts", "body" => "admin/view_board"
				);

				$this->load->view("admin/view_template", $data);
			} else {
				redirect(site_url(array("c" => "admin")));
			}
		}

		public function graph() {
			if ($this->session->userdata("is_logged_in")) {
				$server = $this->input->get("server");
				$type = $this->input->get("type");
				$limit = $this->input->get("limit");

				if (empty ($limit)) {
					$limit = FALSE;
				}

				$this->load->library('gcharts');
				$this->gcharts->load('LineChart');
				$dataTable = $this->gcharts->DataTable('TPS');
				$dataTable->addColumn('string', 'Timestamp', 'timestamp');
				$dataTable->addColumn('number', 'TPS', 'tps');
				$dataTable->addColumn('number', 'Player Count', 'playerCount');

				$dataArray = $this->tps_model->get_tick_data($server, $type, $limit);

				foreach ($dataArray as $data) {
					$dataTable->addRow(array(
						date("d/m/Y H:i:s", strtotime($data ["last_update"])), $data ["tps"], $data ["count"]
					));
				}

				$this->gcharts->LineChart('TPS')->setConfig(array(
					"title" => "TPS", 'hAxis' => new hAxis (array(
							'textPosition' => 'out', 'slantedText' => TRUE, 'slantedTextAngle' => 45
						))
				));

				$this->load->view("admin/view_template", array("body" => "admin/view_graph"));
			} else {
				redirect(site_url(array("c" => "admin")));
			}
		}

		public function log_viewer() {
			if ($this->session->userdata("is_logged_in")) {
				$server = $this->input->get("server");
				$type = $this->input->get("type");
				$log_type = $this->input->get("log_type");
				$log_file = $this->input->get("log_file");
				if (empty($log_file)) {
					// no log file passed, assume directory display
					$directory = $this->log_model->get_directory($server, $type, $log_type);
					$fileArray = get_filenames($directory);
					arsort($fileArray);

					$tempArray = array();
					foreach ($fileArray as $file) {
						preg_match("/^crash-(.*)-(.*)-(.*)_(.*)\.(.*)\.(.*)-server.txt/", $file, $matches);
						$timestamp = mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1]);
						$tempArray[] = array(
							"name" => $file,
							"date" => $matches[3] . "/" . $matches[2] . "/" . $matches[1] . " " . $matches[4] . ":" . $matches[5] . ":" . $matches[6]
						);
					}
					$fileArray = $tempArray;

					$this->load->view("admin/view_template", array(
						"body" => "admin/view_log_directory", "files" => $fileArray, "server" => $server,
						"type" => $type, "log_type" => $log_type
					));
				} else {
					// log file passed, display the file itself
					$directory = $this->log_model->get_directory($server, $type, $log_type);
					$string = read_file($directory . "/" . $log_file);
					$this->load->view("admin/view_template", array("body" => "admin/view_log_file", "log" => $string));
				}
			} else {
				redirect(site_url(array("c" => "admin")));
			}
		}

		// testing function
		public function query() {
			$this->load->library("query");
			$status = $this->query->getStatus("rr1.otegamers.com", 25565);
			print_r($status);
		}
	}