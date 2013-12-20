<?php
/*
 * Ticket.php Script for handling the data driven aspect of the ticket system Requires SQLite3
 * @author Helkarakse (nimcuron@gmail.com) @version 1.0
 */
require_once ("./classes/ticket.inc.php");

// Variables
$ticket = new Ticket ( "./SQLite3Ticket.db" );
$ticket->initDb ();

// Command parser
if (isset ( $_GET ["cmd"] ) && $_GET ["cmd"] != "") {
	$cmd = $_GET ["cmd"];
	
	switch ($cmd) {
		case "get_tickets" :
			$array = $ticket->getTickets ();
			print_r ( $array );
			break;
		
		case "get_details" :
			$id = isset ( $_POST ["id"] ) ? $_POST ["id"] : "";
			if (! empty ( $id )) {
				$array = $ticket->getTicket ( $id );
				print_r ( $array );
			} else {
				echo ("No id was provided.");
			}
			break;
		
		case "add_ticket" :
			$creator = isset ( $_POST ["creator"] ) ? $_POST ["creator"] : "";
			$description = isset ( $_POST ["description"] ) ? $_POST ["description"] : "";
			$position = isset ( $_POST ["position"] ) ? $_POST ["position"] : "";
			
			if (! empty ( $creator ) && ! empty ( $description )) {
				$ticket->createTicket ( $creator, $description, $position );
			} else {
				echo ("Creator and description fields are mandatory.");
			}
			
			break;
		
		default :
			echo ("Unknown command request.");
			break;
	}
}
?>