# Shaka-Player-and-MPEG-DASH
This is a tutorial meant to show how to use Shaka Player, an open source JavaScript library for adaptive media, to display your videos in different resolution/quality. This player is developed by Google's and some sites like youtube.com and spearmanplus.co.ke use them.

<!DOCTYPE html>

<head>

  <title>Spearman Pictures</title>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/2.5.5/shaka-player.ui.js"></script>

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

<div data-shaka-player-container id="vid_container">
        <video id="video" data-shaka-player style="width:100%;height:100%"
               poster="" autoplay>
        </video>
        

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

<style>
body{
    background: #000;
}




#footer{
    background: transparent;
}

</style>

</body>

</html>
