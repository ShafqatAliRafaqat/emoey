<div id="spinner" 
    style="display:none;position:fixed;top:0px;right:0px;width:100%;height:100%; background-color:rgba(189, 206, 204, 0.498039);background-image:url('<?php echo base_url();?>/assets/img/spinner.gif'); background-repeat:no-repeat;background-position:center;z-index:10000000; ">
</div>
<div class="container" style="margin-top:100px">

	 <div class="row">
                      <div class="col-md-3">
                        <h3>Edit Hot Deals</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('Admin_p/EditDeleteProducts/editHotDeal',array(
    'class' => 'form-horizontal'));  ?>
        <input type="hidden"  id="inputName" name="baskets_store_id" value="<?php echo $baskets_store_id; ?>">
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="basketstorename" placeholder="Hot deal Name" value="<?php echo $name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Price</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="inputNumber" name="basketstore_price" placeholder="Price" value="<?php echo $price; ?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                               <textarea rows="5" class="form-control" class="form-control" id="inputNumber" name="basketstore_desc" placeholder="Description" value="<?php echo trim($description); ?>"><?php echo trim($description); ?></textarea>
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Tags</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="basketstoretags" placeholder="Hot deal Name" value="<?php echo $tags; ?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputSubject" class="col-lg-2 control-label">Images</label>
                            <div class="col-lg-10">
                                <input type="file" name="store_images[]" accept=".jpg,.png,image/*"  multiple="" />
                                <ul class="list-inline">
                                <?php for($i=0;$i<count($dealimages);$i++) { ?>
                                <li> 
                                <img class="prw_img" src="<?php echo base_url(); ?>assets/img/basket_store/<?php echo $dealimages[$i]; ?>" width="300" height="300" />
                                </li>
                                <?php } ?>
                                </ul>

                                
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Select Category(You can select Multiple)</label>
                            <div class="col-lg-10">
                                <select multiple class="form-control" id="category_select" name="category_select[]">
                                 
                                  </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Select Items of deal</label>
                            <div class="col-lg-10">
                               <ul id="list-addons">
                                
                              </ul>
                            </div>
                        </div>

                         <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Update Hot Deal</button>
                            </div>
                        </div>
                    </form>
                      </div>
                  </div>


</div>
<script>
var items = '<?php echo $items; ?>';
 items = items.replace(/\s/g,'');
var itemsarr = items.split(",");

var categories = '<?php echo $dealcategory; ?>';
 categories = categories.replace(/\s/g,'');
var categoriesarr = categories.split(",");

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
                $('#category_select').append($('<option>',
                 {
                    value: item.eventID,
                    text : item.name
                }));


            });
                 var select = document.getElementById('category_select')
                for ( var i = 0, l = select.options.length, o; i < l; i++ )
                {
                  o = select.options[i];
                  if ( categoriesarr.indexOf( o.value ) != -1 )
                  {
                    o.selected = true;
                  }
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
            var checked = "";
            obj.forEach(function(item,index)
            {
                if (itemsarr.indexOf( item.addonID ) != -1 )
                {
                    checked = "checked";
                }
                else{
                    checked = "";
                }
                $('#list-addons').append('<li>\
                    <input type="checkbox" id="cb'+item.addonID+'" name="addonchecklist[]" value="'+item.addonID+'  " '+checked+' />\
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

var id='1'; // set default id for first img tag
       function readURL(input) {
        //console.log(input);
        //console.log(input.id);
            // if (input.files && input.files[0]) {
            //     var reader = new FileReader();

            //     reader.onload = function (e) {
            //         $('.prw_img').attr('src', e.target.result).width(300).height(300);
            //     };

            //     reader.readAsDataURL(input.files[0]);
            // }
        }



</script>
