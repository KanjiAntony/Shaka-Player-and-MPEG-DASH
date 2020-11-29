<?php

require_once("includes/initialise.php");

$data = file_get_contents('php://input');

 $file = 'callback.txt'; //Please make sure that this file exists and is writable 
 $fh = fopen($file, 'a+'); 
fwrite($fh, "\n====".date("d-m-Y H:i:s")."====\n"); 
fwrite($fh, $data."\n"); 

$da = '{"Body":{"stkCallback":{"MerchantRequestID":"20481-4541744-1","CheckoutRequestID":"ws_CO_290120201452296966","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1},{"Name":"MpesaReceiptNumber","Value":"OAT8OYEF9WS"},{"Name":"TransactionDate","Value":20200129145210},{"Name":"PhoneNumber","Value":254712473322}]}}}}';

$dat = '{
    "Body":
                {
                    "stkCallback":
                        {
                            "MerchantRequestID":"16021-2575210-1",
                            "CheckoutRequestID":"ws_CO_MER_28092019111509902",
                            "ResultCode":0,
                            "ResultDesc":"The service request is processed successfully.",
                            "CallbackMetadata":
                                {
                                    "Item":
                                        [
                                            {
                                                "Name":"Amount","Value":5
                                                
                                            },
                                                {
                                                    "Name":"MpesaReceiptNumber","Value":"NIS1VA1167"
                                                    
                                                },
                                                {
                                                    "Name":"Balance"
                                                    
                                                },
                                                {"Name":"TransactionDate","Value":20190928111518},{"Name":"PhoneNumber","Value":254712473322}]}}}}';
  
  //for($i=0;$i<5;$i++) {  
  
     $callback_count = count(json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item']);
     
     if($callback_count === 5) {
         $MerchantRequestID = json_decode($data,true)['Body']['stkCallback']['MerchantRequestID'];
          $CheckoutRequestID = json_decode($data,true)['Body']['stkCallback']['CheckoutRequestID'];
          $result_code = json_decode($data,true)['Body']['stkCallback']['ResultCode'];
          $result_desc = json_decode($data,true)['Body']['stkCallback']['ResultDesc'];
            $Amount = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
             $Receipt = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
             $TransactionDate = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
             $Phone = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
     } else {
         $MerchantRequestID = json_decode($data,true)['Body']['stkCallback']['MerchantRequestID'];
          $CheckoutRequestID = json_decode($data,true)['Body']['stkCallback']['CheckoutRequestID'];
          $result_code = json_decode($data,true)['Body']['stkCallback']['ResultCode'];
          $result_desc = json_decode($data,true)['Body']['stkCallback']['ResultDesc'];
             $Amount = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
             $Receipt = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
             $TransactionDate = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][2]['Value'];
             $Phone = json_decode($data,true)['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
     }
     
     $database->set_pay_MerchantRequestID($MerchantRequestID);
     $database->set_pay_CheckoutRequestID($CheckoutRequestID);
     $database->set_pay_amount($Amount);
     $database->set_pay_receipt($Receipt);
     $database->set_pay_date($TransactionDate);
     $database->set_pay_phone($Phone);
     
     $LNMP_Query_data = $database->LNMP_Query($CheckoutRequestID);
     
      $query_file = 'callback_query.txt'; //Please make sure that this file exists and is writable 
     $fh_query = fopen($query_file, 'a+'); 
    fwrite($fh_query, "\n====".date("d-m-Y H:i:s")."====\n"); 
    fwrite($fh_query, $LNMP_Query_data."\n"); 
     fclose($fh_query);
     
     $LNMP_Query_CheckoutRequestID = json_decode($LNMP_Query_data)->CheckoutRequestID;
     
     if($LNMP_Query_CheckoutRequestID == $CheckoutRequestID) {
     
         if($result_code === 0) {
         
             if($database->insert_to_mpesa_table()) {
                 fwrite($fh, "Successful STK\n"); 
                 fclose($fh);
             } else {
                 fwrite($fh, "Failed STK\n"); 
                 fclose($fh);
             }
             
         } else {
             if($database->insert_to_mpesa_errors_table($MerchantRequestID,$CheckoutRequestID,$result_code,$result_desc)) {
                 fwrite($fh, "Successful Error logged\n"); 
                 fclose($fh);
             } else {
                 fwrite($fh, "Error failed to log\n"); 
                 fclose($fh);
             }
         }
         
     } else {
         echo "Wrong information bro";
     }
     
    // file_put_contents("callback.txt", $data);
    //print_r($Item1);
  //}
 //echo json_decode($data);

?>