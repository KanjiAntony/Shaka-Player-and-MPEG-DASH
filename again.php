<?php

require_once("includes/initialise.php");

$id = $_GET['id'];
$phone = $_GET['phone'];

$database->fetch_specific_movie_data($id);


?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="theme-color" content="#273138">

    <link rel="manifest" href="manifest.json">

  <title>Cinemaplus - Help Center</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald|Staatliches|Montserrat|Raleway|Teko|Anton|Didact Gothic|Varela Round|Quicksand|Abel|Fascinate Inline|Fahkwang|Hind|Open Sans|Francois One|IBM Plex Sans|Rationale|Meera Inimai|Jura|Rubik|Poppins|Nunito|Archivo Narrow">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.css" rel="stylesheet">

</head>
<style>
    .form-wrapper form .form-control{
        background: #ddd;
        border: none;
        padding: 0.5rem 1rem;
    }
    
    .form-wrapper .btn-primary{
        border-radius: 1px;
        background:#48c8fc;
        border:none;
    }
    
    .about-section{
        padding-top: 7rem;
    }
</style>



<body id="page-top">
    
    
    <div class="about-section">
        <div class="col-md-5 mx-auto">
            <div class="form-wrapper">

              
              <input type="hidden" id="PartyA" value="<?php echo $phone; ?>">
              <input type="hidden" id="MovieId" value="<?php echo $id; ?>">
              <input type="hidden" id="movie_price" value="<?php echo $database->fetched_mv_price;?>">

              <div id="c2bForm" style="display:block;">

		<p style="color:#fff;">Unfortunately we could not automatically verify your payment. To manually verify the payment, go to the payment confirmation message to Kisa Distribution that you have received from Mpesa, copy the mpesa code as shown below</p>

		<img src="img/mpesa_code.png" alt="sample_image">

		<p style="color:#fff;">Paste the mpesa code in the field below then click verify.</p>

                    <h4 id="timeout_message" style="color:#000;"></h4>
                    <br/>
                        <div class="form-group">
                           <input type="text" class="form-control" id="mpesa_code" name="mpesa_code" placeholder="Enter M-Pesa Code" required="required">
                          </div>

                      <div class="form-group">
                           <button onclick="c2bConfirmPay();" class="btn btn-modal btn-block btn-primary" id="c2bBtn" name="c2bBtn">Verify</button>
                            <br>
                            
                        </div>
                        
                </div>

		<div id="spin" style="display:block;"class="mt-5">

              </div>

                  
                
            </div>
        </div>
    </div>
  


 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

 
  <script src="js/grayscale.min.js"></script>

  <script src="Front End/automate_pay.js"></script>
  
  <script src="Front End/whatsapp_encode.js"></script>

</body>

</html>
