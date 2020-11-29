<?php 

require_once("includes/initialise.php");

?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="manifest" href="manifest.json">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#323639">

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald|Staatliches|Montserrat|Raleway|Teko|Anton|Didact Gothic|Varela Round|Quicksand|Abel|Fascinate Inline|Fahkwang|Hind|Open Sans|Francois One|IBM Plex Sans|Rationale|Meera Inimai|Jura|Rubik|Poppins|Nunito|Archivo Narrow">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.css" rel="stylesheet">
  
  <!--pwa-->
  <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
<link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="favicons/favicon.ico">
<meta name="msapplication-TileColor" content="#000000">
<meta name="msapplication-config" content="favicons/browserconfig.xml">
<meta name="theme-color" content="#000000">

</head>

<style>
    #mainNav {
    
    background-color: #202124;
}
</style>


<body id="page-top">
    <div class="top-alert">
      <?php 
  
        if(isset($_GET['return'])) {
    
        $mess = $_GET['return'];
        
        if($mess == "expired") {
             $alert->message("Your payment session expired. Pay again to watch movie.","Fail");
        } else if($mess == "unpaid") {
             $alert->message("You haven't paid for this subscription","Fail");
        } else if($mess == "blocked") {
             $alert->message("You have another active session, logout first","Fail");
        } else if($mess == "fail") {
             $alert->message("Failed to logout","Fail");
        } else {
            $alert->message($mess,"Fail");
        }
        
      }
  
  ?>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
  <div class="container-fluid">
      <div class="navbar-brand"><img src="img/logo.png" class="img-fluid" alt="Kenyan movies mobile cinema"></a></div>
     
      
  
     
      
     <!-- <div class="logout">
          
           <?php 
      
     if($session->is_client_logged) {
      
      
?>


         
         <?php } ?>
      </div>-->
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    menu
    <span class="lnr lnr-menu"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->
    </ul>
  </div>
      

  

 
  

</div>

</nav>
<header>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="10000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/cinema.jpg" class="d-block w-100" alt="">
      <div class="carousel-caption text-left">
          <h2>Mad Love</h2>
          <p> <span >New Kenyan movie/ <span class="movie">MadLove</span></span>
          <span>Duration: 53 minutes</span>
          <span>Now streaming.</span>
          <span>Watch for only Ksh 1</span>
          </p>
        </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</header>


  <!-- About Section -->

<section class="about-section">

  <div class="container mx-auto">
    
      <div class="new-title mb-4">
       
      <h6><span class="pr-2">Latest Kenyan Movies</span>/<span class="pl-2 stream">watch now </span></h6>
    </div>

    <div class="row">
        
        <?php 

            $sql = $database->fetch_from_movie_table("AQhJ909709POP-INN");

            foreach($sql as $row) {

                $movieId = $row["MovieId"];
                $ownerId = $row["OwnerId"];
                $movieName = $row["MovieName"];
                $picPath = $row["PicPath"]; 
                $movieStock = $row["Movie"];
                $moviePrice = $row["MoviePrice"];


          ?>

      <div class="col-6 col-md-3">
        <div class="single-album-area">
          <div class="album-thumb">
            <a href="inner.php?id=<?php echo $movieId; ?>"><img src="<?php echo $picPath; ?>" class="rounded" alt=""></a>
            <div class="play-icon"><a href="inner.php?id=<?php echo $movieId; ?>"><i class="fas fa-play-circle"></i></a></div>
          </div>
          <!---end of album-thumb area-->
          <div class="album-info">
            <a href="inner.php?id=<?php echo $movieId; ?>"><h5><?php echo $movieName; ?></h5></a>
            <p class="text-muted">Cinemaplus</p>
          </div>
          <!---end of album info area-->
        </div>
      </div>
      
      <?php 


                       }


      ?>


    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
             <div class="col-md-6">
                <h6>Talk To Us</h6>
                <p class="text-light">Need help with our services or would you like to become on of our content partners, contact us on <a href="https://wa.me/">Enter your number</a> </p>
            </div>
             <div class="col-md-6">
                <h6>Connect with us</h6>
                <ul class="list-unstyled">
                    <li class="facebook"><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li class="twitter"><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li class="instagram"><a href=""><i class="fab fa-instagram"></i></a></li>
                    <li class="youtube"><a href=""><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
     
         
          
              <div class="copyright mt-4 text-center text-white">
                &#xA9;
                <script>
                    document.write(new Date().getFullYear())
                </script> <a href="" target="_blank">Cinemaplus</a> All rights reserved.
               </div>
    
          
     
    </div>
</footer>
    

  <!-- Bootstrap core JavaScript -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>
  
  <script src="/upup.min.js"></script>
    <script>
    UpUp.start({
      'content-url': 'index.php',
      'assets': ['/logo.png', '', '']
    });
    </script>
    


</body>

</html>
