function payRequest()
{
    var timer; 

		var payRequest;

		 var payDisplay = document.getElementById("spin");
		 
		 var payUser = document.getElementById("PartyA").value;

		 //var loaderMonitor = document.getElementById(loader);

		 var payMovieId = document.getElementById("MovieId").value;

		 var payMerchantId = document.getElementById("MerchantId").value;


	//if(payMovieId != "" && payMerchantId != "") { 
		 var payQueryString = "phone=" + payUser + "&movie_id=" + payMovieId + "&merchant_id=" + payMerchantId;
		 var payExtensionUrl = "gatepass.php";

		 //loaderMonitor.style.display = "block";

		
			try {

				payRequest = new XMLHttpRequest();

			} catch(e) {

					try {
						payRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch(e) {

						try {
							payRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch(e) {
							alert("Browser broke");
							return false;
						}

					}

			}

			payRequest.onreadystatechange = function() {

				if(payRequest.readyState == 4) {
				    


					    payDisplay.innerHTML = payRequest.responseText;


				} 

			}


			payRequest.open("POST",payExtensionUrl,true);
			payRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			payRequest.send(payQueryString);
			
			//Repeat the function each 30 seconds
			  timer = setTimeout('payRequest()',1000);

	/*} else {

			alert("No field should be empty");

	}*/		

}

payRequest();