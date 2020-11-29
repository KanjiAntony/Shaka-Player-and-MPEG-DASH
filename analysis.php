<?php

 require_once("includes/initialise.php");
 
 if(!empty($_POST['analysisDate']) && !empty($_POST['format'])) {
     
     $analysisDate = $_POST['analysisDate'];
     $format = $_POST['format'];
     
     echo "<table class='table-bordered table-striped'  width='100%' cellspacing='0' id='ticketTable' style='background: #fff;'>
                      <thead>
                        <tr>
                          <th scope='col'>Movie Name</th>
                          <th scope='col'>Movie Id</th>
                          <th scope='col'>Total Revenue</th>
                        </tr>
                      </thead>
                      <tbody>

                          ";
                          
                          $data = $database->fetch_movies();

                              foreach($data as $row) {

                                  $movie_name = $row['MovieName'];
                                  $movie_id = $row['MovieId'];
                                  
                                       if($format == "Day") {
                                          $thatDate = new DateTime($analysisDate);
                                          $searchDate = $thatDate->format("Y-m-d");
                                          $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner_day($movie_id,$searchDate);
                                     } else if($format == "Month") {
                                          $thatDate = new DateTime($analysisDate);
                                          $searchDate = $thatDate->format("Y-m-d");
                                          $searchDateMonth = $thatDate->format("m");
                                          $searchDateYear = $thatDate->format("Y");
                                          $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner_month($movie_id,$searchDateMonth,$searchDateYear);
                                     } else if($format == "Year") {
                                          $thatDate = new DateTime($analysisDate);
                                          $searchDate = $thatDate->format("Y-m-d");
                                          $searchDateYear = $thatDate->format("Y");
                                          $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner_year($movie_id,$searchDateYear);
                                     } else {
                                          $thatDate = new DateTime($analysisDate);
                                          $searchDate = $thatDate->format("Y");
                                          $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner($movie_id);
                                     }
                                  
                                  
    if($database->fetched_single_mv_revenue === "0") {
       echo    "<tr>
                            
                          <td>$movie_name</td>
                          <td>$movie_id</td>
                          <td>No Payment</td>
                          <td><a href='movie_analytic.php?id=$movie_id&date=$searchDate'>Analytics</a></td>
                          
                        </tr>";
    } else {
         $total_rev = $database->fetched_single_mv_revenue;
         
     echo    "<tr>
                            
                          <td>$movie_name</td>
                          <td>$movie_id</td>
                          <td>$total_rev</td>
                          <td><a href='movie_analytic.php?id=".$movie_id."&date=$searchDate'>Analytics</a></td>
                          
                        </tr>";
                    

                            }
                            
    }



echo "</tbody>
                    </table>
             
    <br/>
        <div id='chart_div' style='width:400; height:300'></div>
    <br/>";
    
echo "<h2 style='color: #fff;'>ACTIVE USERS</h2>
    <table class='table-bordered table-striped'  width='100%' cellspacing='0' id='ticketTable' style='background: #fff;'>
                      <thead>
                        <tr>
                            <th scope='col'>#</th>
                          <th scope='col'>User Phone</th>
                          <th scope='col'>Movie Name</th>
                          <th scope='col'>Pay Date and Time</th>
                          <th scope='col'>Duration Watched</th>
                          <th scope='col'>Session Status</th>
                          <th scope='col'>Amount</th>
                        </tr>
                      </thead>
                      <tbody>";

                          $active_user = $database->fetch_active_user();
                          
                          $total = 0;
                          
                          foreach($active_user as $act_user) {
                              
                              
                              
                              //$total = $total + 1;
                              
                             // echo $total;
                              
                              $data = $database->fetch_total_movie_customer_detail_revenue_by_owner($act_user['MerchantRequestID']);
                             
                              $today = new DateTime('now');

           // $expiry_time = new DateTime(date('Y-m-d H:i:s', strtotime($pay_date_time.$time)));

                              foreach($data as $row) {
                                  
                                  
                                  $pay_date = $row['PayDate'];

                                 $phone = $row['Phone'];
                                 $movie_id = $row['MovieId'];
                                  $movie_name = $row['MovieName'];
                                 $payDate = new DateTime($pay_date);
                                  $duration = $today->diff($payDate);
                                  
                                  $amount = $row['Amount'];
                                  $status = $row['SessionStatus'];
                                  
                                 // $expiry_time = new DateTime($payDate->add(new DateInterval('PT24H'))->format('Y-m-d H:i:s'));
                                  
                                  //$remaining_time = $payDate->diff($expiry_time);
                                  $total = $total+1;
                                  

     echo "<tr>
                            <td>$total</td>
                          <td>$phone</td>
                          <td>$movie_name</td>
                          <td>$pay_date</td>
                          <td>".$duration->format('%d days: %h hours: %i min: %s s')."</td>
                          <td>$status</td>
                          <td>$amount</td>
                          <td><form action='' method='post'>
                                <input type='hidden' value='$phone' name='deactivate_user_phone'>
                                <input type='hidden' value='$movie_id' name='deactivate_user_movie_id'>
                                <input type='submit' value='END SESSION' name='deactivate_user'>
                            </form>
                           </td>
                        </tr>";


                            }
                            
                          }

        echo "</tbody>
                    </table> ";
     
     
 } else {

   echo "<table class='table-bordered table-striped'  width='100%' cellspacing='0' id='ticketTable' style='background: #fff;'>
                      <thead>
                        <tr>
                          <th scope='col'>Movie Name</th>
                          <th scope='col'>Movie Id</th>
                          <th scope='col'>Total Revenue</th>
                        </tr>
                      </thead>
                      <tbody>

                          ";

                              $data = $database->fetch_movies();

                              foreach($data as $row) {


                                  $movie_name = $row['MovieName'];
                                  $movie_id = $row['MovieId'];
                                  
                                  $rev_data = $database->fetch_total_movie_detail_for_revenue_by_owner($movie_id);
                                  
                                  $total_rev = $database->fetched_single_mv_revenue;

     echo    "<tr>
                            
                          <td>$movie_name</td>
                          <td>$movie_id</td>
                          <td>$total_rev</td>
                          <td><a href='movie_analytic.php?id=".$movie_id."'>Analytics</a></td>
                          
                        </tr>";
                    

                            }



echo "</tbody>
                    </table>
             
    <br/>
        <div id='chart_div' style='width:400; height:300'></div>
    <br/>";
    
echo "<h2 style='color: #fff;'>ACTIVE USERS</h2>
    <table class='table-bordered table-striped'  width='100%' cellspacing='0' id='ticketTable' style='background: #fff;'>
                      <thead>
                        <tr>
                            <th scope='col'>#</th>
                          <th scope='col'>User Phone</th>
                          <th scope='col'>Movie Name</th>
                          <th scope='col'>Pay Date and Time</th>
                          <th scope='col'>Duration Watched</th>
                          <th scope='col'>Session Status</th>
                          <th scope='col'>Amount</th>
                        </tr>
                      </thead>
                      <tbody>";

                          $active_user = $database->fetch_active_user();
                          
                          $total = 0;
                          
                          foreach($active_user as $act_user) {
                              
                              
                              
                              //$total = $total + 1;
                              
                             // echo $total;
                              
                              $data = $database->fetch_total_movie_customer_detail_revenue_by_owner($act_user['MerchantRequestID']);
                             
                              $today = new DateTime('now');

           // $expiry_time = new DateTime(date('Y-m-d H:i:s', strtotime($pay_date_time.$time)));

                              foreach($data as $row) {
                                  
                                  
                                  $pay_date = $row['PayDate'];

                                 $phone = $row['Phone'];
                                 $movie_id = $row['MovieId'];
                                  $movie_name = $row['MovieName'];
                                 $payDate = new DateTime($pay_date);
                                  $duration = $today->diff($payDate);
                                  
                                  $amount = $row['Amount'];
                                  $status = $row['SessionStatus'];
                                  
                                 // $expiry_time = new DateTime($payDate->add(new DateInterval('PT24H'))->format('Y-m-d H:i:s'));
                                  
                                  //$remaining_time = $payDate->diff($expiry_time);
                                  

     echo "<tr>
                            <td>".$total = $total+1 ."</td>
                          <td>$phone</td>
                          <td>$movie_name</td>
                          <td>$pay_date</td>
                          <td>".$duration->format('%d days: %h hours: %i min: %s s')."</td>
                          <td>$status</td>
                          <td>$amount</td>
                          <td><form action='' method='post'>
                                <input type='hidden' value='$phone' name='deactivate_user_phone'>
                                <input type='hidden' value='$movie_id' name='deactivate_user_movie_id'>
                                <input type='submit' value='END SESSION' name='deactivate_user'>
                            </form>
                           </td>
                        </tr>";


                            }
                            
                          }

        echo "</tbody>
                    </table> ";
                    
 }

?>