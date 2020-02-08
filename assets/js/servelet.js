//var baseurl = "<?php print base_url(); ?>";
var selectedevent = 0;
var cards;
var events;
var baskets;
var addOns;
var addOnsAddedinCart  = new Array();
var selectedCategory = 0;
var selectedCard;
var userMessage;
var totalPrice = 0; /// just for backup
var totalPriceSofar = 0; ////this includes addons
var whereweare = 0;
var audiomessageurl="";

var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
var token_ = {};
token_[token_name] = csrf_hash;

$( document ).ready(function() {



	if(isMobile)
	{
		$('#basketinfo_mobile').show();
	}
	else
	{
		$('#basketinfo_mobile').hide();
	}

	var lastScrollTop = 0;
	var updown = 1;

	$('.remove_audiofile').click(function(){
		$('.audio_div').hide();
		audiomessageurl = "";
		localStorage.setItem("audiomessageurl","");
		totalPrice = parseInt(totalPrice) - 400;
		calculateTotalPrice();
		$('#basketcateselected').text('');
	});

$("html, body").animate({ scrollTop: 0 }, "slow");


$(window).scroll(function() {


	var st = $(this).scrollTop();
   if (st > lastScrollTop){
      updown = 0;
		$("i", $('a.float')).removeClass("fa-shopping-cart").addClass("fa-arrow-up ");
   } else {
      updown = 1;
      $("i", $('a.float')).removeClass("fa-arrow-up").addClass("fa-shopping-cart");
		
   }
   lastScrollTop = st;
	
});
	
$('a.float').click(function()
{
	$("i", this).toggleClass("fa-arrow-up fa-shopping-cart");
	if(updown==1)
	{

		 $('html,body').animate({
        scrollTop: $("#scroll-div").offset().top-120},
        'slow');
	}
	else{
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	
});


	$('#btn_previous').hide();
	$('#btn_next').hide();

	if(localStorage.getItem('comingfromcheckout') == 'yes')
	{
		$("#basketdiv").hide();
		$("#cardsize").hide();
		$('#cardsize').css('visibility','hidden');
		$(".cardtype").hide();
		localStorage.setItem('comingfromcheckout','no');
	}

	$('#uploadaudio_file').submit(function(e) {
		e.preventDefault();

	var file_data = $('#browseBtn').prop('files')[0];

	if(file_data)
	{
		if(file_data.size < (1024 * 300))
		{
			mp3BLOBlocal = file_data;
			$('#spinner').show();
			uploadAudio();
		}
		else{
			alert('Audio File size limit is 300 KB.');
		}

		
	}
	else{
		alert('Kindly choose any audio file first.');
	}
	
		return false;
	});

	function eventsAndBaskets()
	{
		$('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"SendBasket/loadbasketdata",
		cache: false,
		data:token_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			events = obj[1];
			baskets = obj[0];

			$('#eventslist').html('');
			$('#categorylist').html('');
			events.forEach(function(item,index)
			{
				$('#eventslist').append('<li class="loading">\
					<label title="'+item.name+'" class="card-image cardstyle eventcard" style="background-image: url(./assets/img/events_images/'+item.image+')">\
					<input class="changeposition" type="radio" id="eventslist_'+item.eventID+'" name="events" value="'+item.eventID+'" /> <img/></label>\
					</li>');
			});
			baskets.forEach(function(item,index)
			{
				$('#categorylist').append('<li class="swap_images loading">\
					<label class="card-size category-style cardstyle " style="background-image: url(./assets/img/basket_sizes/'+item.basket_size_img+')">\
					<input type="hidden" value="./assets/img/basket_sizes/'+item.basket_size_img+'"/>\
					<input type="hidden" value="./assets/img/basket_sizes/'+item.basket_detail_img+'"/>\
					<input class="changeposition" type="radio" name="baskets" id="categorylist_'+item.basketID+'" value="'+item.basketID+'" /> <img/></label>\
					</li>');
			});
			addOns  = obj[2];

			


			if(localStorage.getItem('selectedevent'))
			{
				selectedevent = localStorage.getItem('selectedevent');

				$('#eventslist_'+selectedevent).prop("checked", true);
				$('#selectedbasket').html("");
				events.forEach(function(item,index)
				{
					if(selectedevent==item.eventID)
					{
						$('#selectedbasket').append('<h3 class="heading-card">'+item.name+' basket</h3>\
										<p id="total_price_p">Total Price :0</p>');
					}
				});
				$("#cardsize").show();
				$('#cardsize').css('visibility','visible');
				
			}
			if(localStorage.getItem('selectedCategory'))
			{
				selectedCategory = localStorage.getItem('selectedCategory');
				$('#categorylist_'+selectedCategory).prop("checked", true);
				

				baskets.forEach(function(item,index)
				{
					if(selectedCategory==item.basketID)
					{
						$('#basketcateselected').text(item.basket_size+' '+item.basket_price);
						$('#total_price_p').html('Total Price: '+item.basket_price);
						totalPrice = item.basket_price;

					}
				});

				selectedCard =  localStorage.getItem('selectedCard');

				loadCardsforthisCategory(function()
					{
						if(localStorage.getItem('selectedCard'))
						{
								selectedCard = localStorage.getItem('selectedCard')
								cards.forEach(function(item,index)
								{
									
									if(item.cardID == $(self).children().val())
									{
										selectedCard = item.cardID;
									}

								});
								$('#add-message-area').css('visibility','visible');
								$("#add-message-area").slideDown("slow");
								fetchAddonCategories(function()
									{
									// 	addOnsAddedinCart = localStorage.getItem('addOnsAddedinCart');
									// 	addOnsAddedinCart = JSON.parse(addOnsAddedinCart);
									// 	if(addOnsAddedinCart)
									// 	{
									// 	addOns.forEach(function(item,index)
									// 		{
									// 			addOnsAddedinCart.forEach(function(item_addon,index_addon)
									// 			{
									// 				if(item.addonID == item_addon.id)
									// 				{
									// 					$('#checkboxAddon'+item.addonID).attr('checked', true);
									// 					var discountedPrice = Math.ceil(item.addon_price - (item.addon_price*(item.discount/100)));
									// 					totalPriceSofar =	totalPriceSofar + (parseInt(discountedPrice)* parseInt(item_addon.quantity));
									// 					$('#addon_billing').append(
									// 						'<tr >\
									// 						<td class="heading-table">'+item.addon_name+'</td>\
									// 						<td><input id="addonID-'+item.addonID+'" class="textbox calculate_price cart-quantity" type="text" value="'+item_addon.quantity+'"></td>\
									// 						<td id="addonpriceID-'+item.addonID+'" class="heading-table">'+discountedPrice+'</td>\
									// 						<td><span id="addonremove-'+item.addonID+'" class="glyphicon glyphicon-remove sortable"></td>\
									// 						</tr>');
									// 				}
									// 			});
									// 		});
    					// 				calculateTotalPrice();
									// 	checkoutCartRemovebtn();
									// 	}else{
									// 	addOnsAddedinCart =  new Array();
									// }
									addOnsAddedinCart =  new Array();
									});
							}else{
								$(".cardtype").fadeIn("slow");
							}
					});
			}
			initialize();
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
	eventsAndBaskets();

	

$("#checkout-btn").click(function () {
	if(totalPriceSofar > 1500)
	{
		localStorage.setItem("iscustomize",true);
		localStorage.setItem("events",JSON.stringify(events));
		localStorage.setItem("selectedevent",selectedevent);
		localStorage.setItem("baskets",JSON.stringify(baskets));
		localStorage.setItem("selectedCategory",selectedCategory);
		localStorage.setItem("cards",JSON.stringify(cards));
		localStorage.setItem("selectedCard",selectedCard);
		localStorage.setItem("addOnsAddedinCart",JSON.stringify(addOnsAddedinCart));
		localStorage.setItem("addOns",JSON.stringify(addOns));
		localStorage.setItem("audiomessageurl",audiomessageurl);
		window.location.href = baseurl+"SendBasket/checkout";

	}
	else{
		alert('Total price for an order must be greater than 1500 pkr. Thankyou. ');
	}
			
	});

$('#btn_previous').click(function(){
if(whereweare==0)
{
	return;
}
else if(whereweare==1)
{
			$("#basketdiv").slideDown("slow");
			$('.cardstyle').slideDown("slow");
			$('#cardsize').css('visibility','visible');
			$("#cardsize").slideDown("slow");
			$(".cardtype").fadeOut("slow");
			$('#btn_previous').hide();
			$('#btn_next').show();
			whereweare = 0;
}
else if(whereweare==2)
{
	if(addOnsAddedinCart.length>0)
	{
		$('#btn_next').show();
	}
	whereweare = 1;
	$(".addon-section").slideUp("slow");
	$('#checkout-btn').addClass('btn-card-disabled');
	$('#checkout-btn').removeClass('btn-card');
	$('#checkout-btn').prop('disabled',true);
	$('#add-message-area').css('visibility','visible');
	$("#add-message-area").slideDown("slow");

	//$("#add-voice-btn").show();
	$(".cardtype").slideDown("slow");
}
	
});

$('#btn_next').click(function(){
	if(whereweare==0 && selectedevent>0 && selectedCategory>0)
	{
		loadCardsforthisCategory();
		if(!selectedCard)
		{
			$('#btn_next').hide();
		}
		
	}else if(whereweare==1)
	{
		$('#btn_next').hide();
		fetchAddonCategories();
	}
});




});

function checkoutCartRemovebtn()
	{
		$('.sortable').click(function(){
			var remove_id = this.id.split('-');
			
			$('#checkboxAddon'+remove_id[1]).attr('checked', false);
				for (var key in addOnsAddedinCart) {
					    var obj = addOnsAddedinCart[key];
					   if(obj['id'] == remove_id[1])
					   {
					   	 addOnsAddedinCart.splice(key,1);
					   	  $('#addonID-'+remove_id[1]).parent().parent().remove();
					   	 	localStorage.setItem("addOnsAddedinCart",JSON.stringify(addOnsAddedinCart));
					   	  calculateTotalPrice();
					   	return;
					   }
					    					  /// if( obj[]  $(this).children().val())
			}
		});

	
	}


function initialize()
{
	$( "li.swap_images" ).on({
		mouseenter: function() {
    	var image = $(this);
    	var url = $($(image.children()).children()[1]).val();
        $(image.children()).css('background-image',"url("+url+")");
  }, mouseleave: function() {
   var image = $(this);
    
    	var url = $($(image.children()).children()[0]).val();
        $(image.children()).css('background-image',"url("+url+")");
   
  }
});
	
	$(".card-image").off().click(function () {
				$("#cardsize").slideDown("slow");
				$('#cardsize').css('visibility','visible');
				$('#selectedbasket').html("");
				$('#selectedbasket').append('<h3 class="heading-card">'+this.title+' basket</h3>\
										<p id="total_price_p">Total Price :0</p>');
				selectedevent = $(this).children().val();
				localStorage.setItem('selectedevent',selectedevent);
			});

	$(".card-size").off().on('click',function () {
		$(this).off('click');
				
			
				selectedCategory =  $( $(this).children()[2]).val();

				baskets.forEach(function(item,index)
				{
					if(selectedCategory==item.basketID)
					{
						$('#basketcateselected').text(item.basket_size+' '+item.basket_price);
						$('#total_price_p').html('Total Price: '+item.basket_price);
						totalPrice = item.basket_price;

					}
				});
				localStorage.setItem('selectedCategory',selectedCategory);
				
				loadCardsforthisCategory();
			});
}
function loadCardsforthisCategory(callback)
{
	$("#basketdiv").slideUp("slow");
	$("#cardsize").slideUp("slow");
	$('#cardsize').css('visibility','hidden');
	if (typeof callback !== "function") {
		$(".cardtype").fadeIn("slow");
	}
	
$('#spinner').show();
var data_ = {eventid: selectedevent};
data_[Object.keys(token_)[0]] = Object.values(token_)[0];
 $.ajax({
		type: "post",
		url: baseurl+"CardController/getCard",
		cache: false,
		data: data_,
		success: function(json){						
		try{
			whereweare = 1;

			$('#btn_previous').show();

			
			$('#spinner').hide();

			var obj = jQuery.parseJSON(json);
			cards = obj;
			$('#cardslist').html('');
			obj.forEach(function(item,index)
			{
				$('#cardslist').append('<li class="loading giftcards">\
					<label title="'+item.card_name+'" class="cardstyle card-type-size add-message " data-zoom-image="./assets/img/card_images/'+item.card_image+'" style="background-image: url(./assets/img/card_images/'+item.card_image+')">\
					<input type="radio" id="card_'+item.cardID+'" name="foo" value="'+item.cardID+'" /> <img/>\
					</label>\
					</li>');
			});
			cardInitialize();
			if(selectedCard)
			{
				$('#card_'+selectedCard).prop("checked", true);
			}
			var timeout = null;
			var isoncard =false;
				$( ".giftcards" ).on({
				mouseenter: function(e) {
					e.preventDefault();
					isoncard = true;
					var self = this;

					clearTimeout(timeout);
					setTimeout(function() {
						if(isoncard)
						{
							var bgurl = $(self.children[0]).css('background-image');
			        		bgurl = bgurl.replace('url(','').replace(')','').replace(/\"/gi, "");
			     		    $('#showdetailimage').attr('src',bgurl);
			     		    if(!isMobile)
			     		    {
			     		    	$('#questionMarkId').css({'top':e.pageY-50,'left':e.pageX, 'position':'absolute', 'padding':'5px'});
			    				$('#questionMarkId').show();
			     		    }
			    			
						}
        					
    				}, 700);
   				
  				}, mouseleave: function(e) {
  					e.preventDefault();
  					isoncard = false;
				$('#questionMarkId').hide();
  				}
				});
			
			if (typeof callback === "function") {
        			callback();}

			cardInitialize()

	//	console.log(obj);	
		}catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(e){	
			console.log(e);
		$('#spinner').hide();					
			alert('Error while request..');
		}

});
}
function cardInitialize()
{
	$(".add-message").off().click(function () {
		$(this).off('click');
		var self = this;
		cards.forEach(function(item,index)
			{
				
				if(item.cardID == $(self).children().val())
				{
					selectedCard = item.cardID;
					localStorage.setItem('selectedCard',selectedCard);
				}

			});
				$('#add-message-area').css('visibility','visible');
				$("#add-message-area").slideDown("slow");
			});

			$("#addon-btn").click(function () {

				fetchAddonCategories();
			});

			
}
function fetchAddonCategories(callback)
{
		$('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"AddonController/fetchAddonCategories",
		cache: false,
		data:token_,
		success: function(json){						
		try{
			whereweare = 2;
			$('#spinner').hide();
			$('#checkout-btn').removeClass('btn-card-disabled');
			$('#checkout-btn').removeClass('disabled');
			$('#checkout-btn').prop('disabled',false);
			$('#checkout-btn').addClass('btn-card');
			
			var obj = jQuery.parseJSON(json);

			$('#addonsel1').find('option').remove().end();
			
			$('#addonsel1').append($('<option>',{value:0,text:"Recommended"}));
			
			obj.forEach(function(item,index)
			{
				$('#addonsel1').append($('<option>',{value:item.addon_catID,text:item.addon_cat_title}));
			});
			renderAddons();
			if (typeof callback === "function") {
					callback();
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
 $('#addonsel1').on('change', function() {
 	var data_ = {'selected':this.value};
 	data_[token_name] = csrf_hash;
 $('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"AddonController/fetchselectedAddons",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);

			addOns = obj;

			$('#addonslist').html('');
			
			addOns.forEach(function(item,index)
				{
					var discountedPrice = Math.ceil(item.addon_price - (item.addon_price*(item.discount/100)));
					var discountClass = 'hide';
					if(item.discount >0.0)
					{
						discountClass = '';
					}
					$('#addonslist').append('<li class="margin-width loading">\
						<div class="row margin-left-0 row_width">\
						<label title="'+item.addon_name+'" class="addoncartstyle cardstyle addon-image" style="background-image: url(./assets/img/addons_images/'+item.addon_image+')">\
							<input type="checkbox" id="checkboxAddon'+item.addonID+'" value="'+item.addonID+'" /> <img /> </label>\
							</div>\
							<div class="row margin-left-0 row_width">\
							<h3 class="title"><span class="brand ">'+item.addon_name+'</span></h3>\
							<span class="view-detail"><a href="#" id="details_'+item.addonID+'" class="viewdetails">View details </a></span>\
							<span class="price-box"> <span class="price"><span data-currency-iso="PKR">Rs.</span> <span dir="ltr" data-price="'+discountedPrice+'">&nbsp;'+discountedPrice+'</span> </span><div class="row '+discountClass+'"> <div class="col-xs-6"> <span class="price -old"><span data-currency-iso="PKR">Rs.</span> <span dir="ltr" data-price="'+item.addon_price+'">&nbsp;'+item.addon_price+'</span> </span> </div> <div class="col-xs-6"> <span class="sale-discount">  -'+item.discount+'%</span> </div> </div></span>\
					</div></li>');

					for (var key in addOnsAddedinCart) {
					    var obj = addOnsAddedinCart[key];
					   if(obj['id'] == item.addonID)
					   {
					   	$('#checkboxAddon'+item.addonID).attr('checked', true);
					   }
					    					  /// if( obj[]  $(this).children().val())
					}

				});

			eventHooksAddons();
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
});
}
function renderAddons()
{
				$('#add-message-area').css('visibility','hidden');
				$("#add-message-area").slideUp("slow");
				$("#add-voice-btn").hide();
				$(".cardtype").slideUp("slow");
				$(".addon-section").slideDown("slow");
				userMessage = $('#greetings').val();
				localStorage.setItem('message',userMessage);
				
				$('#addonslist').html('');

				addOns.forEach(function(item,index)
				{
					var discountedPrice = Math.ceil(item.addon_price - (item.addon_price*(item.discount/100)));
					var discountClass = 'hide';
					if(item.discount >0.0)
					{
						discountClass = '';
					}

					$('#addonslist').append('<li class="margin-width loading">\
						<div class="row margin-left-0 row_width">\
						<label title="'+item.addon_name+'" class="addoncartstyle cardstyle addon-image" style="background-image: url(./assets/img/addons_images/'+item.addon_image+')">\
							<input type="checkbox" id="checkboxAddon'+item.addonID+'" value="'+item.addonID+'" /> <img /> </label>\
							</div>\
							<div class="row margin-left-0 row_width">\
							<h3 class="title"><span class="brand ">'+item.addon_name+'</span></h3>\
							<span class="view-detail"><a href="#" id="details_'+item.addonID+'" class="viewdetails">View details </a></span>\
							<span class="price-box"> <span class="price"><span data-currency-iso="PKR">Rs.</span> <span dir="ltr" data-price="'+discountedPrice+'">&nbsp;'+discountedPrice+'</span> </span><div class="row '+discountClass+'"> <div class="col-xs-6"> <span class="price -old"><span data-currency-iso="PKR">Rs.</span> <span dir="ltr" data-price="'+item.addon_price+'">&nbsp;'+item.addon_price+'</span> </span> </div> <div class="col-xs-6"> <span class="sale-discount">  -'+item.discount+'%</span> </div> </div></span>\
					</div></li>');
					if(addOnsAddedinCart)
					{
						for (var key in addOnsAddedinCart) {
					    var obj = addOnsAddedinCart[key];
					   if(obj['id'] == item.addonID)
					   {
					   	$('#checkboxAddon'+item.addonID).attr('checked', true);
					   }
					    					  /// if( obj[]  $(this).children().val())
						}
					}
					
				});


				eventHooksAddons();

  



}

function eventHooksAddons()
{

	$('.addon-image').click(function(e){
					//$(this).off('click');
					if(e.target.tagName == "INPUT") return;
					var self = this;

					for (var key in addOnsAddedinCart) {
					    var obj = addOnsAddedinCart[key];
					   if(obj['id'] == $(this).children().val())
					   {
					   	 addOnsAddedinCart.splice(key,1);
					   	  $('#addonID-'+$(this).children().val()).parent().parent().remove();
					   	 	localStorage.setItem("addOnsAddedinCart",JSON.stringify(addOnsAddedinCart));
					   	  calculateTotalPrice();
					   	return;
					   }
					    					  /// if( obj[]  $(this).children().val())
					}

						
						addOns.forEach(function(item,index)
						{
								if(item.addonID == $(self).children().val())
									{
										var discountedPrice = Math.ceil(item.addon_price - (item.addon_price*(item.discount/100)));
										$('#addon_billing').append(
											'<tr >\
											<td class="heading-table">'+item.addon_name+'</td>\
											<td><input id="addonID-'+item.addonID+'" class="textbox calculate_price cart-quantity" type="text" value="1"></td>\
											<td id="addonpriceID-'+item.addonID+'" class="heading-table">'+discountedPrice+'</td>\
											<td><span id="addonremove-'+item.addonID+'" class="glyphicon glyphicon-remove sortable"></td>\
											</tr>');
										addOnsAddedinCart.push({id:$(self).children().val(),quantity:1,price:discountedPrice,name:item.addon_name});
									}
							
							});
						localStorage.setItem("addOnsAddedinCart",JSON.stringify(addOnsAddedinCart));
						calculateTotalPrice();
						checkoutCartRemovebtn();


					
			$('.calculate_price').change(function(){
				var self = this;
					addOnsAddedinCart.forEach(function(item,index)
						{
								if("addonID-"+item.id == $(self).attr('id'))
								{
									$('#addonpriceID-'+item.id).html($(self).val()*item.price);
									for (var key in addOnsAddedinCart) {
									    var obj = addOnsAddedinCart[key];
									   if(obj['id'] == item.id)
									   {
									   		addOnsAddedinCart[key]['quantity'] = parseInt($(self).val());
				   					   }	  
									}
								}
							
							});
					calculateTotalPrice();
			});
			});

	$('.viewdetails').click(function(event){
	 event.preventDefault();
	 var id = this.id;
	 id = id.split('_');
	 id = id[1];

	 addOns.forEach(function(item,index)
		{
			if(item.addonID == id)
			{
				$('#modal_addon_name').text(item.addon_name);
				$('#modal_addon_image').attr("src",'./assets/img/addons_images/'+item.addon_image);
				var description = "No description available";
				if(item.description != "")
				{
					description = item.description;
				}
				$('#modal_addon_desc').html(description);
				$('#modal_addon_cname').html('Emoey');
				$('#modal_addon_price').html("Rs "+item.addon_price);
				$('#addonDetailModal').modal({
  						onOpen: function (dialog) {
					    dialog.data.show();
					    dialog.container.show();
					    dialog.overlay.fadeIn('fast');
					  }
					});
				$('.addonImageZoom').zoom();
				return;
			}			
				
		});
});
}

function voiceuploadedcart()
{
	$('#basketcateselected').text('Voice message: 400');
	totalPrice = parseInt(totalPrice) + 400;
	calculateTotalPrice();
}

function calculateTotalPrice()
{
	totalPriceSofar = 0;

		addOnsAddedinCart.forEach(function(item_addon,index_addon)
		{
			totalPriceSofar = totalPriceSofar + (parseInt(item_addon.price)* parseInt(item_addon.quantity));
		});

	totalPriceSofar += parseInt(totalPrice);
	$('#total_price_p').html('Total Price: '+totalPriceSofar);
}


