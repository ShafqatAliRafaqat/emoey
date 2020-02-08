 <div class="container" style="margin-top:100px">
    <div class="row">
          <div class="col-md-3">
                        <h3>Edit Event</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('Admin_p/EditDeleteProducts/editEvent',array(
    'class' => 'form-horizontal')); ?>
                        <input type="hidden"  id="inputName" name="eventID" value="<?php echo $eventID; ?>">
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="event_name" placeholder="Event name" value="<?php echo $name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_image" class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                               <input type="file" name="event_image" accept=".jpg,.png,image/*"/> 
                                <img class="prw_img" src="<?php echo base_url(); ?>assets/img/events_images/<?php echo $image; ?>" width="543" height="300" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Date from</label>
                            <div class="col-lg-10">
                                <input type="date" class="form-control" id="date_from" name="date_from" placeholder="Event Start date" value="<?php echo $date_from; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Date to</label>
                            <div class="col-lg-10">
                                <input type="date" class="form-control" id="date_to" name="date_to" placeholder="Event End date" value="<?php echo $date_to; ?>">
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="is_enabled" class="col-lg-2 control-label">Enabled</label>
                            <div class="col-lg-10">

                                <input type="checkbox" value="<?php echo $is_enabled; ?>" id="is_enabled" name="is_enabled" <?php echo $enablestatus; ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Update Event</button>
                            </div>
                        </div>
                    </form>
                      </div>
      </div>
  </div>

  <script type="text/javascript">

  $( document ).ready(function() {
   $('#is_enabled').change(function() {
        if($(this).is(":checked")) {
            $('#is_enabled').val(1);  
        }else{
             $('#is_enabled').val(0);  
        }
             
    });
 });
    
var id='1'; // set default id for first img tag
       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.prw_img').attr('src', e.target.result).width(300).height(300);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
  </script>