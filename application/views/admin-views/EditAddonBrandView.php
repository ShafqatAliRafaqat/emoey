<div id="spinner" 
    style="display:none;position:fixed;top:0px;right:0px;width:100%;height:100%; background-color:rgba(189, 206, 204, 0.498039);background-image:url('<?php echo base_url();?>/assets/img/spinner.gif'); background-repeat:no-repeat;background-position:center;z-index:10000000; ">
</div>
<div class="container" style="margin-top:100px">

	 <div class="row">
                      <div class="col-md-3">
                        <h3>Edit Addon Brand</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('Admin_p/EditDeleteProducts/editAddonBrand',array(
    'class' => 'form-horizontal'));  ?>
    <input type="hidden"  id="addon_brandID" name="addon_brandID" value="<?php echo $addon_brandID; ?>">
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="addon_brand_title" name="addon_brand_title" placeholder="Brand name" value="<?php echo $addon_brand_title; ?>">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Discount</label>
                            <div class="col-lg-10">
                                <input type="number" step="0.01" class="form-control" id="discount" name="discount" placeholder="Discount" value="<?php echo $discount; ?>">
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
