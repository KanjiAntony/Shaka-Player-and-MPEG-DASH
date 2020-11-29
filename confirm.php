<?php 

require_once("includes/initialise.php");

$PartyA = $_POST['phone'];

if($database->startsWith($PartyA,"07")) {
    $mob = ltrim($PartyA,"0");
    $PartyA = "254".$mob;
} else if($database->startsWith($PartyA,"+254")) {
    $PartyA = ltrim($PartyA,"+");
} else if($database->startsWith($PartyA,"Pay Using: ")) {
    $PartyA = ltrim($PartyA,"Pay Using: ");
}

$Movie_Id = $_POST['movie_id'];
$Movie_Price = $_POST['movie_price'];
$Token_Id = $_POST['token_id'];

$url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$Token_Id)); //setting custom header
  
  $t=time();
  //code is the store number and passkey is obtained by emailing safaricom for it
  $code = "";
  $passkey = "";
  $stamp = date("YmdHis",$t);
  $enco = $code.$passkey.$stamp;
    $pass = base64_encode($enco);
    
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $code,
    'Password' => $pass,
    'Timestamp' => date("YmdHis",$t),
    'TransactionType' => 'CustomerBuyGoodsOnline',
    'Amount' => $Movie_Price,
    'PartyA' => $PartyA,//254712473322
    'PartyB' => 'enter the till number here',
    'PhoneNumber' => $PartyA,
    'CallBackURL' => 'https://your_live_domain/callback.php',
    'AccountReference' => '',
    'TransactionDesc' => 'trial'
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  
  
/*  $curl_response = '{
      "MerchantRequestID":"18632-3961752-1", 
      "CheckoutRequestID":"ws_CO_MER_29092019093927294", 
      "ResponseCode": "0", 
      "ResponseDescription":"Success. Request accepted for processing", 
      "CustomerMessage":"Success. Request accepted for processing" }';*/
  
  $MerchantId = json_decode($curl_response,true)['MerchantRequestID'];
  
  $response_code = json_decode($curl_response,true)["ResponseCode"];
        
    $error_code = json_decode($curl_response,true)["errorCode"];
    
    if($error_code != NULL) {
        $alert->message("Failure","Fail");
        $code = false;
    } else if($response_code == 0) {
        //$alert->message("Success","Success");
        $code = true;
    } 
    

?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
<title>Cinemaplus</title>
<meta name="description" content="Kenyan movies mobile cinema"/>
<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
<link rel="canonical" href="https://www.cinemaplus.kanji.co.ke/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Kenyan movies mobile cinema" />
<meta property="og:description" content="Kenyan movies mobile cinema" />
<meta property="og:image" content="https://www.cinemaplus.kanji.co.ke/img/logo.png" />
<meta property="og:url" content="https://www.cinemaplus.kanji.co.ke/" />
<meta property="og:site_name" content="Cinemaplus" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="Kenyan movies" />
<meta name="twitter:title" content="Kenyan movies mobile cinema" />
<meta name="twitter:site" content="Cinemaplus" />
<meta name="twitter:image" content="https://www.cinemaplus.kanji.co.ke/img/logo.png" />

<meta name="google-site-verification" content="DURLV9w_0F61TAgrAeJLRpqDyXdLxsHdtyuBKDOj_xU" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153297437-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153297437-1');
</script>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald|Staatliches|Montserrat|Raleway|Teko|Anton|Didact Gothic|Varela Round|Quicksand|Abel|Fascinate Inline|Fahkwang|Hind|Open Sans|Francois One|IBM Plex Sans|Rationale|Meera Inimai|Jura|Rubik|Poppins|Nunito|Archivo Narrow">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.css" rel="stylesheet">

</head>

<body id="page-top" style="background-image: linear-gradient(to bottom, rgba(22, 22, 22, 0.8) 0%, rgba(22, 22, 22, 0.8) 75%, #161616 100%), url('img/cover.jpeg')" >
  <!--<nav class="navbar navbar-expand-lg navbar-light  fixed-top" id="mainNav">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">Kamandura Girls High School</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    Menu<span class="navbar-toggler-icon"></span>
  </button>

  
     <ul class="navbar-nav second-navbar">
      <li class="nav-item">
        <a class="nav-link mr-3" href="signin.html">Admin Login</a>
      </li>
      
     </ul>
  </div>
</div>
</nav>-->








  

  <!-- About Section -->
 
<section class="about-section">

  <div class="container">
    <h1 class="card-title text-center mt-5"><img src="img/logo.png" class="img-fluid" alt="Responsive image"></h1>
    <div class="title">
      
      <?php
      
                if($code) {
        
      ?>
           
           <input type="hidden" id="PartyA" value="<?php echo $PartyA; ?>">
           <input type="hidden" id="MovieId" value="<?php echo $Movie_Id; ?>">
           <input type="hidden" id="MerchantId" value="<?php echo $MerchantId; ?>">
      
        <div id="spin">
            <!--<div class="pinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>-->
        </div>
        
        <?php
        
            } else {
        
        ?>
        
        
            
            <h6><?php //print_r(json_decode($curl_response));?></h6>
            
            <a href="index.php"><h6>Start Again</h6></a>
            
        
        <?php } ?>
        
        <p id="countdown_message" style="color:#fff;"></p>
      
    </div>

        
    
  </div><!---end of container-fluid-->
</section>
<!-------------------geners----------------------------->

 

  
    

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>
 
<script src="Front End/automate_pay.js"></script>
</body>

</html>
