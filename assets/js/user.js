

var selectedevent = 0;
var cards;
var events;
var baskets;
var addOns;
var addOnsAddedinCart  = new Array();
var selectedCategory = 0;
var selectedCard;
var receiver_id;
var userMessage;
var delivery_date;
var basketsStore;
var audiomessageurl;
var token_ = {};
token_[token_name] = csrf_hash;
function login()
{
		$('#spinner').show();
		var username = $('#Username').val();
		var pass = $('#Password').val();
		var data_ = {Username: username,Password:pass};
		data_[Object.keys(token_)[0]] = Object.values(token_)[0];
 $.ajax({
		type: "post",
		url: baseurl+"UserController/login",
		cache: false,
		data: data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			console.log(obj);
			if(obj['id'] == 0)
			{
				alert('Invalid email or password.');
			}
			else if(obj['id'] == 1){
				location.reload();
			}
		}catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});
}
function login_checkout()
{
		$('#spinner').show();
		var username = $('#email_').val();
		var pass = $('#password_').val();
		var data_ = {Username: username,Password:pass};
		data_[Object.keys(token_)[0]] = Object.values(token_)[0];
		
 $.ajax({
		type: "post",
		url: baseurl+"UserController/login",
		cache: false,
		data: data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			console.log(obj);
			if(obj['id'] == 0)
			{
				alert('Invalid email or password.');
			}
			else if(obj['id'] == 1){
				location.reload();
			}
		}catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});
}
function savereceiver()
{
	
	var name = $('#reName').val();
	var phonenumber = $('#rePhoneNumber').val();
	var address = $('#reFullAddress').val();
	var city = $('#reCity').val();
	if(!name)
	{
		alert('Enter Name');
		return;
	}
	if(!phonenumber)
	{
		alert('Enter Phone number');
		return;
	}
	if(!address)
	{

	alert('Enter Full address');
		return;
	}
	if(!city)
	{
		alert('Enter City');
		return;
	}

	$('#spinner').show();
	var data_ = {name: name,number:phonenumber,address:address,city:city};
	data_[Object.keys(token_)[0]] = Object.values(token_)[0];

 $.ajax({
		type: "post",
		url: baseurl+"UserController/insertReceiver",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var result = jQuery.parseJSON(json);
			if(result>0)
			{
				receiver_id = result;
				makeInvoice();
			}
			else{
				alert('Oops, there is some problem.');
			}
		}
		catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(xhr, ajaxOptions, thrownError){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});

}

function saveuserContactinfo()
{
	
	var address = $('#address_sender').val();
	var phonenumber = $('#mobile_sender').val();
	var city = $('#city_sender').val();
	
	if(!phonenumber)
	{
		alert('Enter Phone number');
		return;
	}
	if(!address)
	{

	alert('Enter Full address');
		return;
	}
	if(!city)
	{
		alert('Enter City');
		return;
	}

	$('#spinner').show();
	var data_ = {mobile_sender:phonenumber,address_sender:address,city_sender:city};
	data_[Object.keys(token_)[0]] = Object.values(token_)[0];

 $.ajax({
		type: "post",
		url: baseurl+"UserController/contactinfo",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var result = jQuery.parseJSON(json);
			if(result=="Success")
			{
				$('#model-facebook-user-info').modal('hide');
			}
			else{
				alert(result);
			}
		}
		catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});

}



