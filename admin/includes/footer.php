
        </div>   
    </div>
    <div class="translate-wrapper">
        <div id="google_translate_element"></div>
    </div>
	<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
		var ALERT_TITLE = "Oops!";
		var ALERT_BUTTON_TEXT = "Ok";

		if(document.getElementById) {
		    window.alert = function(txt) {
		        createCustomAlert(txt);
		    }
		}

		function createCustomAlert(txt) {
		    d = document;

		    if(d.getElementById("modalContainer")) return;

		    mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
		    mObj.id = "modalContainer";
		    mObj.style.height = d.documentElement.scrollHeight + "px";

		    alertObj = mObj.appendChild(d.createElement("div"));
		    alertObj.id = "alertBox";
		    if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
		    alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
		    alertObj.style.visiblity="visible";

		    h1 = alertObj.appendChild(d.createElement("h1"));
		    h1.appendChild(d.createTextNode(ALERT_TITLE));

		    msg = alertObj.appendChild(d.createElement("p"));
		    //msg.appendChild(d.createTextNode(txt));
		    msg.innerHTML = txt;

		    btn = alertObj.appendChild(d.createElement("a"));
		    btn.id = "closeBtn";
		    btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
		    btn.href = "#";
		    btn.focus();
		    btn.onclick = function() { removeCustomAlert();return false; }

		    alertObj.style.display = "block";

		}

		function removeCustomAlert() {
		    document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
		}
    </script>
    <style type="text/css">
        .translate-wrapper{
            position:fixed;
            bottom:0;
            left:0;
        }
    	#modalContainer {
		    background-color:rgba(0, 0, 0, 0.3);
		    position:absolute;
		    width:100%;
		    height:100%;
		    top:0px;
		    left:0px;
		    z-index:10000;
		    background-image:url(tp.png); /* required by MSIE to prevent actions on lower z-index elements */
		}

		#alertBox {
		    position:relative;
		    width:300px;
		    min-height:100px;
		    margin-top:200px;
		    border:1px solid #666;
		    background-color:#fff;
		    background-repeat:no-repeat;
		    background-position:20px 30px;
		}

		#modalContainer > #alertBox {
		    position:fixed;
		}

		#alertBox h1 {
		    margin:0;
		    font:bold 0.9em verdana,arial;
		    background-color:#3073BB;
		    color:#FFF;
		    border-bottom:1px solid #000;
		    padding:2px 0 2px 5px;
		}

		#alertBox p {
		    font:0.9em verdana,arial;
		    height:50px;
		    padding-left:5px;
		    margin-left:55px;
		}

		#alertBox #closeBtn {
		    display:block;
		    position:relative;
		    margin:5px auto;
		    padding:7px;
		    border:0 none;
		    width:70px;
		    font:0.7em verdana,arial;
		    text-transform:uppercase;
		    text-align:center;
		    color:#FFF;
		    background-color:#357EBD;
		    border-radius: 3px;
		    text-decoration:none;
		}

		/* unrelated styles */

		#mContainer {
		    position:relative;
		    width:600px;
		    margin:auto;
		    padding:5px;
		    border-top:2px solid #000;
		    border-bottom:2px solid #000;
		    font:0.7em verdana,arial;
		}

		h1,h2 {
		    margin:0;
		    padding:4px;
		    font:bold 1.5em verdana;
		    border-bottom:1px solid #000;
		}

		code {
		    font-size:1.2em;
		    color:#069;
		}

		#credits {
		    position:relative;
		    margin:25px auto 0px auto;
		    width:350px; 
		    font:0.7em verdana;
		    border-top:1px solid #000;
		    border-bottom:1px solid #000;
		    height:90px;
		    padding-top:4px;
		}

		#credits img {
		    float:left;
		    margin:5px 10px 5px 0px;
		    border:1px solid #000000;
		    width:80px;
		    height:79px;
		}
		.important {
		    background-color:#F5FCC8;
		    padding:2px;
		}

		code span {
		    color:green;
		}
		@media (max-width: 420px) {
			.kycHolder{
				z-index: 999;
				display: none;
				top: 8px;
				position: absolute;
				left: 50px;
			}
		}
		.lds-ellipsis {
  		  display: inline-block;
		  position: relative;
		  width: 80px;
		  height: 45px;
		}
		.lds-ellipsis div {
		  position: absolute;
		  top: 33px;
		  width: 13px;
		  height: 13px;
		  border-radius: 50%;
		  background: #000;
		  animation-timing-function: cubic-bezier(0, 1, 1, 0);
		}
		.lds-ellipsis div:nth-child(1) {
		  left: 8px;
		  animation: lds-ellipsis1 0.6s infinite;
		}
		.lds-ellipsis div:nth-child(2) {
		  left: 8px;
		  animation: lds-ellipsis2 0.6s infinite;
		}
		.lds-ellipsis div:nth-child(3) {
		  left: 32px;
		  animation: lds-ellipsis2 0.6s infinite;
		}
		.lds-ellipsis div:nth-child(4) {
		  left: 56px;
		  animation: lds-ellipsis3 0.6s infinite;
		}
		@keyframes lds-ellipsis1 {
		  0% {
		    transform: scale(0);
		  }
		  100% {
		    transform: scale(1);
		  }
		}
		@keyframes lds-ellipsis3 {
		  0% {
		    transform: scale(1);
		  }
		  100% {
		    transform: scale(0);
		  }
		}
		@keyframes lds-ellipsis2 {
		  0% {
		    transform: translate(0, 0);
		  }
		  100% {
		    transform: translate(24px, 0);
		  }
		}
		.hide{
			display: none;
		}
        a#Wr76M3Y-1589445353922{
    		display: none;
    	}
    	.setKYC{
    	    cursor: pointer;
    	}
    	.opendisclaimer{
    	    cursor: pointer;
    	}
    	.opentc{
    	    cursor: pointer;
    	}
    </style>
	<div style="display: none;"><?php $db->newTraffic();?></div>
</body>
</html>
