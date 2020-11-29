<?php

require_once("initialise.php");

class database extends alerts{
		public $dbase;
		public $user_email,
				$admin_email,
				$admin_code,
				$user_id,
				$username,
				$phone_no,
				$usertype,
				$profile_pic,
				$cover_pic,
				$open_days,
				$open_time,
				$close_time,
				$address,
				$city,
				$country,
				$password,
				$fetched_email,
				$fetched_user_id,
				$regDate,
				$regTime;
		public $mpesa_merchant_id,$mpesa_checkout_id,$mpesa_nopay,$mpesa_phone,$mpesa_pay_date,$mpesa_pay_name,$mpesa_receipt,$mpesa_error_desc,
		        $fetched_c2b_TransactionDate,$fetched_c2b_Receipt,$fetched_c2b_Amount,$fetched_stk_Receipt;
		public $mpesa_token;
		private $regTable = "moviesreg";
		private $userRegTable = "movieuser";
		private $loginTable = "movieslogin";
		private $movieTable = "movies_store";
		private $mpesaTable = "mpesa_data";
		private $mpesaC2BTable = "mpesa_c2b_data";
		private $mpesaErrorsTable = "mpesa_errors";
		private $mpesaAuthTable = "mpesa_auth";
		private $paymentTable = "movies_payment";

		public $stmt;
		public $session_email,$session_user_id,$session_username,$session_user_type,$session_phone,$session_regDate,$session_regTime,$session_status,$now_date,$now_date_only;

		public $mv_category,$mv_name,$mv_description,$mv_stock,$mv_no_tables,$mv_id,$mv_price,$mv_location,$mv_vacancy,$mv_qty,$mv_date
				,$mv_time,$mv_stop_date,$mv_stop_time,$mv_photo_path,$cart_id,$cart_status,$total;

		public $fetched_mv_category,$fetched_mv_name,$fetched_mv_count,$fetched_mv_description,$fetched_mv_stock,$fetched_mv_id,$fetched_mv_price,$fetched_mv_location,
				$fetched_mv_qty,$fetched_mv_date,$fetched_mv_time,$fetched_mv_stop_date,$fetched_mv_stop_time,$fetched_mv_photo_path,$fetched_mv_revenue,$fetched_mv_buyers,$fetched_single_mv_revenue,$fetched_single_user_revenue
				,$fetched_single_user_movies;
				

		public $post_id,$post_title,$post_data,$post_photo_path;
		public $regUserId,$regUsername,$regUserEmail,$regUserPhone,$full_name;
		public $fetchedPayId,$fetchedPayUserId,$fetchedPayAmount,$fetchedPayMethod,$fetchedPayStat,$fetchedPayDate,$fetchedPayTime;

		public function __construct()
		{
			$this->connect();
		}


		public function connect()
		{

			try {

				$this->dbase = new PDO("mysql:host=".server.";dbname=".database,user,pass);

				

			}catch(PDOException $e) {

				echo "Failed to connect to db ".$e->getMessage();

			}

			$this->dbase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			date_default_timezone_set('Africa/Nairobi');
			
			$this->now_date = date("Y-m-d H:i:s");
			
			$this->now_date_only = date("Y-m-d");

		}
		public function set_email($email)
		{
			$this->user_email = $email;
		}

		public function set_user_id($userId)
		{
			$this->user_id = $userId;
		}

		public function set_username($username)
		{
			$this->username = $username;
		}

		public function set_full_name($fname,$lname)
		{
			$this->full_name = $fname." ".$lname;
		}

		public function set_phone_no($phoneNo)
		{
			$this->phone_no = $phoneNo;
		}

		public function set_user_type($usertype)
		{
			$this->usertype = $usertype;
		}
		
		public function set_address($address)
		{
			$this->address = $address;
		}

		public function set_city($city)
		{
			$this->city = $city;
		}

		public function set_country($country)
		{
			$this->country = $country;
		}

		public function set_password($pass)
		{
			$this->password = md5($pass);
		}

		public function set_photo_id($photoid)
		{
			$this->photo_id = $photoid;
		}

		public function set_photo_name($photoname)
		{
			$this->photo_name = $photoname;
		}

		public function set_photo_desc($photodesc)
		{
			$this->photo_desc = $photodesc;
		}

		public function set_photo_path($photopath)
		{
			$this->photo_path = $photopath;
		}

		public function set_post_id($postid) 
		{
			$this->post_id = $postid;
		}

		public function set_post_title($title)
		{
			$this->post_title = $title;
		}

		public function set_post_data($postdata)
		{
			$this->post_data = $postdata;
		}

		public function set_post_photo_path($photopath)
		{
			$this->post_photo_path = $photopath;
		}
		
		public function set_prod_id($prod_id)
		{
			$this->prod_id = $prod_id;
		}
		
		public function set_cart_id($cartId)
		{
			$this->cart_id = $cartId;
		}
		
		public function set_cart_status($cartStatus)
		{
			$this->cart_status = $cartStatus;
		}

