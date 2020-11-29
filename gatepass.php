<?php 

require_once("includes/initialise.php");

if(isset($_POST['phone']) && isset($_POST['movie_id']) && isset($_POST['merchant_id'])) {
 
    $PartyA = $_POST['phone'];
    $Movie_Id = $_POST['movie_id'];
    $MerchantId = $_POST['merchant_id'];
  
    $database->set_mv_id($Movie_Id);
    $database->set_pay_phone($PartyA);
    $database->set_user_session_status("ACTIVE");

if($database->is_error_available($MerchantId)) {
    $alert->message($database->mpesa_error_desc,"Fail");
} else {
    if($database->is_payment_done($MerchantId)) {
        /*$alert->message("Payment Confirmed","Success");
       echo "<a href='play.php?movie=".$Movie_Id."' class='btn btn-primary' style=''>Watch Movie Now</a>";*/
       
       echo "true";
       $session->client_login($PartyA);
       
    } else {
        $alert->message("Please wait as we confirm your payment...","Fail");
        /*echo "<div class='d-flex justify-content-center'>
                <div class='spinner-border text-light' role='status'>
                  <span class='sr-only'>Loading...</span>
                </div>
                </div>";*/
    }
    
}
    
} else {
       echo "<div class='d-flex justify-content-center'>
                <div class='spinner-border text-light' role='status'>
                  <span class='sr-only'>Loading...</span>
                </div>
                </div>";
}
      
      
      
?>