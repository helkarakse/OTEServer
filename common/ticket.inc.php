<?php
/*
 * Ticket class @author Helkarakse (nimcuron@gmail.com) @version 1.0
 */
class Ticket {
	public $db = null;
	public $databasePath = "../db/AdminTicket.db";
	
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
						assigned TEXT,
						type TEXT, 
						notes TEXT, 
						create_date DATETIME, 
						update_date DATETIME)" );
	}
	
	// Tickets
	
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
		return $this->db->exec ( "INSERT INTO Tickets VALUES(NULL, '$creator', '$description', '$position', 'new', '', 'mod', '', '$create_date', '$create_date')" ) or
				 die ( $this->db->lastErrorMsg () );
	}

	function getTickets($status) {
		$return = array ();
		$result = $this->db->query ( "SELECT id, creator, description, position, status, type, notes FROM Tickets WHERE status = '$status'" );
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}

	function getTicket($id) {
		return $this->db->querySingle ( "SELECT creator, description, position, status, type, notes FROM Tickets WHERE id = '$id'", true );
	}

	function getUserTickets($username) {
		$return = array ();
		$result = $this->db->query ( "SELECT id, creator, description, position, status, type, notes FROM Tickets WHERE creator = '$username' AND status != 'completed'" );
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}

	function countUserTickets($username) {
		$return = array ();
		$result = $this->db->query ( "SELECT status, COUNT(status) as count FROM Tickets WHERE creator = '$username' GROUP BY status" );
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}
	
	// Issues
	function getIssues($authLevel) {
		$return = array ();
		// authLevel 1 is mod, which means only mod level tickets are returned
		if ($authLevel == 1) {
			$result = $this->db->query ( "SELECT id, creator, update_date FROM Tickets WHERE type = 'mod'" );
		} elseif ($authLevel > 2) {
			// authLevel 2 is admin, which means all the tickets are returned
			$result = $this->db->query ( "SELECT id, creator, update_date FROM Tickets" );
		}
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}

	function getIssuesByType($authLevel, $status) {
		$return = array ();
		// authLevel 1 is mod, which means only mod level tickets are returned
		if ($authLevel == 1) {
			$result = $this->db->query ( "SELECT id, creator, update_date FROM Tickets WHERE type = 'mod' AND status = '$status'" );
		} elseif ($authLevel > 2) {
			// authLevel 2 is admin, which means all the tickets are returned
			$result = $this->db->query ( "SELECT id, creator, update_date FROM Tickets WHERE status = '$status'" );
		}
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}

	function getIssueDetails($authLevel, $id) {
		$return = array ();
		// authLevel 1 is mod, which means only mod level tickets are returned
		if ($authLevel == 1) {
			$result = $this->db->query ( "SELECT id, creator, description, position, status, assigned, type, notes, update_date FROM Tickets WHERE type = 'mod' AND id = '$id'" );
		} elseif ($authLevel > 2) {
			// authLevel 2 is admin, which means all the tickets are returned
			$result = $this->db->query ( "SELECT id, creator, description, position, status, assigned, type, notes, update_date FROM Tickets WHERE id = '$id'" );
		}
		while ( $row = $result->fetchArray ( SQLITE3_ASSOC ) ) {
			$return [] = $row;
		}
		return $return;
	}
}
?>