		public function set_mv_id($mv_id)
		{
			$this->mv_id = $mv_id;
		}
		
		public function set_mv_category($category)
		{
			$this->mv_category = $category;
		}
		
		public function set_mv_name($name)
		{
			$this->mv_name = $name;
		}
		
		public function set_mv_description($mv_desc)
		{
			$this->mv_description = $mv_desc;
		}
		
		public function set_mv_stock($mv_stock)
		{
			$this->mv_stock = $mv_stock;
		}
		
		public function set_mv_no_seats($mv_no_tables)
		{
			$this->mv_no_tables = $mv_no_tables;
		}
		
		public function set_mv_qty($mv_qty)
		{
			$this->mv_qty = $mv_qty;
		}
		
		public function set_mv_photo_path($mv_photo_path)
		{
			$this->mv_photo_path = $mv_photo_path;
		}
		
		public function set_mv_price($mv_price)
		{
			$this->mv_price = $mv_price;
		}

		public function set_mv_location($mv_location)
		{
			$this->mv_location = $mv_location;
		}
		
		public function set_mv_vacancy($mv_vacancy)
		{
			$this->mv_vacancy = $mv_vacancy;
		}

		public function set_mv_date($mv_start)
		{
			$this->mv_date = $mv_start;
		}
		
		public function set_pay_token($mpesa_token)
		{
		    $this->mpesa_token = $mpesa_token;
		}
		
		public function set_user_session_status($stat)
		{
		    $this->session_status = $stat;
		}
		
		public function set_pay_MerchantRequestID($mpesa_merchant_id)
		{
		    $this->mpesa_merchant_id = $mpesa_merchant_id;
		}
		
		public function set_pay_CheckoutRequestID($mpesa_checkout_id)
		{
		    $this->mpesa_checkout_id = $mpesa_checkout_id;
		}
		
		public function set_pay_amount($mpesa_pay)
		{
		    $this->mpesa_pay = $mpesa_pay;
		}
		
		public function set_pay_name($mpesa_pay)
		{
		    $this->mpesa_pay_name = $mpesa_pay;
		}

        public function set_pay_receipt($mpesa_receipt)
		{
		    $this->mpesa_receipt = $mpesa_receipt;
		}
		
		public function set_pay_date($mpesa_pay_date)
		{
		    $this->mpesa_pay_date = $mpesa_pay_date;
		}
		
		public function set_pay_phone($mpesa_phone)
		{
		    $this->mpesa_phone = $mpesa_phone;
		}
		
		public function insert_to_movie_table()
		{
			$this->stmt = $this->dbase->prepare("INSERT INTO $this->movieTable(MovieId,OwnerId,MovieName,PicPath,Movie,MoviePrice,UploadDate,UploadTime) 
			VALUES(?,?,?,?,?,?,now(),now() )");

			$this->stmt->bindParam(1,$this->mv_id);
			$this->stmt->bindParam(2,$this->user_id);
			$this->stmt->bindParam(3,$this->mv_name);
			$this->stmt->bindParam(4,$this->mv_photo_path);
			$this->stmt->bindParam(5,$this->mv_stock);
			$this->stmt->bindParam(6,$this->mv_price);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}
		}
		
		public function insert_to_mpesa_table()
		{
			$this->stmt = $this->dbase->prepare("INSERT INTO $this->mpesaTable(MerchantRequestID,CheckoutRequestID,Receipt,Phone,Amount,TransactionDate) 
			VALUES(?,?,?,?,?,?)");

            $this->stmt->bindParam(1,$this->mpesa_merchant_id);
            $this->stmt->bindParam(2,$this->mpesa_checkout_id);
			$this->stmt->bindParam(3,$this->mpesa_receipt);
			$this->stmt->bindParam(4,$this->mpesa_phone);
			$this->stmt->bindParam(5,$this->mpesa_pay);
			$this->stmt->bindParam(6,$this->mpesa_pay_date);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}
		}
		
		public function get_mpesa_token()
		{
		    $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  
              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, $url);
              $credentials = base64_encode('your_consumer_key:your_consumer_secret');
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
              /*curl_setopt($curl, CURLOPT_HEADER, false);*/
              curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              
              $curl_response = curl_exec($curl);
            
