$(document).ready(function(e){
	$("#newUser").click(function(){
		var name = $("#accountName").val();
		var address = $("#address").val();
		var phoneNumber = $("#phoneNumber").val();
		var emailAddress = $("#emailAddress").val();
		var pin = $("#pin").val();
		var question = $("#question").val();
		var answer = $("#answer").val();
		if(name.length == 0){
			$("#warn").removeClass("warn")
			.html("Name is required")
			.fadeIn("slow");return false;
		}
		if(address.length == 0){
			$("#warn").removeClass("warn")
			.html("Address is required")
			.fadeIn("slow");return false;
		}
		if(phoneNumber.length == 0){
			$("#warn").removeClass("warn")
			.html("Phone Number is required")
			.fadeIn("slow");return false;
		}
		if(emailAddress.length == 0){
			$("#warn").removeClass("warn")
			.html("Email Address is required")
			.fadeIn("slow");return false;
		}
		if(pin.length == 0){
			$("#warn").removeClass("warn")
			.html("Transfer Pin is required")
			.fadeIn("slow");return false;
		}
		if(question.length == 0){
			$("#warn").removeClass("warn")
			.html("Security question is required")
			.fadeIn("slow");return false;
		}
		if(answer.length == 0){
			$("#warn").removeClass("warn")
			.html("Secret Answer is required")
			.fadeIn("slow");return false;
		}
	});
	jQuery.fn.animateAuto = function(prop, speed, callback){
	    var elem, height, width;
	    return this.each(function(i, el){
	        el = jQuery(el), elem = el.clone().css({"height":"auto","width":"auto"}).appendTo("body");
	        height = elem.css("height"),
	        width = elem.css("width"),
	        elem.remove();
	        
	        if(prop === "height")
	            el.animate({"height":height}, speed, callback);
	        else if(prop === "width")
	            el.animate({"width":width}, speed, callback);  
	        else if(prop === "both")
	            el.animate({"width":width,"height":height}, speed, callback);
	    });  
	}
	$("#nextDetails").click(function(){
		var idNumber = $("#idNumber").val();
		var accountNumber = $("#accountNumber").val(idNumber);
		$("#accountAlone").animate({height:"0px", opacity: "0"});
		$("#allDetails").animate({opacity: "1"});
		$("#allDetails").animateAuto("height", 1000);
		$.getJSON('getAccount?id='+idNumber, function(jd) {
          $('#accountName').val(jd);
       });
	});
	$("#nextDetail").click(function(){
		var idNumber = $("#idNumber").val();
		$("#accountAlone").animate({height:"0px", opacity: "0"});
		$("#allDetails").animate({opacity: "1"});
		$("#allDetails").animateAuto("height", 1000);
		$.getJSON('getUser?val='+idNumber, function(jd) {
          $('#accountName').val(jd.name);
          $('#accountNumber').val(jd.number);
          $('#ledgerBalance').val(jd.a_balance);
          $('#bookBalance').val(jd.bbalance);
          $('#phone').val(jd.phone);
          $('#address').val(jd.address);
          $('#id').val(jd.id);
          $('#otherActions').html(jd.suspend);
          $('#avatar').attr("src",jd.avatar);
          $('#nid').val(jd.id);
       });
	});
	$("input[name='trx']").on("click", function(){
		$("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
		$("form").submit();
	});
	$(".edit").click(function(){
		$("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
		var idNumber = $(this).attr('id');
		var accountNumber = $("#accountNumber").val(idNumber);
		$("#adminAction").animate({opacity: "1"});
		$.getJSON('getAdmin?val='+idNumber, function(jd) {
          $('#adminAction').html(jd);
          $("#mode1").addClass("none");
		  $("#mode2").addClass("none");
       	});
	});
});