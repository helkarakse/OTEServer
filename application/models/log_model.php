<?php

	class Log_model extends CI_Model {
		function __construct() {
			parent::__construct();
		}

		// returns the directory for the server log and type
		function get_directory($server, $type, $log_type) {
			if ($server == "ftb") {
				$directory = APPPATH . "data/logs/" . $type . "server/";
				if ($log_type == "crash") {
					$directory .= "crash-reports";
				} else {
					$directory .= "server-logs";
				}
			} else {
				$directory = APPPATH . "data/logs/" . $server . $type . "server/";
				if ($log_type == "crash") {
					$directory .= "crash-reports";
				} else {
					$directory .= "server-logs";
				}
			}

			return (! empty($directory)) ? $directory : "";
		}

		function get_crash_log($directory) {

		}

		function get_server_log($directory) {

		}

		function get_last_crash_log($directory) {

		}

		function get_last_server_log($directory) {

		}
	}