                         
<div class="container-fluid margin-top-12">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6 text-center">
             <h1>Dream Basket Admin</h1>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <div class="row">
            <div class="col-md-6">

                <h2>Customized Orders</h2>
                <div class="card padding-10px">
                    <h4>Pending Orders Count: <span id="customorderscount">0</span></h4>
                    <a class="btn btn-block btn-emoey" href="<?php echo base_url(); ?>dreamBasketAdmin/customizedorders">View Customize Orders</a>
                </div>
              

            </div>

             <div class="col-md-6">

                 <h2>Basket Store Orders</h2>
                <div class="card padding-10px">
                     <h4>Pending Orders Count: <span id="basketstoreorderscount">0</span></h4>
                     <a class="btn btn-block btn-emoey" href="<?php echo base_url(); ?>dreamBasketAdmin/basketstoreorders">View Basket Store Orders</a>
                </div>
                <!--/.Card-->

            </div>
        </div>
</div>

<?php echo asset_js("orders.js"); ?>

<script type="text/javascript">
$( document ).ready(function() {
fetchOrdersCount();
  setInterval(fetchOrdersCount, 5000);
});
</script>

