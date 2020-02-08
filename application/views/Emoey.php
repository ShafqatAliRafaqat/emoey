
			<!--			content area start-->
	<!-- 	<div class="container-fluid section1-bg view-port-height" id="maindivhight">

				<div class="row heading-row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10 text-center heading">
						<h2>Gift your loved ones<br> what they wish for.</h2>
						<br>
						<h3>Experience Emoey!</h3>
						<a id="sendbasket" href="<?php echo base_url();?>customizedbasket" class="btn btn-customize">CUSTOMIZE BASKET</a>
						<a href="<?php echo base_url();?>basketstore" class="btn-store-b btn-store basketstore">Mother's Day Deals</a>
					</div>
					<div class="col-sm-1"></div>
				</div>
					<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10 text-center heading">
						
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div> -->
<div id="top"></div>
<div id="banner-bg">
    <div id="banner">
      <div class="large-12 columns">
        <div class="hero">

        <div class="heading-row" id="contentdiv">
					
					<div class="col-sm-12 text-center heading">
						<div id="headingsdiv">
						<h2 class="mainheading">Gift your loved ones<br> what they wish for.</h2>
						<br>
						<h3 class="subheading">Experience Emoey!</h3>
						</div>
						<div class="row">
						<a id="sendbasket" href="<?php echo base_url();?>customizedbasket" class="btn btn-customize">CUSTOMIZE BASKET</a>
						<a href="<?php echo base_url();?>hotdeals" class="btn-store-b btn-store basketstore">Hot Deals</a>
						</div>
					</div>
					
		</div>
          <span id="cafe" role="img" aria-label="Coffee and croissant."><span class="inner"></span></span>
         </div>
      </div>
    </div>
  </div>

			<div class="container-fluid section2-bg viewport-size2"  id="details">
				<div class="row">
					<div class="col-sm-12 section2-content" >


						<div class="row margin-top-baskets-store" id="aboutUs">
							<div class="col-sm-2"></div>
							<div class="col-sm-8 whatisEmoey" >
								<h3 class="heading2mainpagecolor">What is Emoey?</h3>
								<p>Exchanging gifts has been an age old tradition, one that has been kept alive with zeal and zest.
Exchanging gifts is a sign of love. And in these modern times, we at Emoey, have revolutionized
the art of giving gifts to the ones you love, to tell them that they’re forever in your hearts. Emoey
is a blend of science with care, love and affection, and that is what makes it unique.
Through Emoey’s web portal, users can send out customized and personalized gift items to
their loved ones, in a manner that is both time-efficient, and cost effective, and one that puts a
big smile on someone’s face.
Users can record a message online, which can be sent in the form of a talking greeting card
alongwith the gift, making it more intimate.</p>
							</div>
							<div class="col-sm-2"></div>
						</div>
						<div class="clearfix"> </div>
						<div class="row margin-top-baskets-store">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<div class="row">
										<div class="col-sm-4 ">
								<div class=""> <img class="product-img" src="<?php echo base_url();?>assets/img/card.png" alt="...">
									<div class="caption">
										<h3>Talking cards </h3> </div>
								</div>
							</div>
							<div class="col-sm-4 ">
								<div class=""> <img class="product-img" src="<?php echo base_url();?>assets/img/gift.png" alt="...">
									<div class="caption">
										<h3>coorporate giveaways </h3> </div>
								</div>
							</div>
							<div class="col-sm-4 ">
								<div class=""> <img class="product-img" src="<?php echo base_url();?>assets/img/basket.png" alt="...">
									<div class="caption">
										<h3>emoey baskets </h3> </div>
								</div>
							</div>
								</div>
							</div>
						
							<div class="col-md-3"></div>
						</div>
						
						<!-- Sponsered Brands -->

					<div class="row margin-top-baskets-store" id="ourPartners">
						<div class="col-md-12 text-center">
						<h3 class="heading2mainpagecolor"> OUR PARTNERS</h3>
						 </div>
						 </div>

							<div class="row">
							
							<div class="col-sm-2 ">
									
							</div>
								<div class="col-sm-2 margin-wedding">
									<div class=""> <img class="product-img" src="<?php echo base_url();?>assets/img/babyplanet.png" alt="Baby Planet">
										
									</div>
								</div>
								<div class="col-sm-2 margin-wedding">
									<div class=""> <img class="product-img" src="<?php echo base_url();?>assets/img/womanlywow.gif" alt="WomanlyWow">
										
									</div>
								</div>
								
								<div class="col-sm-2 margin-wedding">
									<div class=""> <img class="product-img" src="<?php echo base_url();?>assets/img/MedEnggNew.png" alt="Med Engg">
									</div>
								</div>
								<div class="col-sm-2 margin-wedding">
									<div class=""> <img class="product-img" src="<?php echo base_url();?>assets/img/unze.png" alt="Med Engg">
									</div>
								</div>
								
								<div class="col-sm-2 "></div>
							</div>



					</div>
				</div>
			</div>
			<!--			content area end-->
		

<script>
$(document).ready(function() {
    $(window).resize(function() {
    	var height = $('#headerheight').height();
    	$('#top').css("padding-top", height);

    	var hbanner = $('#banner-bg').height();
    	var margintop = hbanner/6.2;
    	$('#contentdiv').css('margin-top',margintop);
    }).resize();
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
 

</script>