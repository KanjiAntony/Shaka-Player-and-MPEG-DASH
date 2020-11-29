<?php

    require_once("includes/initialise.php");
  
  if(isset($_POST['subReg'])) {
    $automation->generate_user_id();

    $userId = $automation->random_user_id;
    $username = $_POST["school_name"];
    $email = $_POST["userEmail"];
    $phoneNo = $_POST["phone"];
    $pass = $_POST["pass"];
    $conPass = $_POST["confirmPass"];

    $database->set_user_id($userId);
    $database->set_username($username);
    $database->set_email($email);
    $database->set_phone_no($phoneNo);

    if($pass == $conPass) {
      $database->set_password($pass);
      
      if($database->insert_to_reg_table()) {

            
            header("Location: login.php");


      } else {
        
        $alert->message("Failed to register","Fail");
 

      }
      
    } else {

      $alert->message("Passwords do not match","Fail");

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
      <h1>Register</h1>
      <form action="" method="post">
        <input type="text" name="school_name" class="form-control mb-4" placeholder="enter school name">

        <input type="email" name="userEmail" class="form-control mb-4" placeholder="enter contact e-mail">

        <input type="number" name="phone" class="form-control mb-4" placeholder="enter contact phone number">

        <input type="password" name="pass" class="form-control mt-4" placeholder="create a password">

        <input type="password" name="confirmPass" class="form-control mt-4" placeholder="confirm password">

        <button type="submit" value="submit" class="btn btn-primary mt-3" name="subReg">Register</button>
      </form>
      <div class="or mt-3 mb-3">
        <hr class="bar" />
        <span>OR</span>
        <hr class="bar" />
      </div>
      <a href="login.php" class="btn btn-block btn-primary" >Login</a>
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
