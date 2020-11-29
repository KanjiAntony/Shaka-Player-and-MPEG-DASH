<?php

define("DS", DIRECTORY_SEPARATOR);



error_reporting(E_ALL); // Error engine - always ON!

ini_set('display_errors', false); // Error display - OFF in production env or real server

ini_set('log_errors', TRUE); // Error logging

ini_set('error_log', 'error.log'); // Logging file

ini_set('log_errors_max_len', 1024); // Logging file size


require_once("alertMessages.php");
require_once("mailer/src/Exception.php");
require_once("mailer/src/OAuth.php");
require_once("mailer/src/PHPMailer.php");
require_once("mailer/src/POP3.php");
require_once("mailer/src/SMTP.php");
require_once("sendEmail.php");
require_once("dbObject.php");
require_once("automation.php");
require_once("database.php");
require_once("session.php");
require_once("upload.php");

?>