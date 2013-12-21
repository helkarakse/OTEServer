<?php
/*
 * Ticket.php Script for handling the data driven aspect of the ticket system Requires SQLite3
 * @author Helkarakse (nimcuron@gmail.com) @version 1.0
 */
require_once ("./classes/ticket.inc.php");
require_once ("./classes/common.inc.php");

// Variables
$ticket = new Ticket ();

// Command parser
$command = getVar ( "cmd" );
if (! empty ( $command )) {
	switch ($command) {
		case "get_new_tickets" :
			$array = $ticket->getTickets ("new");
			echo (json_encode ( $array ));
			break;
		
		case "get_details" :
			$id = getPostVar ( "id" );
			if (! empty ( $id )) {
				$array = $ticket->getTicket ( $id );
				print_r ( $array );
			} else {
				echo ("A required field cannot be empty.");
			}
			break;
		
		case "add_ticket" :
			$creator = getPostVar ( "creator" );
			$description = getPostVar ( "description" );
			$position = getPostVar ( "position" );
			
			if (! empty ( $creator ) && ! empty ( $description )) {
				$ticket->createTicket ( $creator, $description, $position );
			} else {
				echo ("A required field cannot be empty.");
			}
			
			break;
		
		default :
			echo ("A required field cannot be empty.");
			break;
	}
} else {
	echo ("A required field cannot be empty.");
}
?>