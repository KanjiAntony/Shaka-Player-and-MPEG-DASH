<?php 
  
    require_once("includes/initialise.php");
    
    if(isset($_POST["subLogin"])) {
      
      $email = $_POST["loginEmail"];
      $pass = $_POST["loginPass"];
      $database->set_email($email);
      $database->set_password($pass);
      
      if($database->insert_to_login_table()) {
        
        $session->login($database->fetched_user_id);

        if($session->is_logged) {


            header("Location: dashboard.php");


        } else {

          $alert->message("Failed to Login","Fail");

        }
        
      } else {

        $alert->message("Failed to Login","Fail");

      }
    }
  
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

   <title>Cinemaplus</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald|Staatliches|Montserrat|Raleway|Teko|Anton|Didact Gothic|Varela Round|Quicksand|Abel|Fascinate Inline|Fahkwang|Hind|Open Sans|Francois One|IBM Plex Sans|Rationale|Meera Inimai|Jura|Rubik|Poppins|Nunito|Archivo Narrow">

  <!-- Custom styles for this template -->
  <link href="css/grayscale.css" rel="stylesheet">

</head>

<body id="page-top">


<div class="about-section">
    <div class="col-md-5 mx-auto">

     <div id="form-wrapper">
      <h1>Login</h1>
      <form action="" method="post">
        <input type="email" name="loginEmail" class="form-control" placeholder="enter school e-mail" value="kamandura@gmail.com">

        <input type="password" name="loginPass" class="form-control mt-4" placeholder="enter a password" value="girls">

        <button type="submit" value="submit" class="btn btn-primary mt-3" name="subLogin">Login</button>
      </form>
      <div class="or mt-3 mb-3">
        <hr class="bar" />
        <span>OR</span>
        <hr class="bar" />
      </div>
      <a href="register.php" class="btn btn-block btn-primary" >Register</a>
    </div>

    </div>
  </div>
  


</div>




  


 


 

  
        
        
   

  <!-- Projects Section -->
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>
  

</body>

</html>