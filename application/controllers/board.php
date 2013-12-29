<?php
	if (! defined('BASEPATH'))
		exit ('No direct script access allowed');

	class Board extends CI_Controller {
		// board/display/server/type
		public function show() {
			$this->load->model("tps_model");
			$server = $this->input->get("server");
			$type = $this->input->get("type");

			if ($server == "rr" && $type == 1) {
				$baseUrl = "http://rr.otegamers.com:8123/";
			} elseif ($server == "rr" && $type == 2) {
				$baseUrl = "http://rr2.otegamers.com:8124/";
			} elseif ($server == "ftb" && $type == "unleashed") {
				$baseUrl = "http://unleashed.otegamers.com:8123/";
			}

			// load the data from file
			$data = $this->tps_model->read_tick_data($server, $type);
			$tps = $this->tps_model->get_tps($server, $type);
			$players = implode(",", $this->tps_model->get_players($tps ["rowid"]));

			$array = json_decode($data, TRUE);
			$entityArray = $array [1];
			$chunkArray = $array [2];
			$typeArray = $array [3];
			$callArray = $array [4];

			$tmpArray = array();
			foreach ($entityArray as $entity) {
				preg_match("/^(.*)\s(.*),(.*),(.*):(.*)/", $entity["Single Entity"], $matches);
				// only create dynmap url if dimension is 0
				if ($matches[5] == 0) {
					$dynmapUrl = $baseUrl . "?worldname=world&mapname=flat&zoom=4&x={$matches[2]}&y={$matches[3]}&z={$matches[4]}";
				} else {
					$dynmapUrl = "";
				}
				$entity["dynmap_url"] = $dynmapUrl;
				$tmpArray[] = $entity;
			}

			$entityArray = $tmpArray;

			$tmpArray = array();
			foreach ($chunkArray as $chunk) {
				preg_match("/^(.*):\s(.*),\s(.*)/", $chunk["Chunk"], $matches);
				// only create dynmap url if dimension is 0
				if ($matches[1] == 0) {
					$chunkX = $matches[2] * 16;
					$chunkZ = $matches[3] * 16;
					$dynmapUrl = $baseUrl . "?worldname=world&mapname=flat&zoom=4&x={$chunkX}&y=0&z={$chunkZ}";
				} else {
					$dynmapUrl = "";
				}
				$chunk["dynmap_url"] = $dynmapUrl;
				$tmpArray[] = $chunk;
			}

			$chunkArray = $tmpArray;

			$data = array(
				"entities"    => $entityArray, "chunks" => $chunkArray, "types" => $typeArray, "calls" => $callArray,
				"tps"         => $tps ["tps"], "last_update" => $tps ["last_update"], "players" => $players,
				"playerCount" => count(explode(",", $players))
			);

			$this->load->view("board/view_board", $data);
		}

		public function graph() {
			$this->load->model("tps_model");
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

			$this->load->view("board/view_graph");
		}
	}