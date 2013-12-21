<?php
/*
 * Ticket class @author Helkarakse (nimcuron@gmail.com) @version 1.0
 */
class Ticket {
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
				"CREATE TABLE IF NOT EXISTS Tickets (id INTEGER PRIMARY KEY ASC, 
						creator TEXT NOT NULL, 
						description TEXT NOT NULL,
						position TEXT,
						status TEXT, 
						type TEXT, 
						notes TEXT, 
						create_date DATETIME, 
						update_date DATETIME)" );
	}

	/**
	 * Creates a new entry in the ticket table
	 *
	 * @param string $creator
	 *        	the creator of the ticket
	 * @param string $description
	 *        	the description of the ticket
	 * @param string $position
	 *        	the x, y and z coordinates of
	 *        	the creator
	 * @return boolean true if ticket created
	 *         successfully
	 */
	function createTicket($creator, $description, $position) {
		/*
		 * Enum for status: 0 - new 1 - open 2 - in progress 3 - completed 4 - cancelled / rejected
		 * Enum for type 1 - mod 2 - admin
		 */
		$create_date = date ( 'Y-m-d H:i:s' );
		return $this->db->exec ( 
				"INSERT INTO Tickets VALUES(NULL, '$creator', '$description', '$position', 'new', 'mod', '', '$create_date', '$create_date')" ) or
				 die ( $db->lastErrorMsg () );
	}

	function getTickets($status) {
		$return = array ();
		$result = $this->db->query ( 
				"SELECT id, creator, description, position, status, type, notes, create_date, update_date FROM Tickets WHERE status = '$status'" );
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}

	function getTicket($id) {
		return $this->db->querySingle ( 
				"SELECT creator, description, position, status, type, notes, create_date, update_date FROM Tickets WHERE id = '$id'", true );
	}
	
	function getUserTickets($username) {
		$return = array ();
		$result = $this->db->query ( 
				"SELECT id, creator, description, position, status, type, notes, create_date, update_date FROM Tickets WHERE creator = '$username' AND status != 'completed'" );
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}
}
?>