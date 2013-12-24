<?php
/*
 * Ticket.php Script for handling the data driven aspect of the ticket system Requires SQLite3
 * @author Helkarakse (nimcuron@gmail.com) @version 1.0
 */
require_once ("./common/ticket.inc.php");
require_once ("./common/common.inc.php");

// Variables
$ticket = new Ticket ();

// Command parser
$command = getVar ( "cmd" );
if (! empty ( $command )) {
	switch ($command) {
		case "get_new_tickets" :
			$array = $ticket->getTickets ( "new" );
			outputJson ( $array );
			break;
		
		case "get_my_tickets" :
			$username = getPostVar ( "name" );
			if (! empty ( $username )) {
				$array = $ticket->getUserTickets ( $username );
				outputJson ( $array );
			} else {
				showError ();
			}
			
			break;
		
		case "get_my_ticket_count" :
			$username = getPostVar ( "name" );
			if (! empty ( $username )) {
				$array = $ticket->countUserTickets ( $username );
				outputJson ( $array );
			} else {
				showError ();
			}
			
			break;
		
		case "get_details" :
			$id = getPostVar ( "id" );
			if (! empty ( $id )) {
				$array = $ticket->getTicket ( $id );
				outputJson ( $array );
			} else {
				showError ();
			}
			break;
		
		case "add_ticket" :
			$creator = getPostVar ( "creator" );
			$description = getPostVar ( "description" );
			$position = getPostVar ( "position" );
			
			if (! empty ( $creator ) && ! empty ( $description )) {
				$ticket->createTicket ( $creator, $description, $position );
				showSuccess ();
			} else {
				showError ();
			}
			break;
		
		case "get_issues" :
			$authLevel = getVar ( "auth_level" );
			if (! empty ( $authLevel )) {
				$array = $ticket->getIssues ( $authLevel );
				foreach ( $array as $key => $value ) {
				}
				outputJson ( $array );
			} else {
				showError ();
			}
			break;
		
		case "update_status" :
			break;
		
		default :
			showError ();
			break;
	}
} else {
	showError ();
}
?>