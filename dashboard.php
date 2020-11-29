<?php

    require_once("includes/initialise.php");

    if($session->is_logged) {

      $database->get_session_details($session->session_id); 

      //echo $database->session_user_id;

        if(isset($_POST["submit_movie"])) {

                  $mv_name = $_POST["mv_name"];

                  $mv_price = $_POST["mv_price"];
                  
                  $mv_path = $_POST["mv_path"];

                  $upload->set_photo_name($_FILES["file_upload"]["name"]);
                  $upload->set_file_type($_FILES["file_upload"]["type"]);
                  $upload->set_tmp_loc($_FILES["file_upload"]["tmp_name"]);
                  $upload->set_file_error($_FILES["file_upload"]["error"]);
                  
                  if($upload->validate_image()) {
            
                    $automation->generate_movie_id();

                    $database->set_mv_id($automation->mv_id);
                    $database->set_user_id($database->session_user_id);
                    $database->set_mv_name($mv_name);
                    $database->set_mv_stock($mv_path);
                    $database->set_mv_photo_path($upload->Object_path);
                    $database->set_mv_price($mv_price);
                    
                    if($database->insert_to_movie_table()) {
                       $alert->message("Movie Uploaded","Success");
                    } else {
                       $alert->message("Failed to Upload Movie","Fail");
                    }
                    
                  }

          }
          
        if(isset($_POST["deactivate_user"])){
            $phone = $_POST["deactivate_user_phone"];
            $movie_id = $_POST["deactivate_user_movie_id"];
            
            if($database->deactivate_paid_user_session_status_later($phone,$movie_id)) {
                $alert->message("User session Deactivated","Success");
            } else {
                $alert->message("Failed to deactivate user","Fail");
            }
            
            
        }
      
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
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald|Staatliches|Montserrat|Raleway|Roboto|Anton|Didact Gothic|Varela Round|Quicksand|Abel|Fascinate Inline|Fahkwang|Hind|Open Sans|Francois One|IBM Plex Sans|Rationale|Meera Inimai|Jura|Rubik|Poppins|Nunito|Archivo Narrow|DM Sans">
  <!-- Custom styles for this template -->
  <link href="css/admin.css" rel="stylesheet">
  
      <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
     var data;
     var data2;
     var chart;
     var chart2;
     
     var today = new Date();

      // Load the Visualization API and the piechart package.
      google.charts.load('upcoming', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      //google.charts.setOnLoadCallback(drawChart2);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        /*// Create our data table.
        data = new google.visualization.DataTable();
        data.addColumn('string', 'Movie Name');
        data.addColumn('number', 'Total Revenue');
        data.addRows([*/
        var jsonData;
         var payDisplay = document.getElementById("realtimeAnalysis");
		 
		 var analysisDate = document.getElementById("datepicker").value;
		 
        var radios = document.getElementsByName('postage');
        
        var format;

            for (var i = 0, length = radios.length; i < length; i++)
            {
             if (radios[i].checked)
             {
              // do whatever you want with the checked radio
              format = radios[i].value;
            
              // only one radio can be logically checked, don't check the rest
              break;
             } 
             
            }

        var arr = {analysisDate:analysisDate,formation: ""+format};
        var title;
        
        $.ajax({
            method: "POST",
            url: 'user.php',
            data: arr,
            //contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(response)
            {
                //var jsonData = JSON.parse(response);
                
               //console.log(response);
        
             $.each(response, function(i, response){
                         title = response.title;
                        //print([name,rev,rev]);
                   
            });
               
               printChart(response);
 
           },
           async: false
           //timeout: 1000
       });
       
       document.getElementById("analysisTitle").innerHTML = title;
       
       setTimeout('drawChart()',1000);
            
        
      }

      function printChart(response) {

        
    data = new google.visualization.DataTable();

        // Declare columns
        data.addColumn('string', 'Movie Name');
        data.addColumn('number', 'Total Revenue');
        
        var name;
        var rev;
        
         $.each(response, function(i, response){
                     name = response.name;
                     rev = parseFloat($.trim(response.rev));
                     title = response.title;
               
               // Add data.
            data.addRows([
              [name, rev],  
            ]);
                    //print([name,rev,rev]);
               
        });
        
        
        


    //});
         

        // Set chart options
        var options = {'title':title,
                        'is3D': true,
                       'width':500,
                       'height':400,
                        seriesType : 'bars'};
                        
        // Set chart options
        var options2 = {'title':title,
                        'is3D': true,
                       'width':500,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
       chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
       chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
        chart2.draw(data, options2);
      }
      
      //console.log(JSON.stringify({analysisDate:"analysisDate",formation: "format"}));

    </script>
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
    
      $(function() {
    
            $( "#datepicker" ).datepicker({
               changeMonth:true,
               changeYear:true,
               dateFormat:format,
               showAnim: "slide"
            });
         });
    </script>

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
      
<div class="row">
    
  <div class="col-12 col-md-12">
    <div class="card shadow mb-2">
      <div class="card-header"><h2>Overview</h2>
        
        <h6 class="title" id="analysisTitle"></h6>
        <div class="form-row align-items-center">
            <div class="col-md-6">
                Enter Date: <input type="text" class="form-control" id="datepicker" value="<?php echo $database->now_date_only; ?>">
            </div>
            <div class="col-md-6">
                <div class="radio-buttons">
                    <label> By Day <input type="radio" id="postageyes" name="postage" value="Day" /> 
                    <label> By Month </label><input type="radio" id="postageno" name="postage" value="Month" checked/> 
                    <label> By Year </label><input type="radio" id="postageno" name="postage" value="Year" /> 
                </div>
            </div>
            
        </div>
        
        
      
        
        
        
        
      </div>

      <div class="row mt-3">
            
        <div class="col-md-4">
            
          <div class="card gradient-1 ml-2">
            <a href="">
                <div class="card-body">
                  <h6>All Movies</h6>
                  <span><?php echo $database->fetched_mv_count;?></span>
                  <span class="float-right display-5 opacity-5"><i class="fas fa-video"></i></span> 
                </div> 
            </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card gradient-2">
           <a href="">
                <div class="card-body">
                <h6>Total Revenues</h6>
                <span><?php echo $database->fetched_mv_revenue;?></span>
                <span class="float-right display-5 opacity-5"><i class="fas fa-dollar-sign"></i></span>
                </div>
           </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card gradient-3 mr-2">
            <a href="users_analytics.php" target="_blank">
                <div class="card-body">
                <h6>All Buyers</h6>
                <span><?php echo $database->fetched_mv_buyers;?></span>
                <span class="float-right display-5 opacity-5"><i class="fas fa-users"></i></span>
            </div>
            </a>
          </div>
        </div>
        
      </div>


    </div>
</div>
    
    <br/>
    <div class="col-12 col-md-12">
    
    <div class="card">
      
      <div class="row mt-3">
            
        <div class="col-12 col-md-6 ">
            
          <div class="card shadow " id="chart_div">
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card shadow" id="chart_div2">
          </div>
        </div>

        
      </div>


    </div>
    </div>
    
    <br/>
</div>

<div class="container">
    <div class="card table-responsive table-striped mt-4" id="realtimeAnalysis">   

    </div>
</div>
    

     



  </div>
  
</section>



 
   

  <!-- Projects Section -->
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>
  <script src="Front End/analysis.js"></script>
  

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
