<div id="spinner" 
    style="display:none;position:fixed;top:0px;right:0px;width:100%;height:100%; background-color:rgba(189, 206, 204, 0.498039);background-image:url('<?php echo base_url();?>/assets/img/spinner.gif'); background-repeat:no-repeat;background-position:center;z-index:10000000; ">
</div>
<div class="container" style="margin-top:100px">

	 <div class="row">
                      <div class="col-md-3">
                        <h3>Edit Addons</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('Admin_p/EditDeleteProducts/editAddon',array(
    'class' => 'form-horizontal'));  ?>
    <input type="hidden"  id="inputName" name="addonID" value="<?php echo $addonID; ?>">
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="addon_name" placeholder="Addon name" value="<?php echo $addon_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="event_image" class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                               <input type="file" name="addon_image" accept=".jpg,.png,image/*"/> 
                               <img src="<?php echo base_url(); ?>assets/img/addons_images/<?php echo $addon_image; ?>" width="300" height="300">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addon_price" class="col-lg-2 control-label">Price</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="addon_price" name="addon_price" placeholder="Price" value="<?php echo $addon_price; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addon_desc" class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                              <textarea rows="5" class="form-control" id="addon_desc" name="addon_desc" placeholder="Description"> <?php echo trim(htmlspecialchars($description)); ?></textarea>

                             
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="addon_cate" class="col-lg-2 control-label">Select Addon Category</label>
                            <div class="col-lg-10">
                                <select class="form-control" id="addon_cate" name="addon_cate">
                                 
                                  </select>
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="addon_brand" class="col-lg-2 control-label">Select Addon Brand</label>
                            <div class="col-lg-10">
                                <select  class="form-control" id="addon_brand" name="addon_brand">
                                 
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="isrecommended" class="col-lg-2 control-label">Recommended</label>
                            <div class="col-lg-10">

                                <input type="checkbox" value="<?php echo $isrecommended; ?>" id="isrecommended" name="isrecommended" <?php echo $recommendedstatus; ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                      </div>
                  </div>


</div>

<script>

$( document ).ready(function() {

     $('#isrecommended').change(function() {
        if($(this).is(":checked")) {
            $('#isrecommended').val(1);  
        }else{
             $('#isrecommended').val(0);  
        }
             
    });

	var addonbrandidselected = '<?php echo $addon_brandID; ?>';
	var addoncatidselected = '<?php echo $addon_catID; ?>';
    var data_ = {};
    data_[token_name] = csrf_hash;
	
	  $.ajax({
		type: "post",
		url: baseurl+"Admin/getAddonBrands",
		cache: false,
        data:data_,
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
                if(addonbrandidselected == item.addon_brandID)
                {
                	opt.selected = true;
                }

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
 $.ajax({
		type: "post",
		url: baseurl+"Admin/getAddonCategories",
		cache: false,
        data:data_,
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
                if(addoncatidselected == item.addon_catID)
                {
                	opt.selected = true;
                }
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



});

</script>