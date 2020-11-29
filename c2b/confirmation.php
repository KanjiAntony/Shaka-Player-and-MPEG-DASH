<?php

require_once("../includes/initialise.php");

$data = file_get_contents('php://input');

//file_put_contents("confirm_callback.txt", $data);

$dat = '{

            "TransactionType":"CustomerBuyGoodsConfirmation",
            "TransactionTime":"20200114012135",
            "TransactionID":"OAE5D1UVKF",
            "TransactionAmount":1,
            "BusinessShortcode":"334089",
            "SenderMSISDN":"254705456798",
            "SenderFirstName":"JOHN",
            "SenderMiddleName":"DOE",
            "SenderLastName":"JOHN",
            "RemainingCredits":0,
            "Signature":"E\/dQrAsQXmak8wllvZZU0aane0q1wBOAO\/+nLQL8bpjneTACzzmNP8Bf\/hCqwXhK3eIC3+czKSxBST78n+bLw=",
            "PublicKey":"-----BEGIN RSA PUBLIC KEY-----\r\nMIGJAoGBAJz\naKSC6ghyrye7Uy\/dzUoNiluH9amPcQPmfb2iuG5ttpl1rHLvmXrOA9IWlczO6hlO\r\nhrhgPyLW+f6SwDkM2rQ36aMf7miyjk9xs8Lju7ioexVjNwiBAlabAgMBAAE=\r\n-----END RSA PUBLIC KEY-----"}';

$TransactionType = json_decode($data)->TransactionType;
$TransactionTime = json_decode($data)->TransactionTime;
$TransactionID = json_decode($data)->TransactionID;
$TransactionAmount = json_decode($data)->TransactionAmount;
$SenderMSISDN = json_decode($data)->SenderMSISDN;
$SenderFirstName = json_decode($data)->SenderFirstName;
$SenderMiddleName = json_decode($data)->SenderMiddleName;
$SenderLastName = json_decode($data)->SenderLastName;

$fullname = $SenderFirstName." ".$SenderMiddleName." ".$SenderLastName;

    
    // $database->set_pay_MerchantRequestID($MerchantRequestID);
    // $database->set_pay_CheckoutRequestID($CheckoutRequestID);
     $database->set_pay_amount($TransactionAmount);
     $database->set_pay_receipt($TransactionID);
     $database->set_pay_date($TransactionTime);
     $database->set_pay_phone($SenderMSISDN);
    $database->set_pay_name($fullname);
     
     /*echo "Merchant : ".$MerchantRequestID."<br/>";
     echo "Checkout : ".$CheckoutRequestID."<br/>";
     echo "Amount : ".$Amount."<br/>";
     echo "Receipt : ".$Receipt."<br/>";
     echo "Date : ".$TransactionDate."<br/>";
     echo "Phone : ".$Phone."<br/>";*/
     
     if($database->insert_to_mpesa_c2b_table()) {
        file_put_contents("confirm_callback.txt", "Successful");
         echo "Success";
     } else {
         file_put_contents("confirm_callback.txt", "Failed : ".$data);
         echo "Fail";
     }


?>