              return json_decode($curl_response,true)['access_token'];
		}
		
		public function LNMP_Query($check)
		{
		     $url = 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query';
		     
			 $t=time();
			 //code is the store number and passkey is obtained by emailing safaricom for it
             $code = "";
              $passkey = "";
              $stamp = date("YmdHis",$t);
              $enco = $code.$passkey.$stamp;
                $pass = base64_encode($enco);
  
              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->get_mpesa_token())); //setting custom header
              
              
              $curl_post_data = array(
                //Fill in the request parameters with valid values
                'BusinessShortCode' =>$code,
                'Password' =>$pass,
                'Timestamp' =>$stamp,
                'CheckoutRequestID' =>$check
              );
              
              $data_string = json_encode($curl_post_data);
              
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_POST, true);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
              
             return $curl_response = curl_exec($curl);
             
		}
		
		public function insert_to_mpesa_errors_table($mpesa_merchant_id,$mpesa_checkout_id,$mpesa_result_code,$mpesa_result_desc)
		{
			$this->stmt = $this->dbase->prepare("INSERT INTO $this->mpesaErrorsTable(MerchantRequestID,CheckoutRequestID,ResultCode,ResultDesc) 
			VALUES(?,?,?,?)");

            $this->stmt->bindParam(1,$mpesa_merchant_id);
            $this->stmt->bindParam(2,$mpesa_checkout_id);
			$this->stmt->bindParam(3,$mpesa_result_code);
			$this->stmt->bindParam(4,$mpesa_result_desc);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}
		}
		
		public function insert_to_mpesa_c2b_table()
		{
			$sql = $this->dbase->query("SELECT * FROM $this->mpesaC2BTable WHERE Receipt='$this->mpesa_receipt'");

			if($sql->rowCount() > 0 ) {

				$this->stmt = $this->dbase->prepare("UPDATE $this->mpesaC2BTable SET Receipt=?,Phone=?,Amount=?,Name=?,TransactionDate=? WHERE Receipt=?");

					$this->stmt->bindParam(1,$this->mpesa_receipt);
					$this->stmt->bindParam(2,$this->mpesa_phone);
					$this->stmt->bindParam(3,$this->mpesa_pay);
					$this->stmt->bindParam(4,$this->mpesa_pay_name);
					$this->stmt->bindParam(5,$this->mpesa_pay_date);
					$this->stmt->bindParam(6,$this->mpesa_receipt);
					$this->stmt->execute();

					if($this->stmt) {
						return true;
					} else {
						return false;
					}

			} else {

					$this->stmt = $this->dbase->prepare("INSERT INTO $this->mpesaC2BTable(Receipt,Phone,Amount,Name,TransactionDate)
					VALUES(?,?,?,?,?)");

					$this->stmt->bindParam(1,$this->mpesa_receipt);
					$this->stmt->bindParam(2,$this->mpesa_phone);
					$this->stmt->bindParam(3,$this->mpesa_pay);
                    $this->stmt->bindParam(4,$this->mpesa_pay_name);
					$this->stmt->bindParam(5,$this->mpesa_pay_date);
					$this->stmt->execute();

					if($this->stmt) {
						return true;
					} else {
						return false;
					}

			}
		}
		
		public function is_error_available($mpesa_merchant_id)
		{
		    $sql = $this->dbase->query("SELECT * FROM $this->mpesaErrorsTable WHERE MerchantRequestID='$mpesa_merchant_id'");
			
			if($sql->rowCount() > 0 ) {
			    
			        foreach($sql as $row) {
			            $this->mpesa_error_desc = $row["ResultDesc"];
			        }
			        
			        return true;
			    
			} else {
			    return false;
			}
		}
		
		public function fetch_c2b_details($mpesa_code)
		{

			$sql = $this->dbase->query("SELECT * FROM $this->mpesaC2BTable WHERE Receipt='$mpesa_code' ");

			if($sql->rowCount() > 0 ) {

				foreach($sql as $row) {

							$this->fetched_c2b_Receipt = $row["Receipt"];
							$this->fetched_c2b_Amount = $row["Amount"];
							$this->fetched_c2b_TransactionDate = $row["TransactionDate"];

				}

			} else {

				return false;

			}

		}

		public function fetch_stk_details($MerchantId)
		{

			$sql = $this->dbase->query("SELECT * FROM $this->mpesaTable WHERE MerchantRequestID='$MerchantId' ");

			if($sql->rowCount() > 0 ) {

				foreach($sql as $row) {

							$this->fetched_stk_Receipt = $row["Receipt"];
							/*$this->fetched_c2b_Amount = $row["Amount"];
							$this->fetched_c2b_TransactionDate = $row["TransactionDate"];*/

				}

			} else {

				return false;

			}

		}
		
		public function insert_to_mpesa_auth_table()
		{
			$this->stmt = $this->dbase->prepare("INSERT INTO $this->mpesaAuthTable(Token,Time) VALUES(?,now())");

			$this->stmt->bindParam(1,$this->mpesa_token);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}
		}
		
		public function is_payment_done($MerchantId)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->mpesaTable WHERE MerchantRequestID='$MerchantId'");
			
			if($sql->rowCount() > 0 ) {
			    
			    $this->fetch_stk_details($MerchantId);
			    
			        //update if already saved
    			$sql2 = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE MerchantRequestID='$this->fetched_stk_Receipt'");
    			
    			if($sql2->rowCount() > 0 ) {
    			    
    			    $this->stmt = $this->dbase->prepare("UPDATE $this->paymentTable SET MerchantRequestID=?,MovieId=?,Phone=?,SessionStatus=? WHERE MerchantRequestID=? ");

                    $this->stmt->bindParam(1,$this->fetched_stk_Receipt);
                    $this->stmt->bindParam(2,$this->mv_id);
        			$this->stmt->bindParam(3,$this->mpesa_phone);
        			$this->stmt->bindParam(4,$this->session_status);
        			$this->stmt->bindParam(5,$MerchantId);
        			$this->stmt->execute();
        
        			if($this->stmt) {
        				return true;
        			} else {
        				return false;
        			}
    			    
    			} else {
			    
			         $this->stmt = $this->dbase->prepare("INSERT INTO $this->paymentTable(MerchantRequestID,MovieId,Phone,SessionStatus,PayDate) 
			                                        VALUES(?,?,?,?,?)");

                    $this->stmt->bindParam(1,$this->fetched_stk_Receipt);
                    $this->stmt->bindParam(2,$this->mv_id);
        			$this->stmt->bindParam(3,$this->mpesa_phone);
        			$this->stmt->bindParam(4,$this->session_status);
        			$this->stmt->bindParam(5,$this->now_date);
        			$this->stmt->execute();
        
        			if($this->stmt) {
        				return true;
        			} else {
        				return false;
        			}
        			
    			}
			    
			} else {
			    return false;
			}
		}
		
		public function is_c2b_payment_done($MpesaCode)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->mpesaC2BTable WHERE Receipt='$MpesaCode'");

			if($sql->rowCount() > 0 ) {

			        //update if already saved
    			$sql2 = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE MerchantRequestID='$MpesaCode'");

    			if($sql2->rowCount() > 0 ) {

        			return false;

    			} else {

			         $this->stmt = $this->dbase->prepare("INSERT INTO $this->paymentTable(MerchantRequestID,MovieId,Phone,SessionStatus,PayDate)
			                                        VALUES(?,?,?,?,?)");

                    $this->stmt->bindParam(1,$MpesaCode);
                    $this->stmt->bindParam(2,$this->mv_id);
        			$this->stmt->bindParam(3,$this->mpesa_phone);
        			$this->stmt->bindParam(4,$this->session_status);
        			$this->stmt->bindParam(5,$this->now_date);
        			$this->stmt->execute();

        			if($this->stmt) {
        				return true;
        			} else {
        				return false;
        			}

    			}

			} else {
			    return false;
			}
		}
		
		public function update_paid_user_session_status($Phone)
		{
		    
		    $sql2 = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE Phone='$Phone' AND SessionStatus='ACTIVE' ");
    			
    			if($sql2->rowCount() > 0 ) {
    			    
    			    $this->stmt = $this->dbase->prepare("UPDATE $this->paymentTable SET SessionStatus=? WHERE Phone=? AND SessionStatus='ACTIVE' ");

                    $this->stmt->bindParam(1,$this->session_status);
        			$this->stmt->bindParam(2,$Phone);
        			$this->stmt->execute();
        
        			if($this->stmt) {
        				return true;
        			} else {
        				return false;
        			}
    			    
    			} else {
    			    return false;
    			} 
		    
		    
		}
		
		public function update_paid_user_session_status_later($Phone,$MovieId)
		{
		    
		    $sql2 = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE Phone='$Phone' AND MovieId='$MovieId' ");
    			
    			if($sql2->rowCount() > 0 ) {
    			    
    			    $this->stmt = $this->dbase->prepare("UPDATE $this->paymentTable SET SessionStatus=? WHERE Phone=? AND SessionStatus='PIACTIVE' ");

                    $this->stmt->bindParam(1,$this->session_status);
        			$this->stmt->bindParam(2,$Phone);
        			$this->stmt->execute();
        
        			if($this->stmt) {
        				return true;
        			} else {
        				return false;
        			}
    			    
    			} else {
    			    return false;
    			} 
		    
		    
		}
		
		public function deactivate_paid_user_session_status_later($Phone,$MovieId)
		{
		    
		    $sql2 = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE Phone='$Phone' AND MovieId='$MovieId' ");
    			
    			if($sql2->rowCount() > 0 ) {
    			    
    			    $this->stmt = $this->dbase->prepare("UPDATE $this->paymentTable SET SessionStatus='DEACT' WHERE Phone=? AND MovieId='$MovieId' AND SessionStatus='ACTIVE' ");

        			$this->stmt->bindParam(1,$Phone);
        			$this->stmt->execute();
        
        			if($this->stmt) {
        				return true;
        			} else {
        				return false;
        			}
    			    
    			} else {
    			    return false;
    			} 
		    
		    
		}
		
		public function startsWith($string, $startString) 
        { 
            $len = strlen($startString); 
            return (substr($string, 0, $len) === $startString); 
        } 
		
		public function has_user_paid()
		{
		    $sql = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE Phone='$this->mpesa_phone' AND MovieId='$this->mv_id' ORDER BY PayDate ASC");
			
			if($sql->rowCount() > 0 ) {
			    
			         return $sql;
			    
			} else {
			    return false;
			}
		}
		
		/*public function has_user_paid_session_active()
		{
		    $sql = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE Phone='$this->mpesa_phone' AND MovieId='$this->mv_id' ");
			
			if($sql->rowCount() > 0 ) {
			    
			         return true;
			    
			} else {
			    return false;
			}
		}*/

		public function update_movie_table($UserId)
		{
			$this->stmt = $this->dbase->prepare
			("UPDATE $this->movieTable SET MovieId=?,OwnerId=?,MovieName=?,PicPath=?,Movie=?,MoviePrice=?,
				UploadDate=now(),UploadTime=now() WHERE MovieId=? AND OwnerId='$UserId' ");

			$this->stmt->bindParam(1,$this->mv_id);
			$this->stmt->bindParam(2,$this->user_id);
			$this->stmt->bindParam(3,$this->mv_name);
			$this->stmt->bindParam(4,$this->mv_photo_path);
			$this->stmt->bindParam(5,$this->mv_stock);
			$this->stmt->bindParam(6,$this->mv_price);
			$this->stmt->bindParam(7,$this->mv_id);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}
		}
		
		
		public function search_movies($keyword)
		{

			$this->stmt = $this->dbase->prepare("SELECT * FROM $this->movieTable WHERE Category LIKE ? OR MovieName LIKE ? 
				OR MovieDesc LIKE ? OR MovieLocation LIKE ? ");

			$this->stmt->execute(array("%".$keyword."%","%".$keyword."%","%".$keyword."%","%".$keyword."%"));

			return $this->stmt;

		}
		
		public function delete_movie($movie_id)
		{

			$this->stmt = $this->dbase->prepare("DELETE FROM $this->movieTable WHERE MovieId=? ");

			$this->stmt->bindParam(1,$movie_id);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}

		}
		
		public function fetch_from_movie_table_by_category_index($Cat)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->movieTable WHERE Category='$Cat' ORDER BY MovieDate ASC LIMIT 4");
			
			return $sql;
		}
		
		public function fetch_from_movie_table_by_category($Cat)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->movieTable WHERE Category='$Cat' ORDER BY MovieDate");
			
			return $sql;
		}
		
		public function fetch_from_movie_table($ownerId)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->movieTable WHERE OwnerId='$ownerId' ORDER BY UploadDate,UploadTime ASC LIMIT 12");
			
			return $sql;
		}
		
		public function fetch_from_movie_table_by_club($ownerId)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->movieTable WHERE OwnerId='$ownerId' ORDER BY MovieDate LIMIT 12");
			
			if($sql->rowCount() > 0) {
				return $sql;
			} else {
				echo "<h2>NO MOVIES AT THE MOMENT</h2>";
			}
			
		}

		public function fetch_movie_count_by_owner($OwnerId)
		{

			$sql = $this->dbase->query("SELECT COUNT(*) as total_movies FROM $this->movieTable WHERE OwnerId='$OwnerId'  ");

			foreach($sql as $row) {
				$this->fetched_mv_count = $row["total_movies"];
			}

		}
		

		public function fetch_specific_movie_data($movie_id)
		{

			$sql = $this->dbase->query("SELECT * FROM $this->movieTable WHERE MovieId='$movie_id' ");
			
			if($sql->rowCount() > 0 ) {

				foreach($sql as $row) {

							$this->fetched_mv_id = $row["MovieId"];
							$this->fetched_user_id = $row["OwnerId"];
							$this->fetched_mv_name = $row["MovieName"];
							$this->fetched_mv_photo_path = $row["PicPath"];
							$this->fetched_mv_stock = $row["Movie"];
							$this->fetched_mv_price = $row["MoviePrice"];
							$this->fetched_mv_date = $row["UploadDate"];
							$this->fetched_mv_time = $row["UploadTime"];

				}

			} else {

				return false;

			}

		}

		/*public function fetch_all_movie_specific_data()
		{

			$sql = $this->dbase->query("SELECT * FROM $this->movieTable a,$this->")

		}*/

		public function fetch_from_movie_table_ID($MovieId)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->movieTable WHERE MovieId='$MovieId' ");
			
			return $sql;
		}
		
		public function fetch_from_reg_by_owner_id($UserId)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->regTable WHERE UserId='$UserId' ");
			
			return $sql;
		}

		public function fetch_all_movie_by_owners($OwnerId)
		{
			$sql = $this->dbase->query("SELECT DISTINCT a.MovieId,b.MovieId,a.OwnerId FROM $this->movieTable a,$this->paymentTable b 
				WHERE a.MovieId=b.MovieId AND a.OwnerId='$OwnerId' ");

			return $sql;
		}
		
		public function fetch_total_movie_revenue_by_owner()
		{

			$sql = $this->dbase->query("SELECT SUM(Amount) as total_movies_revenue FROM $this->mpesaTable  ");

			foreach($sql as $row) {
				$this->fetched_mv_revenue = $row["total_movies_revenue"];
			}

		}
		
		public function fetch_movies()
		{

			$sql = $this->dbase->query("SELECT * FROM $this->movieTable  ");

			return $sql;

		}
		
		public function fetch_movies_date($day)
		{

			$sql = $this->dbase->query("SELECT * FROM $this->movieTable WHERE  ");

			return $sql;

		}
		
		public function fetch_all_users()
		{

			$sql = $this->dbase->query("SELECT DISTINCT(Phone),MerchantRequestID,Receipt,Amount,TransactionDate FROM $this->mpesaTable  ");

			return $sql;

		}
		
		public function fetch_distinct_users()
		{

			$sql = $this->dbase->query("SELECT DISTINCT(Phone) FROM $this->mpesaTable");

			return $sql;

		}
		
		public function fetch_total_revenue_by_user($Phone)
		{

			//$total = 0;
            
			$sql = $this->dbase->query("SELECT SUM(c.Amount) as amount
			                            FROM $this->paymentTable b,$this->mpesaTable c WHERE b.MerchantRequestID=c.MerchantRequestID AND c.Phone='$Phone' ");
			                            
			if($sql->rowCount() > 0) {
				
    			foreach($sql as $row) {
    			    if(empty($row['amount'])) {
    				    $this->fetched_single_user_revenue = "0";
    			    } else {
    			        $this->fetched_single_user_revenue = $row['amount'];
    			    }
    			} 
    			
			} else {
			    $this->fetched_single_user_revenue = "0";
			}
			
		//	$this->fetched_single_mv_revenue = $total;

		}
		
		public function fetch_total_movies_by_user($Phone)
		{

			//$total = 0;
            
			$sql = $this->dbase->query("SELECT COUNT(DISTINCT MovieId) as total_videos
			                            FROM $this->paymentTable b,$this->mpesaTable c WHERE b.MerchantRequestID=c.MerchantRequestID AND c.Phone='$Phone' ");
			                            
			if($sql->rowCount() > 0) {
				
    			foreach($sql as $row) {
    			    if(empty($row['total_videos'])) {
    				    $this->fetched_single_user_movies = "0";
    			    } else {
    			        $this->fetched_single_user_movies = $row['total_videos'];
    			    }
    			} 
    			
			} else {
			    $this->fetched_single_user_movies = "0";
			}
			
		//	$this->fetched_single_mv_revenue = $total;

		}
		
		public function fetch_non_validate_users()
		{

		//	$sql = $this->dbase->query("SELECT DISTINCT(a.MerchantRequestID),b.MerchantRequestID,a.Phone FROM $this->mpesaTable a,$this->paymentTable b WHERE MerchantRequestID<>'$merch_id'  ");
		
		    $sql = $this->dbase->query("SELECT * FROM $this->mpesaTable WHERE MerchantRequestID NOT IN (SELECT MerchantRequestID FROM $this->paymentTable)");

			return $sql;

		}
		
		public function fetch_total_movie_detail_for_revenue_by_owner($MovieId)
		{

			//$total = 0;
            
			$sql = $this->dbase->query("SELECT SUM(c.Amount) as amount
			                            FROM $this->movieTable a,$this->paymentTable b,$this->mpesaTable c WHERE a.MovieId='$MovieId' AND a.MovieId=b.MovieId AND b.MerchantRequestID=c.MerchantRequestID ");
			                            
			foreach($sql as $row) {
				$this->fetched_single_mv_revenue = $row["amount"];
			}  
			
		//	$this->fetched_single_mv_revenue = $total;

		}
		
		public function fetch_total_movie_detail_for_revenue_by_owner_day($MovieId,$day)
		{
            
			$sql = $this->dbase->query("SELECT SUM(c.Amount) as amount
			                            FROM $this->movieTable a,$this->paymentTable b,$this->mpesaTable c WHERE a.MovieId='$MovieId' AND a.MovieId=b.MovieId AND b.MerchantRequestID=c.MerchantRequestID 
			                            AND c.TransactionDate BETWEEN '$day 00:00:00' AND '$day 23:59:59' ");
			if($sql->rowCount() > 0) {
				
    			foreach($sql as $row) {
    			    if(empty($row['amount'])) {
    				    $this->fetched_single_mv_revenue = "0";
    			    } else {
    			        $this->fetched_single_mv_revenue = $row['amount'];
    			    }
    			} 
    			
			} else {
			    $this->fetched_single_mv_revenue = "0";
			}
			

		}
		
		public function fetch_total_movie_detail_for_revenue_by_owner_month($MovieId,$month,$year)
		{
		    
            
			$sql = $this->dbase->query("SELECT SUM(c.Amount) as amount
			                            FROM $this->movieTable a,$this->paymentTable b,$this->mpesaTable c WHERE a.MovieId='$MovieId' AND a.MovieId=b.MovieId AND b.MerchantRequestID=c.MerchantRequestID 
			                            AND MONTH(c.TransactionDate)='$month' AND YEAR(c.TransactionDate)='$year' ");
			if($sql->rowCount() > 0) {
				
    			foreach($sql as $row) {
    			    if(empty($row['amount'])) {
    				    $this->fetched_single_mv_revenue = "0";
    			    } else {
    			        $this->fetched_single_mv_revenue = $row['amount'];
    			    }
    			} 
    			
			} else {
			    $this->fetched_single_mv_revenue = "0";
			}
			

		}
		
		public function fetch_total_movie_detail_for_revenue_by_owner_year($MovieId,$year)
		{
		    
            
			$sql = $this->dbase->query("SELECT SUM(c.Amount) as amount
			                            FROM $this->movieTable a,$this->paymentTable b,$this->mpesaTable c WHERE a.MovieId='$MovieId' AND a.MovieId=b.MovieId AND b.MerchantRequestID=c.MerchantRequestID 
			                            AND YEAR(c.TransactionDate)='$year' ");
			if($sql->rowCount() > 0) {
				
    			foreach($sql as $row) {
    			    if(empty($row['amount'])) {
    				    $this->fetched_single_mv_revenue = "0";
    			    } else {
    			        $this->fetched_single_mv_revenue = $row['amount'];
    			    }
    			} 
    			
			} else {
			    $this->fetched_single_mv_revenue = "0";
			}
			

		}
		
		public function fetch_total_movie_customer_detail_revenue_by_owner($merchant)
		{
            $total = 0;
            
           // $sql1 = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE SessionStatus='ACTIVE' ");
            
			$sql = $this->dbase->query("SELECT DISTINCT(b.Phone),b.MerchantRequestID,c.MerchantRequestID,c.Amount,a.MovieName,b.PayDate,b.SessionStatus,a.MovieId,b.MovieId
			                            FROM $this->movieTable a,$this->paymentTable b,$this->mpesaTable c WHERE b.MerchantRequestID='$merchant' AND a.MovieId=b.MovieId AND b.MerchantRequestID=c.MerchantRequestID");
			
			return $sql;

		}
		
		public function fetch_active_user()
		{
		    $sql = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE SessionStatus='ACTIVE' ");

			return $sql;
		}
		
		public function fetch_total_movie_buyers_by_owner()
		{
		    //$total = 0;

			$sql = $this->dbase->query("SELECT Count(DISTINCT Phone) as phone_total FROM $this->mpesaTable  ");

			foreach($sql as $row) {
				$this->fetched_mv_buyers = $row["phone_total"];
			}

		}
		
		public function insert_to_cart_table()
		{
			$this->stmt = $this->dbase->prepare("INSERT INTO $this->cartTable(CustId,CartId,CartStatus,Category,ProdId,ProdName,ProdQty,ProdPrice,PaymentId,CartDate,CartTime) 
																	VALUES(:custId,:cartId,:cartStatus,:cat,:prodid,:pname,:pQty,:price,:payid,now(),now())");

			$this->stmt->bindParam(":custId",$this->user_id);
			$this->stmt->bindParam(":cartId",$this->cart_id);
			$this->stmt->bindParam(":cartStatus",$this->cart_status);
			$this->stmt->bindParam(":cat",$this->prod_category);
			$this->stmt->bindParam(":prodid",$this->prod_id);
			$this->stmt->bindParam(":pname",$this->prod_name);
			$this->stmt->bindParam(":pQty",$this->prod_qty);
			$this->stmt->bindParam(":price",$this->prod_price);
			$this->stmt->bindParam(":payid",$this->pay_id);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}
		}

		public function fetch_from_cart_table($session_id)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->cartTable WHERE CustId='$session_id' AND CartStatus='Cart' ");
			
			return $sql;
		}

		public function fetch_all_from_pay_table()
		{
			$sql = $this->dbase->query("SELECT * FROM $this->paymentTable a,$this->cartTable b WHERE a.PaymentId = b.PaymentId AND a.DeliveryStat='Not Delivered' ");
			
			return $sql;
		}
		
		public function fetch_all_from_reg_table($user_id)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->regTable  WHERE UserId='$user_id' ");
			
			foreach($sql as $row) {
				$this->regUserId = $row["UserId"];
				$this->regUsername = $row["Username"];
				$this->regUserEmail = $row["Email"];
				$this->regUserPhone = $row["PhoneNo"];
			}
		}
		
		public function update_cart_table($session_id,$pay_id)
		{
			
			$this->stmt = $this->dbase->prepare("UPDATE $this->cartTable SET CartStatus='offload', PaymentId='$pay_id' WHERE CustId='$session_id' ");
			$this->stmt->execute();
			
			if($this->stmt) {
				return true;
			} else {
				return false;
			}
			
		}

		public function update_manager_pay_table($prod_id,$cart_id)
		{
			
			$this->stmt = $this->dbase->prepare("UPDATE $this->paymentTable a,$this->cartTable b SET a.DeliveryStat='Delivery'
			 WHERE a.PaymentId= b.PaymentId AND b.CartId='$cart_id' AND b.ProdId='$prod_id' ");
			$this->stmt->execute();
			
			if($this->stmt) {
				return true;
			} else {
				return false;
			}
			
		}
		
		public function insert_to_payment_table()
		{
			$this->stmt = $this->dbase->prepare("INSERT INTO $this->paymentTable(CustId,PaymentId,PaymentMethod,Amount,DeliveryStat,PurchaseDate,PurchaseTime) 
																	VALUES(:custId,:payId,:payMethod,:amt,:delivery,now(),now())");

			$this->stmt->bindParam(":custId",$this->user_id);
			$this->stmt->bindParam(":payId",$this->pay_id);
			$this->stmt->bindParam(":payMethod",$this->pay_method);
			$this->stmt->bindParam(":amt",$this->pay_amount);
			$this->stmt->bindParam(":delivery",$this->delivery_stat);
			$this->stmt->execute();

			if($this->stmt) {
				return true;
			} else {
				return false;
			}
		}
		
		public function fetch_cart_pay($session_id)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->cartTable WHERE CustId='$session_id' ");
			
			return $sql;
		}

		public function fetch_purchases($session_id,$pay_id)
		{
			$sql = $this->dbase->query("SELECT * FROM $this->paymentTable WHERE CustId='$session_id' AND PaymentId='$pay_id' ");
			
			foreach($sql as $row) {
				$this->fetchedPayUserId = $row["CustId"];
				$this->fetchedPayId = $row["PaymentId"];
				$this->fetchedPayMethod = $row["PaymentMethod"];
				$this->fetchedPayAmount = $row["Amount"];
				$this->fetchedPayStat = $row["DeliveryStat"];
				$this->fetchedPayDate = $row["PurchaseDate"];
				$this->fetchedPayTime= $row["PurchaseTime"];
			}
		}

		public function insert_to_reg_table()
		{
						
						
								$this->stmt = $this->dbase->prepare("INSERT INTO $this->regTable(UserId,Username,Email,PhoneNo,Password,RegDate,RegTime) 
																	VALUES(:userid,:username,:email,:phoneno,:pass,now(),now())");

								$this->stmt->bindParam(":userid",$this->user_id);
								$this->stmt->bindParam(":username",$this->username);
								$this->stmt->bindParam(":email",$this->user_email);
								$this->stmt->bindParam(":phoneno",$this->phone_no);			
								$this->stmt->bindParam(":pass",$this->password);
								$this->stmt->execute();

								if($this->stmt) {
									return true;
								} else {
									return false;
								}

								

		}
		

		public function insert_to_login_table()
		{

			//see whether the entered email matches that in the EmailLihub table
			$sql = $this->dbase->query("SELECT * FROM $this->regTable WHERE Email='$this->user_email' ");

			//if yes, fetch all the details that match the entered email and store in variables
			if($sql->rowCount() > 0) {

				foreach($sql as $row) {
					$this->fetched_email = $row["Email"];
					$this->fetched_user_id = $row["UserId"];
				}

				// then fetch the userid from the regTable that matches the fetched user id and the password entered
				$sql2 = $this->dbase->query("SELECT * FROM $this->regTable  WHERE UserId='$this->fetched_user_id' AND Password='$this->password' ");

				//if above condition is met, enter that data into the LoginLihub table
				if($sql2->rowCount() > 0) {

					$this->stmt = $this->dbase->prepare("INSERT INTO $this->loginTable(UserId,LoginDate,LoginTime) VALUES(:userid,now(),now())");

					$this->stmt->bindParam(":userid",$this->fetched_user_id);
					$this->stmt->execute();

					if($this->stmt) {
						return true;
					} else {
						return false;
					}

				}

			}


		}

		public function get_session_details($session_id)
		{

			$sql = $this->dbase->query("SELECT * FROM $this->regTable WHERE UserId='$session_id' ");

			foreach($sql as $row) {
				$this->session_email = $row["Email"];
				$this->session_user_id = $row["UserId"];
				$this->session_username = $row["Username"];
				$this->session_phone = $row["PhoneNo"];
				$this->session_regDate = $row["RegDate"];
				$this->session_regTime = $row["RegTime"];
			}

		}

		public function get_all_users()
		{

			$sql = $this->dbase->query("SELECT * FROM $this->regTable ");
			return $sql;

		}

		public function delete_user($userid)
		{

			$sql = $this->dbase->query("SELECT * FROM $this->emailTable WHERE UserId='$userid' ");

			if($sql->rowCount() > 0) {

				$this->stmt = $this->dbase->prepare("DELETE $this->emailTable,$this->regTable FROM $this->emailTable INNER JOIN $this->regTable 
													WHERE $this->emailTable.UserId=$this->regTable.UserId AND $this->emailTable.UserId=:userid ");

				$this->stmt->bindParam(":userid",$userid);
				$this->stmt->execute();

				if($this->stmt) {
					echo "Deletion success";
				} else {
					echo "Deletion failed";
				}

			} else {
				echo "User not registered";
			}

		}
		public function test(){
			return "Db Connect";
		}


	}
	$database = new database();

?>