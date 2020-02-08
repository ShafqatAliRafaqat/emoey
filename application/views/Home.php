
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

<div id="top"></div>


<div class="row row_margin-0" style="background-color:#ebe7e4; display: none;" id="homepage_maincontent">
<div class="row row_margin-0">
	<div class="padding-0 custom-col-4">
		<img class="img_size" src="./assets/img/homepage_gift.jpg"/>
	</div>
	<div class="padding-0 custom-col-2">
		<img class="img_size" src="./assets/img/homepage_ramzan.jpg"/>
	</div>
	<div class="padding-0 custom-col-3">
		<img class="img_size" src="./assets/img/homepage_world.jpg"/>
		<a href="giftstore" class="btn btn-emoey">GIFT STORE</a>
	</div>

</div>
<div class="row row_margin-0">
	<div class="padding-0 custom-col-4">
		<img class="img_size" src="./assets/img/homepage_caution.png"/>
		<a href="hotdeals" class="btn btn-emoey">HOT DEALS</a>
	</div>
	<div class="padding-0 custom-col-2">
		<img class="img_size" src="./assets/img/homepage_father.jpg"/>
	</div>
	<div class="padding-0 custom-col-3">
		<img class="img_size" src="./assets/img/homepage_dad.jpg"/>
	</div>

</div>

<div class="row row_margin-0">
	<div class="padding-0 col-md-4">
	<a href="hotdeals/for_him" class="image_deals">
		<img class="img_size" src="./assets/img/for_him.jpg"/>
	</a>
	</div>
	<div class="padding-0 col-md-4">
	<a href="hotdeals/for_her" class="image_deals">
		<img class="img_size" src="./assets/img/for_her.jpg"/>
	</a>
	</div>
	<div class="padding-0 col-md-4">
	
		<img class="img_size" src="./assets/img/gift_love.jpg"/>
	
	</div>
</div>
<div class="row row_margin-0">
	<div class="padding-0 col-md-4">
	<a href="hotdeals/fathers_day" class="image_deals">
		<img class="img_size" src="./assets/img/fathers_day.jpg"/>
	</a>
	</div>
	<div class="padding-0 col-md-4">
	<a href="hotdeals/ramadan" class="image_deals">
		<img class="img_size" src="./assets/img/ramzan.jpg"/>
	</a>
	</div>
	<div class="padding-0 col-md-4">
	<a href="hotdeals/eid" class="image_deals">
		<img class="img_size" src="./assets/img/eid.jpg"/>
	</a>
	</div>
</div>
<div class="row row_margin-0">
	<div class="padding-0 col-md-4">
	<a href="hotdeals/gift_baskets" class="image_deals">
		<img class="img_size" src="./assets/img/gift_baskets.jpg"/>
	</a>
	</div>
	<div class="padding-0 col-md-4">
		<img class="img_size" src="./assets/img/schedule.jpg"/>
	</div>
	<div class="padding-0 col-md-4">
	<a href="hotdeals/birthday" class="image_deals">
		
		<img class="img_size" src="./assets/img/birthday.jpg"/>
	</a>
	</div>
</div>
<div class="row row_margin-0">
	<img class="img_size" src="./assets/img/app_coming_soon.jpg"/>
</div>
</div>

  <div id="placeholderdiv" class="caption" style="margin-left: 2.5%;">
    <div class="flex-row row">
    	 <?php for($i=0; $i<12;$i++) { ?>
    	 	 <div class="col-xs-10 col-sm-6 col-lg-4 margin-bottom-5px">
          			<div class="animated-background"></div>
     		 </div>
    	 <?php }?>
    </div>

  </div>



<script>

$(window).on("load", function() {
	 var height = $('#headerheight').height();
    	$('#top').css("padding-top", height);

     $('#placeholderdiv').fadeOut(function() {
             $('#homepage_maincontent').fadeIn();
         });


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