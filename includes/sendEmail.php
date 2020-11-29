<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("initialise.php");


    class sendEmail {

        public $from_address,$from_name,$to_address,$to_name,$subject,$message,$attached_file,$mail;

        public function __construct()
        {
            $this->set_credentials();
        }

        public function set_from_address($address)
        {
            $this->from_address = $address;
        }

        public function set_from_name($name)
        {
            $this->from_name = $name;
        }

        public function set_to_address($address)
        {
            $this->to_address = $address;
        }

        public function set_to_name($name)
        {
            $this->to_name = $name;
        }

        public function set_subject($sub)
        {
            $this->subject = $sub;
        }

        public function set_message($mes)
        {
            $this->message = $mes;
        }

        public function add_attachment($attached_file)
        {
            $this->attached_file = $attached_file;
        }

        public function set_credentials()
        {

            $this->mail = new PHPMailer;

            $this->mail->IsSMTP();
            //$this->mail->SMTPDebug = 2;
            $this->mail->Host = "";
            $this->mail->Port = 465;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = "";
            $this->mail->Password = "";
            $this->mail->SMTPSecure = "ssl";

            $this->mail->SMTPConnect(
                    array("ssl"=> array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );

        }

        public function set_variables()
        {

            $this->mail->FromName = $this->from_name;
            $this->mail->From = $this->from_address;
            $this->mail->AddAddress($this->to_address,$this->to_name);
            $this->mail->Subject = $this->subject;
            $this->mail->Body = $this->message;
            $this->mail->addAttachment($this->attached_file, $name = 'Ticket'.uniqid().".pdf" ,  $encoding = 'base64', $type = 'application/pdf');

        }

        public function send_email()
        {


            $result = $this->mail->Send();

            if($result) {
                return true;
            } else {
                //echo $this->mail->ErrorInfo;
                return false;
            }

        }

    }

    $mailSending = new sendEmail();

?>