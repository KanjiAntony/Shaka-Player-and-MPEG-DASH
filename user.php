<?php

require_once("includes/initialise.php");

if(!empty($_POST['formation']) && !empty($_POST['analysisDate'])){
    
$format = $_POST['formation'];
$analysisDate = $_POST['analysisDate'];
              
$data = $database->fetch_movies();

foreach($data as $row) {


  $movie_name = $row["MovieName"];
  $movie_id = $row["MovieId"];
  
  //$rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner($movie_id);
  
  if($format == "Day") {
      $thatDate = new DateTime($analysisDate);
      $searchDate = $thatDate->format("Y-m-d");
      $show_format = $thatDate->format("l, d F Y");
      $title = "Showing Analysis Report of ".$show_format;
      $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner_day($movie_id,$searchDate);
 } else if($format == "Month") {
      $thatDate = new DateTime($analysisDate);
      $searchDate = $thatDate->format("Y-m-d");
      $searchDateMonth = $thatDate->format("m");
      $searchDateYear = $thatDate->format("Y");
      $show_format = $thatDate->format("F, Y");
      $title = "Showing Analysis Report of ".$show_format;
      $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner_month($movie_id,$searchDateMonth,$searchDateYear);
 } else if($format == "Year") {
      $thatDate = new DateTime($analysisDate);
      $searchDate = $thatDate->format("Y-m-d");
      $searchDateYear = $thatDate->format("Y");
      $show_format = $thatDate->format("Y");
      $title = "Showing Analysis Report of the year ".$show_format;
      $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner_year($movie_id,$searchDateYear);
 } else {
      $thatDate = new DateTime($analysisDate);
      $searchDate = $thatDate->format("Y");
      $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner($movie_id);
 }
  
  $total_rev = $database->fetched_single_mv_revenue;
  
 // echo json_encode("['".$movie_name."',".$total_rev.",'".$total_rev."'],");
 
 $output[] = array(
     "name" => $movie_name,
     "rev" => $total_rev,
     "title" => $title,
     "format" => $format
     );
     
  
}

echo json_encode($output);

} else {
    
    $output[] = array(
     "analysisDate" => "noting"
     );
     
     echo json_encode($output);
  
}

?>