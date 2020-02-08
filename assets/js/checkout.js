var token_ = {};
token_[token_name] = csrf_hash;
$( document ).ready(function() {
	if(localStorage.getItem('iscustomize') != "true")
	{
		$('#btn_edit_Order').hide();
	}
$('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"UserController/isUserLoggedIn",
		cache: false,
		data:token_,
		success: function(state){						
		
			$('#spinner').hide();


			if(state==1)
			{
				$('#model-facebook-user-info').modal({
  							backdrop: 'static',
  							keyboard: false
						}); 
				$('#model-facebook-user-info').modal('show');
				$('.nav-tabs a[href="#tabreceiver"]').tab('show');
				$(".checkout-section").slideDown("slow");
				$('#checkoutInvoice').html('');
				
			}else if(state==2)
			{
				$('.nav-tabs a[href="#tabreceiver"]').tab('show');
				$(".checkout-section").slideDown("slow");

				$('#checkoutInvoice').html('');
			}

				
		},
		error: function(){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});

 $('#btnAllSet').click(function(){

	$('datePicker').css('z-index', 'auto');
$( "#datepicker" ).datepicker({ minDate: 2 });
$('#modelgetCalendar').modal('show');
	$( ".select-delivery-time" ).change(function() {
		delivery_date = $('.select-delivery-time').val();
		$("#modelgetCalendar").animate({left: '600px'});
		$('#modelgetCalendar').modal('hide');
		$('.nav-tabs a[href="#tab4"]').tab('show');
		
});
	
});

 $('#btnlettheswanfly').click(function(){

 	var paymentMethod = $('input[name=radgroup]:checked', '#paymentmethodsform').val();
 	if (typeof paymentMethod != 'undefined' && paymentMethod == "1" || paymentMethod == "2" || paymentMethod == "3")
 	{
	 	if(localStorage.getItem('iscustomize') == "true")
		 {
		 	flyOrder(paymentMethod);
		 }else{
		 	flyBasketStoreOrder(paymentMethod);
		 }
 	}
 	else{
 		alert('Kindly Select any of the payment method');
 	}
	
 });

 $('#paymentmethodsform input').on('change', function() {
   			
		});

 $('#btn_edit_Order').click(function(){
 	localStorage.setItem('comingfromcheckout','yes');
 });

});

function flyBasketStoreOrder(paymentMethod)
{
	$('#spinner').show();

	var baskets_store_id = localStorage.getItem('basketStoreid');
	var message = localStorage.getItem('message');
		var data_ = {
			'basket_store_id':baskets_store_id,
			'delivery_date':delivery_date,
			'receiverid': receiver_id,
			'paymentmethod':paymentMethod,
			'message':message,
		};
		data_[Object.keys(token_)[0]] = Object.values(token_)[0];

		$.ajax({
		type: "post",
		url: baseurl+"Order/placeBasketStoreOrder",
		cache: false,
		data:data_,
		success: function(json){						
			$('#spinner').hide();
			try{
				var result = jQuery.parseJSON(json);
				if(result['status'] == 200)
				{
					localStorage.removeItem('basketStore');
					localStorage.removeItem('message');
					$('#btn_edit_Order').hide();
					$('#checkout_details').html('Your Order Id is '+result['orderid']);
					$('#ordersuccessmodal').modal('show');
				}
				else if(result['status'] == 1)
				{
					localStorage.removeItem('basketStoreid');
					localStorage.removeItem('message');
					$('#signuperror_msg').text(result['msg']);
                	$('#signup-error').modal('show');
				}



			}catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}
			},
		error: function(xhr, ajaxOptions, thrownError){	
		$('#spinner').hide();
		}

});

}

function flyOrder(paymentMethod)
{
	$('#spinner').show();

var data_ = {'receiverid': receiver_id,
			'event':selectedevent,
			'category':selectedCategory,
			'card':selectedCard,
			'addon':addOnsAddedinCart,
			'message':userMessage,
			'delivery_date':delivery_date,
			'paymentmethod':paymentMethod,
			'audiomessage':audiomessageurl,
		};
data_[Object.keys(token_)[0]] = Object.values(token_)[0];
 $.ajax({
		type: "post",
		url: baseurl+"Order/placeOrder",
		cache: false,
		data:data_,
		success: function(json){						
			$('#spinner').hide();
			try{
				var result = jQuery.parseJSON(json);
			if(result['status'] == 200)
			{
				localStorage.removeItem('selectedevent');
				localStorage.removeItem('selectedCategory');
				localStorage.removeItem('selectedCard');
				localStorage.removeItem('addOnsAddedinCart');
				localStorage.removeItem('audiomessageurl');
				$('#btn_edit_Order').hide();
				$('#checkout_details').html('Your Order Id is '+result['orderid']);
				$('#ordersuccessmodal').modal('show');
			}
			else if(result['status'] == 1)
			{
				localStorage.removeItem('selectedevent');
				localStorage.removeItem('selectedCategory');
				localStorage.removeItem('selectedCard');
				localStorage.removeItem('addOnsAddedinCart');
				localStorage.removeItem('audiomessageurl');
				$('#signuperror_msg').text(result['msg']);
                $('#signup-error').modal('show');

			}
			else
			{
					$('#signuperror_msg').text(result['msg']);
                	$('#signup-error').modal('show');
			}



			}catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}
			},
		error: function(xhr, ajaxOptions, thrownError){	
		$('#spinner').hide();	
		
		}

});
}