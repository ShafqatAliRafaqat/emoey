	var data_ = {};
	data_[token_name] = csrf_hash;

function fetchOrders()
{

	$('#spinner').show();

 $.ajax({
		type: "post",
		url: baseurl+"Order/getAllOrders",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			$('#ordersbody').html('');
			
			obj.forEach(function(item,index)
			{
				var delivery_date,orderdate;
				delivery_date = new Date(item.delivery_date);
				delivery_date = delivery_date.toDateString();
				orderdate = new Date(item.date);
				orderdate = orderdate.toDateString();

				$('#ordersbody').append('<tr><th scope="row">'+item.customerorderid+'</th>\
					<td style="min-width:200px;"> '+item.paymentmethod+'</td>\
					<td style="min-width:200px;"> PKR: '+item.finalPrice+'</td>\
					<td style="min-width:200px;"> '+item.basket_size+'</td>\
					<td style="min-width:200px;">'+item.card_name+'</td>\
					<td style="min-width:400px;"><ul id="addonOrder_'+item.orderID+'"></ul></td>\
					<td style="min-width:200px;">'+item.receiverName+'</td>\
					<td style="min-width:200px;">'+item.address+'</td>\
					<td style="min-width:200px;">'+item.receiverNumber+'</td>\
					<td style="min-width:200px;">'+item.firstname+' '+item.lastname+'</td>\
					<td style="min-width:200px;">'+item.phone_number+'</td>\
					<td style="min-width:200px;">'+item.email+'</td>\
					<td style="min-width:400px;">'+item.message+'</td>\
					<td style="min-width:400px;"><audio id="recordedaudio" src="'+baseurl+'resources/recordings/'+item.vMessageURL+'" controls=""></audio></td>\
					<td style="min-width:200px;">'+delivery_date+'</td>\
					<td style="min-width:200px;"><select class="changestatus" id="'+item.orderID+'" data-default="Pending"><option value="Pending">Pending</option><option value="Processed">Processed</option></select></td>\
					<td style="min-width:200px;">'+orderdate+'</td>\
					</tr>')

			});

			obj.forEach(function(item,index)
			{
				item.addons.forEach(function(addonitem,index)
				{
					$('#addonOrder_'+item.orderID).append('<li> Name: '+addonitem.addon_name+', Price: '+addonitem.addon_price+', Quantity: '+addonitem.quantity+'</li>');

				});
			});


			$('.changestatus').on('change', function() {
				if(this.value == 'Processed')
				{
					if(confirm('Are you sure you want to Process this Order ? '))
					{
						processOrder(this.id);
					}
					else{
						var $select = $(this);
						$(this).val($select.data('default'));
           				return true;
					}
				}


			});


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

function fetchOrders_Processed()
{
	$('#spinner').show();

 $.ajax({
		type: "post",
		url: baseurl+"Order/getAllOrdersProcessed",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			
			$('#ordersbody').html('');
			
			obj.forEach(function(item,index)
			{
				var delivery_date,orderdate;
				delivery_date = new Date(item.delivery_date);
				delivery_date = delivery_date.toDateString();
				orderdate = new Date(item.date);
				orderdate = orderdate.toDateString();

				$('#ordersbody').append('<tr><th scope="row">'+item.customerorderid+'</th>\
					<td style="min-width:200px;"> '+item.paymentmethod+'</td>\
					<td style="min-width:200px;"> PKR: '+item.finalPrice+'</td>\
					<td style="min-width:200px;"> '+item.basket_size+'</td>\
					<td style="min-width:200px;">'+item.card_name+'</td>\
					<td style="min-width:400px;"><ul id="addonOrder_'+item.orderID+'"></ul></td>\
					<td style="min-width:200px;">'+item.receiverName+'</td>\
					<td style="min-width:200px;">'+item.address+'</td>\
					<td style="min-width:200px;">'+item.receiverNumber+'</td>\
					<td style="min-width:200px;">'+item.firstname+' '+item.lastname+'</td>\
					<td style="min-width:200px;">'+item.phone_number+'</td>\
					<td style="min-width:200px;">'+item.email+'</td>\
					<td style="min-width:400px;">'+item.message+'</td>\
					<td style="min-width:400px;"><audio id="recordedaudio" src="'+baseurl+'resources/recordings/'+item.vMessageURL+'" controls=""></audio></td>\
					<td style="min-width:200px;">'+delivery_date+'</td>\
					<td style="min-width:200px;">Processed</td>\
					<td style="min-width:200px;">'+orderdate+'</td>\
					</tr>')

			});

			obj.forEach(function(item,index)
			{
				item.addons.forEach(function(addonitem,index)
				{
					$('#addonOrder_'+item.orderID).append('<li> Name: '+addonitem.addon_name+', Price: '+addonitem.addon_price+', Quantity: '+addonitem.quantity+'</li>');

				});
			});


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

function processOrder(orderid)
{
	$('#spinner').show();
	var orderData =  {'orderid':orderid};
	orderData[token_name] = csrf_hash;

 $.ajax({
		type: "post",
		url: baseurl+"Order/processOrder",
		cache: false,
		data: orderData,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			if(obj==200)
			{
				fetchOrders();
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
function processOrderBaskerStore(orderid)
{
	$('#spinner').show();
	var orderData =  {'orderid':orderid};
	orderData[token_name] = csrf_hash;
 $.ajax({
		type: "post",
		url: baseurl+"Order/processOrderBasketStore",
		cache: false,
		data: orderData,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			if(obj==200)
			{
				fetchBasketStoreOrders();
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

function fetchBasketStoreOrders()
{
	$('#spinner').show();

 $.ajax({
		type: "post",
		url: baseurl+"Order/getAllBasketStoreOrders",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			
			$('#basketstoreordersbody').html('');
			
			obj.forEach(function(item,index)
			{
				$('#basketstoreordersbody').append('<tr><th scope="row">'+item.customerorderid+'</th>\
					<td style="min-width:200px;"> '+item.paymentmethod+'</td>\
					<td style="min-width:200px;"> '+item.name+'</td>\
					<td style="min-width:200px;"><select class="changestatus_store" id="'+item.basket_store_order_id+'"><option value="Pending">Pending</option><option value="Processed">Processed</option></select></td>\
					<td style="min-width:200px;">'+item.receiverName+'</td>\
					<td style="min-width:200px;">'+item.address+'</td>\
					<td style="min-width:200px;">'+item.receiverNumber+'</td>\
					<td style="min-width:200px;">'+item.firstname+' '+item.lastname+'</td>\
					<td style="min-width:200px;">'+item.phone_number+'</td>\
					<td style="min-width:200px;">'+item.email+'</td>\
					<td style="min-width:200px;">'+item.delivery_date+'</td>\
					<td style="min-width:200px;">'+item.date+'</td>\
					</tr>')

			});



			$('.changestatus_store').on('change', function() {
				if(this.value == 'Processed')
				{
					if(confirm('Are you sure you want to Process this Basket Store Order ? '))
					{
						processOrderBaskerStore(this.id);
					}
					else{
						var $select = $(this);
						$(this).val($select.data('default'));
           				return true;
					}
				}


			});


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


function fetchBasketStoreOrders_Processed()
{
	$('#spinner').show();

 $.ajax({
		type: "post",
		url: baseurl+"Order/getAllBasketStoreOrders_Processed",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			
			$('#basketstoreordersbody').html('');
			
			obj.forEach(function(item,index)
			{
				$('#basketstoreordersbody').append('<tr><th scope="row">'+item.customerorderid+'</th>\
					<td style="min-width:200px;"> '+item.paymentmethod+'</td>\
					<td style="min-width:200px;">Processed</td>\
					<td style="min-width:200px;">'+item.receiverName+'</td>\
					<td style="min-width:200px;">'+item.address+'</td>\
					<td style="min-width:200px;">'+item.receiverNumber+'</td>\
					<td style="min-width:200px;">'+item.firstname+' '+item.lastname+'</td>\
					<td style="min-width:200px;">'+item.phone_number+'</td>\
					<td style="min-width:200px;">'+item.email+'</td>\
					<td style="min-width:200px;">'+item.delivery_date+'</td>\
					<td style="min-width:200px;">'+item.date+'</td>\
					</tr>')

			});


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

function fetchOrdersCount()
{

 $.ajax({
		type: "post",
		url: baseurl+"Order/getOrdersCount",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			
			var obj = jQuery.parseJSON(json);
			$('#customorderscount').text(obj.c_orders);
			$('#basketstoreorderscount').text(obj.b_orders);

		}catch(e) {
			console.log(e);
		}		
		},
		error: function(xhr, ajaxOptions, thrownError){	
		
		}

});
}
