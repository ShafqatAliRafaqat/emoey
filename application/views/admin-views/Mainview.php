                 
<?php echo asset_js("admin.js"); ?>
    <div id="spinner" 
    style="display:none;position:fixed;top:0px;right:0px;width:100%;height:100%; background-color:rgba(189, 206, 204, 0.498039);background-image:url('<?php echo base_url();?>/assets/img/spinner.gif'); background-repeat:no-repeat;background-position:center;z-index:10000000; ">
</div>
    <div class="container" style="margin-top:100px">
                  <div class="row">
                      <div class="col-md-3">
                        <h3>Add Event</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('/admin/add_Event',array(
    'class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="event_name" placeholder="Event name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_image" class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                               <input type="file" name="event_image" accept=".jpg,.png,image/*"/> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Date from</label>
                            <div class="col-lg-10">
                                <input type="date" class="form-control" id="date_from" name="date_from" placeholder="Event Start date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Date to</label>
                            <div class="col-lg-10">
                                <input type="date" class="form-control" id="date_to" name="date_to" placeholder="Event End date">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                      </div>
                  </div>
                <hr/>
                     <div class="row">
                      <div class="col-md-3">
                        <h3>Add Basket Category</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('/admin/add_Basket',array(
    'class' => 'form-horizontal'));  ?>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="basket_name" placeholder="Basket Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSubject" class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                               <input type="file" name="basket_image" accept=".jpg,.png,image/*"/> 
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputSubject" class="col-lg-2 control-label">Detail Image</label>
                            <div class="col-lg-10">
                               <input type="file" name="basket_image_detail" accept=".jpg,.png,image/*"/> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputEmail" name="basket_desc" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Price</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="inputNumber" name="basket_price" placeholder="Price">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                      </div>
                  </div>
                  <hr/>
                       <div class="row">
                      <div class="col-md-3">
                        <h3>Add Cards</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('/admin/add_Card',array(
    'class' => 'form-horizontal'));  ?>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="cards_name" placeholder="Card name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSubject" class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                                <input type="file" name="cards_image" accept=".jpg,.png,image/*"/> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Select Category(You can select Multiple)</label>
                            <div class="col-lg-10">
                                <select multiple class="form-control" id="events_select" name="events_select[]">
                                 
                                  </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Price</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="inputNumber" name="events_price" placeholder="Cards Quantity">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                      </div>
                  </div>
                  <hr/>
                    <div class="row">
                      <div class="col-md-3">
                        <h3>Add Addons</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('/admin/add_Addon',array(
    'class' => 'form-horizontal'));  ?>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="addon_name" placeholder="Addon name">
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="event_image" class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                               <input type="file" name="addon_image" accept=".jpg,.png,image/*"/> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Price</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="addon_price" name="addon_price" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                              <textarea rows="5" class="form-control" id="addon_desc" name="addon_desc" placeholder="Description"></textarea>

                             
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Select Addon Category</label>
                            <div class="col-lg-10">
                                <select class="form-control" id="addon_cate" name="addon_cate">
                                 
                                  </select>
                            </div>
                        </div>
                          <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Select Addon Brand</label>
                            <div class="col-lg-10">
                                <select  class="form-control" id="addon_brand" name="addon_brand">
                                 
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                      </div>
                  </div>
                  <hr/>
                <div class="row">
                      <div class="col-md-3">
                        <h3>Add Addons Category</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('/admin/add_AddonCategory',array(
    'class' => 'form-horizontal'));  ?>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="addon_cate_name" placeholder="Category Name">
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                       
                    </form>
                      </div>
                  </div>
                  <hr/>
                             <div class="row">
                      <div class="col-md-3">
                        <h3>Add Addons Brands/Authors for books</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('/admin/add_AddonBrand',array(
    'class' => 'form-horizontal'));  ?>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="addon_brand_name" placeholder="Addon Brand name">
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                     
                    </form>
                      </div>
                  </div>
                  <hr/>
                   <div class="row">
                      <div class="col-md-3">
                        <h3>Add Hot deal</h3>
                      </div>
                       <div class="col-md-9">
                          <?php echo form_open_multipart('/admin/add_BasketsStore',array(
    'class' => 'form-horizontal'));  ?>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="basketstorename" placeholder="Hot deal Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Price</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="inputNumber" name="basketstore_price" placeholder="Price">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputNumber" class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                               <textarea rows="5" class="form-control" class="form-control" id="inputNumber" name="basketstore_desc" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Tags</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" name="basketstoretags" placeholder="Tags if any">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputSubject" class="col-lg-2 control-label">Images</label>
                            <div class="col-lg-10">
                                <input type="file" name="store_images[]" accept=".jpg,.png,image/*" multiple/> 
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
                                <button type="submit" class="btn btn-primary">Add Hot Deal</button>
                            </div>
                        </div>
                        
                     
                    </form>
                      </div>
                  </div>
                    </div>
