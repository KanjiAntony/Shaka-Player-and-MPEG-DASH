<?php

	require_once("includes/initialise.php");
	
	$database->set_user_session_status("PIACTIVE");
	
	if($database->update_paid_user_session_status($session->client_session_id)) {
	    $session->logout_client("index.php");
	} else {
	    header("Location: index?return=fail");
	}
?>