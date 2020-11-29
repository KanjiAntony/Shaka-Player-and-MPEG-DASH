function analysisRequest()
{
    var timer; 

		var payRequest;

		 var payDisplay = document.getElementById("realtimeAnalysis");
		 
		 var analysisDate = document.getElementById("datepicker").value;
		 
        var radios = document.getElementsByName('postage');
        
        var format;

            for (var i = 0, length = radios.length; i < length; i++)
            {
             if (radios[i].checked)
             {
              // do whatever you want with the checked radio
              //alert(radios[i].value);
              format = radios[i].value;
            
              // only one radio can be logically checked, don't check the rest
              break;
             } 
             
            }


	//if(payMovieId != "" && payMerchantId != "") { 
		 var payQueryString = "analysisDate=" + analysisDate + "&format=" + format ;
		 var payExtensionUrl = "analysis.php";

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
			  timer = setTimeout('analysisRequest()',1000);

	/*} else {

			alert("No field should be empty");

	}*/	
	
	

}

analysisRequest();