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
    height: 201px;
    position: relative;
}
.backgroundplaceholder{
  background-color: #fff;
  padding: 10px;
}
</style>
<div class="clearfix"></div>
<div class="container-fluid section2-bg viewport-size"  id="details">
  <div class="row">
  	<div class="col-sm-12 section2-content margin-top-basket-store" >			
<br>
<div class="container">
  <div class="flex-row cate-row hide" id="categorieslist">
  <?php for($i=0; $i<count($categories);$i++) { ?>
  <div class="col-xs-10 col-sm-6  col-lg-4 margin-bottom-5px ">
    <a href="<?php echo base_url().'hotdeals/'.$categories[$i]['eventurl']?>" class="image_deals">
	      <img src="<?php echo base_url(); ?>assets/img/events_images/<?php echo $categories[$i]['image']; ?>" alt="">
  	</a>
  </div>
 <?php } ?>
  </div>

  <div id="placeholderdiv" class="caption">
    <div class="flex-row row">
    	 <?php for($i=0; $i<count($categories);$i++) { ?>
    	 	 <div class="col-xs-10 col-sm-6 col-lg-4 margin-bottom-5px">
          			<div class="animated-background"></div>
     		 </div>
    	 <?php }?>
    </div>

  </div>
  <!-- /.flex-row  -->
</div>
<!-- /.container  -->

</div>
</div>
</div>

<script>
$(window).on("load", function() {

$('#categorieslist').removeClass('hide');
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
