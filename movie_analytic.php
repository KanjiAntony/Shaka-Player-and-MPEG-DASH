<?php

    require_once("includes/initialise.php");

    if($session->is_logged) {

      $database->get_session_details($session->session_id); 
         
      
      $database->fetch_movie_count_by_owner($database->session_user_id);
      
      $database->fetch_total_movie_revenue_by_owner();
      
      $database->fetch_total_movie_buyers_by_owner();

      
    } else {

        header("Location: index.php");
  
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

<body id="dashboard">


<nav class="navbar navbar-expand-lg navbar-light" id="dashNav">
  <div class="container">
  <a class="navbar-brand" href="#">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Welcome</a><!---name of school fetched from the db so its welcome: "name of school"-->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Log-out</a>
      </li>
    </ul>
    
  </div>
</div>
</nav>

<header class="bg-dark text-white header">
  <div class="container">

    <div class="row">
      <div class="col-md-10">
        <h1>Dashboard <small>Manage your site</small></h1>
      </div>

      <div class="col-md-2">
        <a href=""data-toggle="modal" data-target="#modal-subscribe">Upload Movie</a>
      </div>
      


    </div>


  </div>
</header>

<section id="details">
  <div class="container">

    <div class="card">
      <div class="card-header"><h6>Overview</h6></div>

      <div class="row mt-3">

        <div class="col-md-4">
          <div class="card">
            <h3>All Movies</h3>
            <span><?php echo $database->fetched_mv_count;?> <a href="movies.php">(View All)</a></span> 
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <h3>Total Revenues</h3>
            <span><?php echo $database->fetched_mv_revenue;?></span>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <h3>All Buyers</h3>
            <span><?php echo $database->fetched_mv_buyers;?></span>
          </div>
        </div>
        
      </div>


    </div>

   <table class="table-bordered table-striped"  width="100%" cellspacing="0" id="ticketTable" style="background: #fff;">
                      <thead>
                        <tr>
                          <th scope="col">Movie Name</th>
                          <th scope="col">Movie Id</th>
                          <th scope="col">Total Revenue</th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php

                              $data = $database->fetch_movies();

                              foreach($data as $row) {


                                  $movie_name = $row["MovieName"];
                                  $movie_id = $row["MovieId"];
                                  
                                  $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner($movie_id);
                                  
                                  $total_rev = $database->fetched_single_mv_revenue;

                          ?>

                        <tr>
                          <td><?php echo $movie_name; ?></td>
                          <td><?php echo $movie_id; ?></td>
                          <td><?php echo $total_rev; ?></td>
                        </tr>

                        <?php

                            }

                        ?>

                      </tbody>
                    </table>
             
    <br/>
    <h2>ACTIVE USERS</h2>
    <table class="table-bordered table-striped"  width="100%" cellspacing="0" id="ticketTable" style="background: #fff;">
                      <thead>
                        <tr>
                            <th scope="col">#</th>
                          <th scope="col">User Phone</th>
                          <th scope="col">Movie Name</th>
                          <th scope="col">Pay Date and Time</th>
                          <th scope="col">Duration Watched</th>
                          <th scope="col">Session Status</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php
                          
                          
                          $active_user = $database->fetch_active_user();
                          
                          $total = 0;
                          
                          foreach($active_user as $act_user) {
                              
                              
                              
                              //$total = $total + 1;
                              
                              //echo $total;
                              
                              $data = $database->fetch_total_movie_customer_detail_revenue_by_owner($act_user['MerchantRequestID']);
                             
                              $today = new DateTime("now");

           // $expiry_time = new DateTime(date("Y-m-d H:i:s", strtotime($pay_date_time.$time)));

                              foreach($data as $row) {
                                  
                                  
                                  $pay_date = $row["PayDate"];

                                 $phone = $row["Phone"];
                                 $movie_id = $row["MovieId"];
                                  $movie_name = $row["MovieName"];
                                 $payDate = new DateTime($pay_date);
                                  $duration = $today->diff($payDate);
                                  
                                  $amount = $row["Amount"];
                                  $status = $row["SessionStatus"];
                                  
                                 // $expiry_time = new DateTime($payDate->add(new DateInterval('PT24H'))->format("Y-m-d H:i:s"));
                                  
                                  //$remaining_time = $payDate->diff($expiry_time);
                                  
                                  
                            ?>

                        <tr>
                            <td><?php echo $total = $total+1; ?></td>
                          <td><?php echo $phone; ?></td>
                          <td><?php echo $movie_name; ?></td>
                          <td><?php echo $pay_date; ?></td>
                          <td><?php echo $duration->format("%m months: %d days: %h hours: %i min"); ?></td>
                          <td><?php echo $status; ?></td>
                          <td><?php echo $amount; ?></td>
                          <td><form action="" method="post">
                                <input type="hidden" value="<?php echo $phone;?>" name="deactivate_user_phone">
                                <input type="hidden" value="<?php echo $movie_id;?>" name="deactivate_user_movie_id">
                                <input type="submit" value="END SESSION" name="deactivate_user">
                            </form>
                           </td>
                        </tr>

                        <?php

                            }
                            
                          }

                        ?>

                      </tbody>
                    </table>                

        
        


     



  </div>
  
</section>




  


 


 

  
        
        
   

  <!-- Projects Section -->
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>

  <div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="modal-subscribe" aria-hidden="true">
    <div class="modal-dialog modal-tertiary modal-dialog-centered modal-lg" role="document">
        <div class="modal-content section-image overlay-dark">
            <div class="modal-header">
              <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form">
                    <h4 class="modal-title my-2 text-center">Upload New Movie</h4>
                    <div class="col-md-8 mx-auto">

                      <form action="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="mv_name" class="form-control" placeholder="enter name of movie">
                        <label>Movie Poster</label>
                        <input type="file"  name="file_upload" class="form-control-file" id="exampleFormControlFile1">

                        <label>Upload Movie</label>
                        <input type="text" name="mv_path" class="form-control" placeholder="enter cdn url of video">
                        <input  name="mv_price" class="form-control mt-4" placeholder="Enter movie price">

                        <input type="submit" class="btn btn-primary mt-4" name="submit_movie" value="Upload">
                      </form>
                    
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
  

</body>

</html>
