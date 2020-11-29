var timer;
var count = 0;
var count2 = 31;

payRequest();


function payRequest()
{
    var timer; 

		var payRequest;

		 var payDisplay = document.getElementById("spin");
		 
		 var payUser = document.getElementById("PartyA").value;
		 
		  var countdownDisplay = document.getElementById("countdown_message");

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
				    
                    if(payRequest.responseText !== "true") {
                        payDisplay.innerHTML = payRequest.responseText;
                        
                    } else {
					    
                            location.replace("play.php?movie="+payMovieId);
					    
                    }


				} 

			}
			
			//Repeat the function each 30 seconds
			  timer = setTimeout('payRequest()',1000);
			  
			  count++;
			  count2 = count2 - 1;

			countdownDisplay.innerHTML = "Please wait for "+count2+" seconds";
			  console.log(count);
			  if(count >= 31) {
			      //clearPayment();
			      clearTimeout(timer);
			     // payDisplay.style.display = "none";
			      //countdownDisplay.style.display = "none";
			      countdownDisplay.innerHTML = "If you have received a payment confirmation from mpesa but cannot see the download button,<a href='again.php?id="+payMovieId+"&phone="+payUser+"'>click here</a>";
			      //toggle_buy_now();
			  }


			payRequest.open("POST",payExtensionUrl,true);
			payRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			payRequest.send(payQueryString);
			

	/*} else {

			alert("No field should be empty");

	}*/		

}

function c2bConfirmPay()
{

		var payRequest;

		 var payDisplay = document.getElementById("spin");
		 		 
		 var payUser = document.getElementById("PartyA").value;

		 var payMovieId = document.getElementById("MovieId").value;
		 
		 var payMoviePrice = document.getElementById("movie_price").value;

		 var payMpesaCode = document.getElementById("mpesa_code").value;
		 
	    
		 var payQueryString = "phone=" + payUser + "&movie_id=" + payMovieId + "&mpesa_code=" + payMpesaCode + "&movie_price=" + payMoviePrice ;
		 var payExtensionUrl = "c2b_gatepass.php";

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
				    
									    
					if(payRequest.responseText !== "true") {
						
                        payDisplay.innerHTML = payRequest.responseText;
                        
                    } else {
					    
                            location.replace("play.php?movie="+payMovieId);
					    
                    }
						

				} 

			}


			payRequest.open("POST",payExtensionUrl,true);
			payRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			payRequest.send(payQueryString);
			
}

function clearPayment()
{
    clearTimeout(timer);
    count = 0;
    count2 = 31;
}