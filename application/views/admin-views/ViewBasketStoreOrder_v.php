

 <div id="spinner" 
    style="display:none;position:fixed;top:0px;right:0px;width:100%;height:100%; background-color:rgba(189, 206, 204, 0.498039);background-image:url('<?php echo base_url();?>/assets/img/spinner.gif'); background-repeat:no-repeat;background-position:center;z-index:10000000; ">
</div>
  <div class="container" style="margin-top:120px">
  <div class="row">
  <div class="col-md-3">
    <h3>Basket Store Orders</h3>
  </div>
<div class="col-md-6"></div>
  <div class="col-md-3">
    <button class="btn btn-info" onclick="fetchBasketStoreOrders()">Refresh</button>
  </div>
  </div>
   <div class="row">
    <div class="col-md-3">
      <ul class="nav nav-pills nav-stacked">
        <li class="active eventClicked" id="pending"><a href="#">Pending Orders</a></li>
        <li class="eventClicked" id="processed"><a href="#">Processed Orders</a></li>
      </ul>
    </div>
<div class="col-md-7">
<table class="table table-hover table-inverse table-bordered">
  <thead>
    <tr>
      <th>CustomerID</th>
       <th>Payment Method</th>
       <th>Name</th>
      <th>Change Status</th>
      <th>Receiver Name</th>
      <th>Receiver Address</th>
      <th>Receiver number</th>
      <th>User Name</th>
      <th>User number</th>
      <th>User Email</th>
     
      <th>Delivery Date</th>
       <th>Order Date</th>
      
    </tr>
  </thead>
  <tbody id="basketstoreordersbody">
  </tbody>
</table>
</div>
</div>
</div>


<?php echo asset_js("orders.js"); ?>
<script type="text/javascript">
$( document ).ready(function() {
  fetchBasketStoreOrders();

    $('.eventClicked').click(function(){
      
      $('.eventClicked').each(function(index){
        $(this).removeClass('active');
      });
      
      $('#basketstoreordersbody').html('');
      if(this.id=='pending')
      {
        fetchBasketStoreOrders();

      }
      else if(this.id=='processed')
      {
        fetchBasketStoreOrders_Processed();
      }
      $(this).addClass('active');
     });
});

</script>