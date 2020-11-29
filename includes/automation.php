<?php

class Automate {

	public $randomChar="A",$randomTicketChar="P",$randomNumber,$timestamp,$random_user_id,$random_admin_code,$photo_id,$ticket_id,$pay_id,$mv_id;
	public $commChar = "POP-INN";
	public $admin_code_char = "POP-INRSV";
	public $payChar = "POPINNPAY";
	public $ticketChar = "TKT";

	public function generate_random_char()
	{
		$length = 3;

		$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$characterLength = strlen($characters);

		for($i=0; $i<$length; $i++) {

			$this->randomChar .=$characters[rand(0,$characterLength)]; 

		}

		return $this->randomChar;

	}

	public function generate_random_ticket_char()
	{
		$length = 4;

		$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$characterLength = strlen($characters);

		for($i=0; $i<$length; $i++) {

			$this->randomTicketChar.=$characters[rand(0,$characterLength)]; 

		}

		return $this->randomTicketChar;

	}

	public function generate_random_number()
	{

		return $this->randomNumber = rand(1000,1000000);

	}

	public function generate_current_timestamp()
	{
		return $this->timestamp = date("dms",time());
	}

	public function generate_user_id()
	{
		$this->random_user_id = $this->generate_random_char().$this->generate_random_number().$this->commChar;
	}
	
	public function generate_admin_code()
	{
		$this->random_admin_code = $this->generate_random_char().$this->generate_random_number().$this->admin_code_char;
	}

	public function generate_photo_id()
	{
		$this->photo_id = $this->generate_random_number().$this->generate_random_char();
	}

	public function generate_cart_id()
	{
		$this->cart_id = $this->generate_random_number().$this->generate_random_char();
	}

	public function generate_ticked_id()
	{
		$this->ticket_id = $this->ticketChar.$this->generate_random_number().$this->generate_random_ticket_char();
	}
	
	public function generate_movie_id()
	{
		$this->mv_id = $this->generate_random_number().$this->generate_random_char();
	}
	
	public function generate_pay_id()
	{
		$this->pay_id = $this->payChar.$this->generate_random_number();
	}

}

$automation = new Automate();


?>