<style>

@keyframes placeHolderShimmer{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}

.animated-background {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #e6e5e5 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 300px;
    position: relative;
}
.backgroundplaceholder{
  background-color: #fff;
  padding: 10px;
}
</style>
<div class="clearfix"></div>

<div class="tab _basketstoreheader" id="hotdealcate">
  <?php 
  $active = '';
  $firstcate = '';
  ?>

  <?php for($i=0; $i<count($categories);$i++) {
    if($i == 0)
      $firstcate = 'firsttabbasketstore';
    if($this->uri->segment(2) == $categories[$i]['eventurl'])
      $active = 'active';
    ?>
    <a href="<?php echo base_url().'hotdeals/'.$categories[$i]['eventurl'] ?>" class="tablinks <?php echo $active; ?> cateswitch <?php echo $firstcate; ?>" ><?php echo $categories[$i]['name'] ?></a>
 <?php
   $firstcate = '';
   $active = '';
  } ?>
</div>

<div class="container-fluid section2-bg viewport-size"  id="details">
  <div class="row">
  	<div class="col-sm-12 section2-content margin-top-basket-store" >			
<br>
<div class="container">
  <div class="flex-row row hide" id="hotdealslist">
<?php for($i=0; $i<count($deals);$i++) { ?>

 <div class="col-xs-6 col-sm-4 col-lg-3 custom-padding">
  <a style="text-decoration:none;" href="<?php echo base_url(); ?>hotdeal/<?php echo $deals[$i]['hotdealurl']?>">
    <div class="thumbnail">
        <img src="../assets/img/basket_store/<?php echo $deals[$i]['primaryimage']; ?>">
        <div class="caption">
          <h3 class="hotdealsnamespadding"><?php echo $deals[$i]['name']; ?></h3>
          <h5 class="hotdealsnamespadding">
          <?php if (!empty($deals[$i]['tags'])) { ?>
            <i class="fa fa-flag" aria-hidden="true"></i> <?php echo $deals[$i]['tags']; ?>
            <?php }?>
          </h5>
          <h2 class="hotdealsnamespadding">RS <?php echo $deals[$i]['price']; ?></h2>

          <p>
            <a class="btn btn-emoey block" href="<?php echo base_url(); ?>hotdeal/<?php echo $deals[$i]['hotdealurl']?>"><i class="fa fa-gift" aria-hidden="true"></i> Gift this </a>
          </p>
        </div>
    </div>
  </a>
  </div>
<?php } ?>
  </div>

  <div id="placeholderdiv" class="caption">
    <div class="flex-row row">
    <?php for($i=0; $i<count($deals);$i++) { ?>
      <div class="col-xs-6 col-sm-4 col-lg-3 customFlexRowPadding">
        <div class="thumbnail">
          <div class="animated-background"></div>
          <div class="caption">
            <h3>Loading...</h3>
          </div>
        </div>
      </div>
      <?php }?>
    </div>
  </div>


  <?php if(count($deals) == 0){ ?>
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <h1> Deals of this category are Launching Soon.. </h1>
  </div>
  <div class="col-md-2"></div>

  </div>

  <?php }?>
  <!-- /.flex-row  -->
</div>
<!-- /.container  -->

</div>
</div>
</div>

  <?php echo asset_js("basket_store.js"); ?>
  <script>
  $(window).on("load", function() {
    $('#hotdealslist').removeClass('hide');
    $('#placeholderdiv').addClass('hide');

     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-90389312-1', 'auto');
    ga('send', 'pageview');
    var userid  = '<?php echo $data['id'];?>';
    if(userid)
    {
       ga('set', 'userId', {userid}); // Set the user ID using signed-in user_id.
    }
    
  });
   
   

  </script>