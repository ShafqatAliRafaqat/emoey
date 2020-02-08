

$( document ).ready(function() {
	var data_ = {};
	data_[token_name] = csrf_hash;
$('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"Admin/getCategories",
		cache: false,
		data: data_,
		success: function(json){						
		try{
			$('#spinner').hide();
		    var obj = jQuery.parseJSON(json);
			obj.forEach(function(item,index)
			{
                $('#events_select').append($('<option>',
				 {
				    value: item.eventID,
				    text : item.name
				}));
                $('#category_select').append($('<option>',
				 {
				    value: item.eventID,
				    text : item.name
				}));

			});	
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
  st=document.getElementById("addon_brand");
  if(st){
  	  $.ajax({
		type: "post",
		url: baseurl+"Admin/getAddonBrands",
		cache: false,
		data: data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			console.log(obj);
			 st=document.getElementById("addon_brand");

			obj.forEach(function(item,index)
			{
				 var opt = document.createElement('option');
                opt.value = item.addon_brandID;
                opt.innerHTML = item.addon_brand_title;
                st.appendChild(opt);

			});	
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

  st=document.getElementById("addon_cate");
  if(st){
  	 $.ajax({
		type: "post",
		url: baseurl+"Admin/getAddonCategories",
		cache: false,
		data: data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			console.log(obj);
			 st=document.getElementById("addon_cate");

			obj.forEach(function(item,index)
			{
				 var opt = document.createElement('option');
                opt.value = item.addon_catID;
                opt.innerHTML = item.addon_cat_title;
                st.appendChild(opt);

			});	
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


  $.ajax({
		type: "post",
		url: baseurl+"Admin/getAddons",
		cache: false,
		data: data_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			$('#list-addons').html('');
			obj.forEach(function(item,index)
			{
				$('#list-addons').append('<li>\
					<input type="checkbox" id="cb'+item.addonID+'" name="addonchecklist[]" value="'+item.addonID+'	" />\
                    <label for="cb'+item.addonID+'" class="addons_label"><img src="'+baseurl+'assets/img/addons_images/'+item.addon_image+'" /></label>\
                    <p><strong>'+item.addon_name+'</strong></p>\
                                </li>');
			});	
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