function fetchcontacts(){

	$('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"UserController/fetchUserContacts",
		cache: false,
		data:token_,
		success: function(json){						
		try{
			$('#spinner').hide();
			 var customers = jQuery.parseJSON(json);
		if(customers!="")
          {
          	var genericuserslist = customers;
          	$('#genericuserslist').html('');
            for (var i = 0; i < genericuserslist.length; i++) {
          $("#genericuserslist").append('<div class="radio"> <label>\
      			<input type="radio" id="'+genericuserslist[i].friend+'" name="optradio">'+genericuserslist[i].firstname+' '+genericuserslist[i].lastname+'\
    		</label> </div>');
          
            }
          
            $('#receivermodal').modal('show');
            $('#receiverConfirmed').click(function(){
            	if(!$('input[name=optradio]:checked', '#genericuserslist')[0])
            		return;

				receiver_id = $('input[name=optradio]:checked', '#genericuserslist')[0].id;

				$('#receivermodal').modal('hide');
				makeInvoice();
            });

          }else{
          	alert('You don\'t have contacts on emoey, kindly fill the form to add one.');
          }
		}catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(xhr, ajaxOptions, thrownError){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});
}
function makeInvoice()
{
	if(localStorage.getItem('iscustomize') == "true")
	{
		events = localStorage.getItem('events');
		events = JSON.parse(events);
		selectedevent = localStorage.getItem('selectedevent');
		baskets = localStorage.getItem('baskets');
		baskets = JSON.parse(baskets);
		selectedCategory = localStorage.getItem('selectedCategory');
		cards = localStorage.getItem('cards');
		cards = JSON.parse(cards);
		selectedCard = localStorage.getItem('selectedCard');
		addOnsAddedinCart = localStorage.getItem('addOnsAddedinCart');
		addOnsAddedinCart = JSON.parse(addOnsAddedinCart);
		addOns = localStorage.getItem('addOns');
		addOns = JSON.parse(addOns);
		userMessage = localStorage.getItem('message');
		audiomessageurl = localStorage.getItem('audiomessageurl');

	$('.nav-tabs a[href="#tab3"]').tab('show');
				var basketname = "";
				events.forEach(function(item,index){
					if(selectedevent==item.eventID)
					{
						basketname = item.name;
					}
				});
				console.log(basketname);
				var name = "";
				var categoryPrice =0;
				baskets.forEach(function(item,index){
					if(selectedCategory==item.basketID)
					{
						name = item.basket_size;
						categoryPrice = item.basket_price;
					}
				});
				console.log(name);

				basketname = basketname+" basket";
				var cardName = "";
				cards.forEach(function(item,index){
					if(selectedCard==item.cardID)
					{
						cardName = item.card_name;
					}
				});
				var addonshtml = "";
				var addOnPrice =0;
				$('#checkoutInvoice').html('');
				$('#checkoutInvoice').append('<tr>\
					<td>'+basketname+' <b>'+name+'</b> </td>\
					<td><ul id="addonListsCheckout" class="checkout-addon"></ul></td>\
					<td><ul id="priceListsCheckout" class="checkout-addon"></td>\
					</tr>');
				addOnsAddedinCart.forEach(function(itemSelected,index){
					
							var discountedPrice = itemSelected.price;
							addOnPrice = addOnPrice + (parseInt(discountedPrice)*itemSelected.quantity) ;
							$('#addonListsCheckout').append(' <li>'+itemSelected.name+' quantity: '+itemSelected.quantity+'</li> ');
							$('#priceListsCheckout').append(' <li>'+discountedPrice+' x '+itemSelected.quantity+'</li> ');
				});
				$('#checkoutAddonsTotal').html(addOnPrice);
				var voicemessageprice = 0;
				if(audiomessageurl)
				{
					$('#checkoutVoiceMessage').html('400');
					voicemessageprice = 400;
				}
				else{
					$('#checkoutVoiceMessage').html('0');
				}
				
				$('#basketCategoryPrice').html(categoryPrice);

				var grandTotal = addOnPrice+ parseInt(categoryPrice) + voicemessageprice;
				$('#grandTotal').html(grandTotal);
	}
	else{
		
		$('.nav-tabs a[href="#tab3"]').tab('show');
		var basketsStore = localStorage.getItem('basketStore');
		basketsStore = JSON.parse(basketsStore);
		console.log(basketsStore);
	$('.nav-tabs a[href="#tab3"]').tab('show');
	$('#addons_text').html('Description');
				$('#checkoutInvoice').html('');
				$('#checkoutInvoice').append('<tr>\
					<td> <b>'+basketsStore.name+'</b> </td>\
					<td>'+basketsStore.description+'</td>\
					<td><b>'+basketsStore.price+'</b></td>\
					</tr>');
				$('#checkoutAddonsTotal').html(basketsStore.price);
				$('#basketCategoryPrice').html(0);

				var grandTotal = addOnPrice+ parseInt(categoryPrice);
				$('#grandTotal').html(basketsStore.price);
	}
	

}

var signinWin;
function login_with_facebook()
{
	 PopupCenter(facebookloginurl,"SignIn",800, 500);
        setTimeout(CheckLoginStatus, 2000);
        return false;
}

function connect_with_facebook()
{
	PopupCenter(facebookconnecturl,"SignIn",800, 500);
        setTimeout(CheckLoginStatus, 2000);
        return false;
}
function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    signinWin = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        signinWin.focus();
    }
}

function CheckLoginStatus() {
    if (signinWin.closed) {
    	location.reload();
    }
    else setTimeout(CheckLoginStatus, 1000);
}

$(document).ready(function() {

	$('.sign-in-to-emoey').click(function()
	{
		$('#model-facebook').modal('hide');
	});

	$('#btn_registerUser').prop('disabled', true);

	var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
   $('#confirmpassword').addClass('has-error');
   
  } else {
    $('#confirmpassword').removeClass('has-error');
    
    $('#btn_registerUser').prop('disabled', false);
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
 $("#signupform").submit(function(e) {

    var url = baseurl+"UserController/signup"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#signupform").serialize(), // serializes the form's elements.
           success: function(json)
           {
                var obj = jQuery.parseJSON(json);
                if(obj['id'] == 0)
                {
                	$('#signuperror_msg').text(obj['msg']);
                	$('#signup-error').modal('show');
                }
                else{
                	location.reload();
                	$('#model-2').modal('hide');
                	//$('#signup-success').modal('show');
                }
                

           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

      $("#forgotpassword").submit(function(e) {
    var url = baseurl+"UserController/forgotPassword"; // the script where you handle the form input.
    
    $.ajax({
           type: "POST",
           url: url,
           data: $("#forgotpassword").serialize(), // serializes the form's elements.
           success: function(json)
           {
                var obj = jQuery.parseJSON(json);
                if(obj['id'] == 0)
                {
                	$('#signuperror_msg').text(obj['msg']);
                	$('#signup-error').modal('show');
                }
                else{
                	location.reload();
                	$('#model-2').modal('hide');
                	$('#signup-success').modal('show');
                }
                

           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});
});