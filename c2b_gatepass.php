<?php 

require_once("includes/initialise.php");

if(isset($_POST['phone']) && isset($_POST['movie_id']) && isset($_POST['mpesa_code']) && isset($_POST['movie_price'])) {
 
    $PartyA = $_POST['phone'];
    $Movie_Id = $_POST['movie_id'];
    $Mpesa_Code = strtoupper($_POST['mpesa_code']);
    $Movie_Price = $_POST['movie_price'];
  
    $database->set_mv_id($Movie_Id);
    $database->set_pay_phone($PartyA);
    $database->set_user_session_status("ACTIVE");


$database->fetch_c2b_details($Mpesa_Code);


    
                	 if($database->fetched_c2b_Amount >= $Movie_Price)  {

                            if($database->is_c2b_payment_done($Mpesa_Code)) {
                                    
                                    echo "true";
                                    $session->client_login($PartyA);

                             } else {

                                //echo "<script>clearPayment();</script>";

                                $alert->message("You haven't paid for the movie or that mpesa code has already been used before","Fail");

                            }

                	 } else {

                            $alert->message("Your amount is less than the price of movie","Fail");

                    }

               

    
} else {
       echo "<div class='d-flex justify-content-center'>
                <div class='spinner-border text-light' role='status'>
                  <span class='sr-only'>Loading...</span>
                </div>
                </div>";
}
      
      
      
?>