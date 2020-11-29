<?php

	require_once("initialise.php");

	class session {

		public $session_id;
		public $client_session_id;
		public $is_logged = false;
		public $is_client_logged = false;


		public function __construct()
		{
			if(!isset($_SESSION)) {
				session_start();
			}

			$this->check_login();
			$this->check_client_login();
		}


		public function login($user_id)
		{

			$this->session_id = $_SESSION["user_id"] = $user_id;
			$this->is_logged = true;

		}
		
		public function client_login($user_id)
		{

			$this->client_session_id = $_SESSION["client_user_id"] = $user_id;
			$this->is_client_logged = true;

		}

		public function logout($redirect_url)
		{

			if($this->is_logged) {
				unset($this->session_id);
				unset($_SESSION["user_id"]);
				$this->is_logged = false;
				header("Location: ".$redirect_url);
			}

		}
		
		public function logout_client($redirect_url)
		{

			if($this->is_client_logged) {
				unset($this->client_session_id);
				unset($_SESSION["client_user_id"]);
				$this->is_client_logged = false;
				header("Location: ".$redirect_url);
			}

		}

		public function is_logged()
		{
			return $this->is_logged;
		}
		
		public function is_client_logged()
		{
			return $this->is_client_logged;
		}

		public function check_login()
		{

			if(isset($_SESSION["user_id"])) {
				$this->session_id = $_SESSION["user_id"];
				$this->is_logged = true;
			} else {
				unset($this->session_id);
				$this->is_logged = false;
			}

		}
		
		public function check_client_login()
		{

			if(isset($_SESSION["client_user_id"])) {
				$this->client_session_id = $_SESSION["client_user_id"];
				$this->is_client_logged = true;
			} else {
				unset($this->client_session_id);
				$this->is_client_logged = false;
			}

		}

	}

	$session = new session();

?>