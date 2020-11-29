<?php 

require_once("includes/initialise.php");

if(isset($_POST['confirm_proceed'])) {
    $PartyA = $_POST['phone'];
    
    if($database->startsWith($PartyA,"07")) {
        $mob = ltrim($PartyA,"0");
        $PartyA = "254".$mob;
    } else if($database->startsWith($PartyA,"+254")) {
        $PartyA = ltrim($PartyA,"+");
    }

    $Movie_Id = $_POST['movie_id'];

    $database->set_mv_id($Movie_Id);
    $database->set_pay_phone($PartyA);
 
 //if($session->is_client_logged) { 
    if($database->has_user_paid() !== false) {
        
        $sql = $database->has_user_paid();
        
        foreach($sql as $row) {
            $active_ses = $row['SessionStatus'];
        }
    
    if($session->is_client_logged) {    
        if($active_ses == "ACTIVE") {
            header("Location: play.php?movie=".$Movie_Id);
        } else {
            header("Location: index.php?return=expired");
        }
        
    } else {
        if($active_ses == "ACTIVE") {
           // header("Location: index.php?return=blocked");
           $session->client_login($PartyA);
           
                 header("Location: play.php?movie=".$Movie_Id);
        } else if($active_ses == "INACTIVE") {
            header("Location: index.php?return=expired");
        } else if($active_ses == "PIACTIVE"){
            
            $database->set_user_session_status("ACTIVE");
            
            if($database->update_paid_user_session_status_later($PartyA,$Movie_Id)) {
                
                $session->client_login($PartyA);
           
                 header("Location: play.php?movie=".$Movie_Id);
                 
            } else {
                header("Location: index.php?return=blocked");
            }
            
        }
    }
        
        
    } else {
        header("Location: index.php?return=unpaid");
    }
    
} else {
        header("Location: index.php");
}
      
      
      
?>