<?php

require_once("../includes/initialise.php");

$data = file_get_contents('php://input');

file_put_contents("validate_callback.txt", $data);


?>