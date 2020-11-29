<?php

  require_once("includes/initialise.php");
  
  $Movie_Id = $_GET['movie'];
  
  $database->fetch_specific_movie_data($Movie_Id)
  
 // if($database->fetch_specific_movie_data($Movie_Id)) {
      /*$alert->message("Thankyou. Welcome...","Success");
  } else {
      $*///alert->message("An error occured","Fail");
  //}

?>
<!DOCTYPE html>

<head>

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


 <script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/2.5.5/shaka-player.ui.js"></script>

    <!-- Your application source: -->
    <!-- Shaka Player ui compiled library default CSS: -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/shaka-player@2.5.5/dist/controls.css">
    <script src="play.js"></script>

<!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald|Staatliches|Montserrat|Raleway|Teko|Anton|Didact Gothic|Varela Round|Quicksand|Abel|Fascinate Inline|Fahkwang|Hind|Open Sans|Francois One|IBM Plex Sans|Rationale|Meera Inimai|Jura|Rubik|Poppins|Nunito|Archivo Narrow">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.css" rel="stylesheet">
</head>

<body id="page-top" >


 <section id="vide" class="mt-12">

<div class="container">
 
    <div id="url" style="display:none;"><?php echo $database->fetched_mv_stock; ?></div>

<div data-shaka-player-container id="vid_container">
        <video id="video" data-shaka-player style="width:100%;height:100%"
               poster="https://cinemaplus.kanji.co.ke/".<?php echo $database->fetched_mv_photo_path; ?>
               autoplay>
        </video>
        
</div>

    <br/>
   
   <h6 class="text-muted" style="color:grey; cursor:pointer;" onclick="displayOptions()">if the video is not playing, click here</h6> 
    <ol style="color:grey; display:none; " id="options">
        <li>Delete browser cache then try again</li>
        <li>Try a different browser.</li>
        <li>If using chrome, try to uninstall latest updates</li>
        <li>If problem persists, contact us on 0712473322</li>
    </ol>

</div>
  
</section>
  


 

  
        
        
   

  <!-- Projects Section -->
    <footer id="footer" class="pt-6">
 

    <div class="copyright mt-5 text-center text-white">
                &#xA9;
                
                <p>Go to<a href="index.php" target="_blank">Homepage</a></p>
    </div>
    
  </div>
</footer>

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
            <div class="modal-header">
              <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form">
                    <h4 class="modal-title my-2 text-center">Enter your phone number to buy this song</h4>
                    <div class="col-md-8 mx-auto">
                      <form>
                      <label>Phone Number</label>
                      <input type="" class="form-control" name="" placeholder="Enter your phone number">
                      <a href="" class="download">Play</a>
                    </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer z-2 mx-auto text-center">
                <p class="text-white">
                  We’ll never share your details with third parties.
                  <br class="visible-md">View our <a href="#">Privacy Policy</a> for more info.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
body{
    background: #000;
}




#footer{
    background: transparent;
}

</style>

<script>

    function displayOptions() 
    {
        var optionElement = document.getElementById("options").style.display;
        
        if(optionElement == "none") {
            document.getElementById("options").style.display = "block";
        } else {
            document.getElementById("options").style.display = "none";
        }
    }

</script>

</body>

</html>
