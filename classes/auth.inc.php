<?php
/*
 * Auth class @author Helkarakse (nimcuron@gmail.com) @version 1.0
 */
class Auth {
	public $db = null;
	public $databasePath = "./db/AdminTicket.db";
	
	// Constructor
	public function __construct() {
		$this->initDb ();
	}
	
	// Destructor
	public function __destruct() {
		if ($this->db != null) {
			$this->db->close ();
		}
	}
	
	// Functions
	function initDb() {
		// init the db connection
		$this->db = new SQLite3 ( $this->databasePath ) or die ( "Failed to initialise database." );
		
		// create table if not already created
		$this->db->exec ( 
				"CREATE TABLE IF NOT EXISTS Auth (id INTEGER PRIMARY KEY ASC, 
						name TEXT NOT NULL, 
						rank TEXT NOT NULL,
						auth_level INTEGER)" );
	}

	function getAuth($username) {
		$result = $this->db->querySingle ( "SELECT name, rank, auth_level FROM Auth WHERE name = '$username'", true );
		return $result;
	}
	
	function getError() {
		return $this -> db -> lastErrorMsg();
	}
}
?>