
 <div id="spinner" 
    style="display:none;position:fixed;top:0px;right:0px;width:100%;height:100%; background-color:rgba(189, 206, 204, 0.498039);background-image:url('<?php echo base_url();?>/assets/img/spinner.gif'); background-repeat:no-repeat;background-position:center;z-index:10000000; ">
</div>
  <div class="container" style="margin-top:120px">
   <div class="row">

<div class="col-md-3">
      <ul class="nav nav-pills nav-stacked">
        <li class="active eventClicked" id="addon"><a href="#">Addons</a></li>
        <li class="eventClicked" id="events"><a href="#">Events</a></li>
        <li  class="eventClicked" id="baskets"><a href="#">Baskets</a></li>
        <li  class="eventClicked" id="cards"><a href="#">Cards</a></li>
        <li  class="eventClicked" id="addoncategory"><a href="#">Addon Category</a></li>
        <li  class="eventClicked" id="addonbrands"><a href="#">Addon Brands</a></li>
        <li  class="eventClicked" id="basketstore"><a href="#">Hot Deals</a></li>
      </ul>
    </div>
    <div class="col-md-7">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody id="tableprop">

  </tbody>
</table>
    </div>

    </div>
  </div>


  <script type="text/javascript">
	var data_ = {};
	data_[token_name] = csrf_hash;
  $( document ).ready(function() {
  	switchit = 0;
  	eventsAndBaskets();
  });
  var events,baskets,addons,cards,addoncategory,addonbrands,basketstore;
  var switchit;
  	function eventsAndBaskets()
	{
		$('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"Admin_p/EditDeleteProducts/getAllData",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			events = obj[1];
			baskets = obj[0];
			addons  = obj[2];
			cards = obj[3];
			addoncategory = obj[4];
			addonbrands = obj[5];
			basketstore = obj[6];

			$('#tableprop').html('');

			renderSwitch(switchit);
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

	 function renderSwitch(value)
		 {
		 	$('.eventClicked').each(function(index){
		 		$(this).removeClass('active');
		 	});


		 	switch(value){
		 		case 0:
					$('#addon').addClass('active');
				 	addons.forEach(function(item,index)
					{
						$('#tableprop').append('<tr>\
						<th scope="row">'+item.addonID+'</th>\
						 <td>'+item.addon_name+'</td>\
						 <td><button class="btn btn-danger delete_addon" id="'+item.addonID+'">Delete</button></td>\
						  <td><a class="btn btn-info edit_addon" href="<?php echo base_url(); ?>Admin_p/EditDeleteProducts/editViewAddon/?id='+item.addonID+'" id="'+item.addonID+'">\
						  Edit</a></td>\
							</tr>');
					});
		 		break;
		 		case 1:
		 		$('#events').addClass('active');
		 			events.forEach(function(item,index)
					{
						
						$('#tableprop').append('<tr>\
						<th scope="row">'+item.eventID+'</th>\
						 <td>'+item.name+'</td>\
						 <td><button class="btn btn-danger delete_events" id="'+item.eventID+'">Delete</button></td>\
						  <td><a href="<?php echo base_url(); ?>Admin_p/EditDeleteProducts/editViewEvent/?id='+item.eventID+'" class="btn btn-info edit" id="'+item.eventID+'">Edit</a></td>\
							</tr>');
						});
		 		break;
		 		case 2:
		 		$('#baskets').addClass('active');
		 			baskets.forEach(function(item,index)
					{
						$('#tableprop').append('<tr>\
						<th scope="row">'+item.basketID+'</th>\
						 <td>'+item.basket_size+'</td>\
						 <td><button class="btn btn-danger delete_basket" id="'+item.basketID+'">Delete</button></td>\
						  <td><button class="btn btn-info edit" id="'+item.basketID+'">Edit</button></td>\
							</tr>');
					});
		 		break;
		 		case 3:
		 		$('#cards').addClass('active');
		 			cards.forEach(function(item,index)
					{
						$('#tableprop').append('<tr>\
						<th scope="row">'+item.cardID+'</th>\
						 <td>'+item.card_name+'</td>\
						 <td><button class="btn btn-danger delete_card" id="'+item.cardID+'">Delete</button></td>\
						  <td><button class="btn btn-info edit" id="'+item.cardID+'">Edit</button></td>\
							</tr>');
					});
		 		break;
		 		case 4:
		 		$('#addoncategory').addClass('active');
		 			addoncategory.forEach(function(item,index)
					{
						$('#tableprop').append('<tr>\
						<th scope="row">'+item.addon_catID+'</th>\
						 <td>'+item.addon_cat_title+'</td>\
						 <td><button class="btn btn-danger delete_addon_category" id="'+item.addon_catID+'">Delete</button></td>\
						  <td><button class="btn btn-info edit" id="'+item.addon_catID+'">Edit</button></td>\
							</tr>');
					});
		 		break;
		 		case 5:
		 		$('#addonbrands').addClass('active');
		 			addonbrands.forEach(function(item,index)
					{
						$('#tableprop').append('<tr>\
						<th scope="row">'+item.addon_brandID+'</th>\
						 <td>'+item.addon_brand_title+'</td>\
						 <td><button class="btn btn-danger delete_addon_brand" id="'+item.addon_brandID+'">Delete</button></td>\
						  <td><a class="btn btn-info edit" href="<?php echo base_url(); ?>Admin_p/EditDeleteProducts/editViewAddonBrands/?id='+item.addon_brandID+'" id="'+item.addon_brandID+'">Edit</a></td>\
							</tr>');
					});
		 		break;
		 		case 6:
		 		$('#basketstore').addClass('active');
		 			basketstore.forEach(function(item,index)
					{
						$('#tableprop').append('<tr>\
						<th scope="row">'+item.baskets_store_id+'</th>\
						 <td>'+item.name+'</td>\
						 <td><button class="btn btn-danger delete_basketstore" id="'+item.baskets_store_id+'">Delete</button></td>\
						  <td><a class="btn btn-info edit" href="<?php echo base_url(); ?>Admin_p/EditDeleteProducts/editViewHotdeals/?id='+item.baskets_store_id+'" id="'+item.baskets_store_id+'">Edit</a></td>\
							</tr>');
					});
		 		break;
		 		

		 	}
		 	 initialize();
		 }
	function initialize()
	{
		 $('.eventClicked').click(function(){
		 	
		 	$(this).addClass('active');
		 	$('#tableprop').html('');
		 	if(this.id=='events')
		 	{
		 		renderSwitch(1);
		 	}else if(this.id=='baskets')
		 	{
		 		renderSwitch(2);
		 	}else if(this.id=='addon')
		 	{
		 		renderSwitch(0);
		 	}else if(this.id == 'cards'){
		 		renderSwitch(3);
		 	}else if(this.id == 'addoncategory')
		 	{
		 		renderSwitch(4);
		 	}else if(this.id == 'addonbrands')
		 	{
		 		renderSwitch(5);
		 	}
		 	else if(this.id== 'basketstore')
		 	{
		 		renderSwitch(6);
		 	}

		 });

		

		 $('.delete_addon').click(function()
		 {
		 	var deleteaddondata = {'addonid':this.id};
		 	deleteaddondata[token_name] = csrf_hash;
		 	
		 	$('#spinner').show();
		 	 $.ajax({
		type: "post",
		url: baseurl+"Admin_p/EditDeleteProducts/deleteaddon",
		cache: false,
		data:deleteaddondata,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			switchit  = 0;
			eventsAndBaskets();

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

		 });

		  $('.delete_basket').click(function()
		   {

		   	var delete_basketdata = {'basketid':this.id};
		 	delete_basketdata[token_name] = csrf_hash;

		 	$('#spinner').show();
		 	 $.ajax({
		type: "post",
		url: baseurl+"Admin_p/EditDeleteProducts/deletebasket",
		cache: false,
		data:delete_basketdata,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			switchit  = 2;
			eventsAndBaskets();

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

		 });

	 $('.delete_events').click(function()
		 {
		 	var delete_events = {'eventid':this.id};
		 	delete_events[token_name] = csrf_hash;

		 	$('#spinner').show();
		 	 $.ajax({
		type: "post",
		url: baseurl+"Admin_p/EditDeleteProducts/deleteevents",
		cache: false,
		data:delete_events,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			switchit  = 1;
			eventsAndBaskets();

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

		 });
	 	 $('.delete_card').click(function()
		 {
		 	var delete_card = {'cardid':this.id};
		 	delete_card[token_name] = csrf_hash;
		 	
		 	$('#spinner').show();
		 	 $.ajax({
		type: "post",
		url: baseurl+"Admin_p/EditDeleteProducts/deletecard",
		cache: false,
		data:delete_card,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			switchit  = 3;
			eventsAndBaskets();

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

		 });

	 $('.delete_addon_category').click(function()
		 {
		 	var delete_addon_category = {'addoncateid':this.id};
		 	delete_addon_category[token_name] = csrf_hash;

		 	$('#spinner').show();
		 	 $.ajax({
		type: "post",
		url: baseurl+"Admin_p/EditDeleteProducts/deleteAddonCategory",
		cache: false,
		data:delete_addon_category,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			switchit  = 4;
			eventsAndBaskets();

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

		 });

		 $('.delete_addon_brand').click(function()
		   {

		   	var delete_addon_brand = {'addonbrandid':this.id};
		 	delete_addon_brand[token_name] = csrf_hash;

		 	$('#spinner').show();
		 	 $.ajax({
		type: "post",
		url: baseurl+"Admin_p/EditDeleteProducts/deleteAddonBrand",
		cache: false,
		data:delete_addon_brand,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			switchit  = 5;
			eventsAndBaskets();

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

		 });

		  $('.delete_basketstore').click(function()
		   {
		 	$('#spinner').show();

		 	var delete_basketstore = {'baskets_store_id':this.id};
		 	delete_basketstore[token_name] = csrf_hash;

		 	 $.ajax({
				type: "post",
				url: baseurl+"Admin_p/EditDeleteProducts/deleteBasketStore",
				cache: false,
				data:delete_basketstore,
				success: function(json){						
				try{
					$('#spinner').hide();
					var obj = jQuery.parseJSON(json);
					switchit  = 6;
					eventsAndBaskets();

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

		 });

	}

  </script>