<?php 

require_once("includes/initialise.php");

$movieId = $_GET['id'];

$url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  // the consumer key and secret are from the application you created on the daraja portal
  $credentials = base64_encode('your_consumer_key:your_consumer_secret');
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
  /*curl_setopt($curl, CURLOPT_HEADER, false);*/
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
  $curl_response = curl_exec($curl);

  $token = json_decode($curl_response,true)['access_token'];

$database->fetch_specific_movie_data($movieId);

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

<body id="inner-page" style="background: #282C2F">


<header class="masthead">
 <div class=" text-white">
  
  <div class="card-img-overlay">
   
      <img src="<?php echo $database->fetched_mv_photo_path; ?>" class="img-fluid" alt="Responsive image">
      <h5 class="card-title"><?php echo $database->fetched_mv_name; ?></h5>
      
      <?php 
      
       // if($session->is_client_logged) {
      
      
      ?>
                  
        
    
    <?php// } else { ?>
    
      <a href="#modal-subscribe" class="btn btn-modal" data-toggle="modal" data-movie-id="<?php echo $database->fetched_mv_id; ?>">Pay Ksh. <?php echo $database->fetched_mv_price; ?> to watch this movie</a>
      
      <p class="mt-4">Already paid for this movie? Click <a href="#modal-subscribe2" data-toggle="modal" data-movie-id="<?php echo $database->fetched_mv_id; ?>">Here to watch again</a></p>
      
     <?php //} ?> 
     
   
    
  </div>
</div>
</header>


<style>
    .btn-modal{
        background: #fe7900;
        color: #fff;
    }
    
    .card-img-overlay p a{
        color:#fe7900 ;
    }
    
    .modal .modal-body, .header, .footer{
        background: #282C2F;
    }
    
    @media(min-width:991px){
        
    }
    
    .card-img-overlay{
        display: flex;
        justify-content:center;
        flex-direction:column;
        align-items:center;
    }
    
    .card-img-overlay img{
        height:auto;
        max-height:330px;
        min-height: 330px;
    }
    
    
</style>




  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>
  <div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="modal-subscribe" aria-hidden="true">
    <div class="modal-dialog modal-tertiary modal-dialog-centered modal-lg" role="document">
        <div class="modal-content section-image overlay-dark" style="background-image: url('img/image-7.jpg')">
            <div class="header">
              <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form">
                    <h4 class="modal-title my-2 text-center">Enter your phone number to pay Ksh. <?php echo $database->fetched_mv_price; ?> to watch this movie </h4>
                    <div class="col-md-8 mx-auto">
                      <form action="confirm.php" method="post">
                      <div class="form-group">
                           <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your M-Pesa Mobile Number" required="required">
                          </div>


                      <div class="form-group">
                           <input type="hidden" class="form-control" id="movie_id" name="movie_id" required="required" value='<?php echo $movieId; ?>'>
                         </div>
                         
                    <div class="form-group">
                           <input type="hidden" class="form-control" id="price" name="movie_price" required="required" value='<?php echo $database->fetched_mv_price; ?>'>
                         </div>     
                         
                        <div class="form-group">
                           <input type="hidden" class="form-control" id="token_id" name="token_id" required="required" value='<?php echo $token; ?>'>
                         </div> 

                      <div class="form-group">
                           <button type="submit" class="btn btn-modal btn-block" id="download_movie" name="download_movie">Pay</button>
                            <br>
                            
                        </div>

                    </form>
                
                    
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="modal-subscribe2" tabindex="-1" role="dialog" aria-labelledby="modal-subscribe" aria-hidden="true">
    <div class="modal-dialog modal-tertiary modal-dialog-centered modal-lg" role="document">
        <div class="modal-content section-image overlay-dark" style="background-image: url('img/image-7.jpg')">
            <div class="header">
              <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form">
                    <h4 class="modal-title my-2 text-center"></h4>
                    <div class="col-md-8 mx-auto">
                       <form action="confirm_proceed.php" method="post">
                        
                        <h6>You will not be charged again</h6>
                      <div class="form-group">
                           <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your M-Pesa Mobile Number" required="required">
                          </div>

                      <div class="form-group">
                           <input type="hidden" class="form-control" id="movie_id" name="movie_id" required="required" value='<?php echo $movieId; ?>'>
                         </div>
                         

                      <div class="form-group">
                           <button type="submit" class="btn btn-modal btn-block" id="download_movie_proceed" name="confirm_proceed">Watch Movie</button>
                            <br>
                            
                        </div>

                    </form>
                
                    
                    </div>
                </div>
            </div>
            <div class="footer  text-center">
                <p class="text-white">
                  We’ll never share your details with third parties.
                  <br class="visible-md">View our <a href="#">Privacy Policy</a> for more info.
                </p>
            </div>
        </div>
    </div>
</div>

</body>

</html>
