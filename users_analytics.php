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

  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

   <title>Cinemaplus</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald|Staatliches|Montserrat|Raleway|Roboto|Anton|Didact Gothic|Varela Round|Quicksand|Abel|Fascinate Inline|Fahkwang|Hind|Open Sans|Francois One|IBM Plex Sans|Rationale|Meera Inimai|Jura|Rubik|Poppins|Nunito|Archivo Narrow|DM Sans">

  <!-- Custom styles for this template -->
  <link href="css/admin.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="dashboard">


<nav class="navbar navbar-expand-lg fixed-top shadow navbar-light" id="dashNav">
  <div class="container">
  <a class="navbar-brand" href="#"><img src="img/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Welcome <span class="admin">Admin</span></a><!---name of school fetched from the db so its welcome: "name of school"-->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Log-out</a>
      </li>
    </ul>
    
  </div>
</div>
</nav>

<header class="bg-light text-dark header">
  <div class="container">

    <div class="row">
      <div class="col-md-10">
        <h5>Dashboard <small>Manage your site</small></h5>
      </div>

      <div class="col-md-2">
        <a href=""data-toggle="modal" data-target="#modal-subscribe">Upload Movie</a>
      </div>
    </div>
  </div>
</header>

<section id="details">
  <div class="container">

    <div class="card shadow mb-4 p-2">
      <div class="card-header"><h2>Overview</h2></div>

      <div class="row mt-3">

        <div class="col-md-4">
          <div class="card gradient-1">
            <div class="card-body">
                <h6>All Movies</h6>
            <span><?php echo $database->fetched_mv_count;?></span> 
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card gradient-2">
            <div class="card-body">
                <h6>Total Revenues</h6>
                <span><?php echo $database->fetched_mv_revenue;?></span>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card gradient-3">
           <div class="card-body">
                <h6>All Buyers</h6>
            <span><?php echo $database->fetched_mv_buyers;?></span>
           </div>
          </div>
        </div>
        
      </div>


    </div>
    
  <div class="row">
      <div class="col-md-6">
            <div class="card shadow mb-4">
        <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Distinct Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="ticketTable" width="100%" cellspacing="0">
               
                      <thead>
                        <tr>
                            <th scope="col">#</th>
                          <th scope="col">User Phone</th>
                          <th scope="col">Total Movies</th>
                          <th scope="col">Total Amount</th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php
                         
                              $total = 0;
                              $data = $database->fetch_distinct_users();
                             
                              foreach($data as $row) {
                                  
                                  $total = $total + 1;
                                  

                                 $phone = $row["Phone"];
                                 
                                 $database->fetch_total_revenue_by_user($phone);
                                 
                                 $database->fetch_total_movies_by_user($phone);
                                  
                                  
                            ?>

                        <tr>
                            <td><?php echo $total; ?></td>
                          <td><?php echo $phone; ?></td>
                          <td><?php echo $database->fetched_single_user_movies; ?></td>
                          <td><?php echo $database->fetched_single_user_revenue; ?></td>

                        </tr>

                        <?php

                            }
                            
                          

                        ?>

                      </tbody>
                    </table>
            </div>
        </div>
    </div>
      </div>
      
      <div class="col-md-6">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Invalidated users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="ticketTable" width="100%" cellspacing="0">
                  
                      <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Merchant ID</th>
                          <th scope="col">User Phone</th>
                          <th scope="col">Receipt</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Pay Date and Time</th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php
                         
                              $total = 0;
                              
                              $users = $database->fetch_all_users();
                             
                              /*foreach($users as $row1) {
                                  
                                 $MerchID = $row1["MerchantRequestID"];*/
                                 
                                 $data = $database->fetch_non_validate_users();
                             
                              foreach($data as $row) {
                                  
                                  $total = $total + 1;
                                  
                                  
                                  $pay_date = $row["TransactionDate"];

                                 $phone = $row["Phone"];
                                 $MerchantRequestID = $row["MerchantRequestID"];
                                  $receipt = $row["Receipt"];
                                 $amount = $row["Amount"];
                                  
                                  
                            ?>

                        <tr>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $MerchantRequestID; ?></td>
                          <td><?php echo $phone; ?></td>
                          <td><?php echo $receipt; ?></td>
                          <td><?php echo $amount; ?></td>
                          <td><?php echo $pay_date; ?></td>

                        </tr>

                        <?php

                            }
                            
                              //}
                            
                          

                        ?>

                      </tbody>
                    </table>
              </div>
            </div>
          </div>
      </div>
  </div>
    
    
                    
    
    

    <h2>MPESA DATA</h2>
    <table class="table-bordered table-striped"  width="100%" cellspacing="0" id="ticketTable" style="background: #fff;">
                      <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Merchant ID</th>
                          <th scope="col">User Phone</th>
                          <th scope="col">Receipt</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Pay Date and Time</th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php
                         
                              $total = 0;
                              $data = $database->fetch_all_users();
                             
                              foreach($data as $row) {
                                  
                                  $total = $total + 1;
                                  
                                  
                                  $pay_date = $row["TransactionDate"];

                                 $phone = $row["Phone"];
                                 $MerchantRequestID = $row["MerchantRequestID"];
                                  $receipt = $row["Receipt"];
                                 $amount = $row["Amount"];
                                  
                                  
                            ?>

                        <tr>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $MerchantRequestID; ?></td>
                          <td><?php echo $phone; ?></td>
                          <td><?php echo $receipt; ?></td>
                          <td><?php echo $amount; ?></td>
                          <td><?php echo $pay_date; ?></td>

                        </tr>

                        <?php

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
  
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

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
