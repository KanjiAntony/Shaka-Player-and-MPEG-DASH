<?php

require_once("initialise.php");

class alerts {

	public $mess;

	public function message($mess,$status){
			$this->mess = $mess;

		if($status == "Fail") {

			echo '


				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  '.$this->mess.'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>

				</div>

';

		} else if($status == "Success") {
			echo '



				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  '.$this->mess.'
				   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>

				</div>
';
		}	

	}


}

	$alert = new alerts();

?>
