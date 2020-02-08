

<script>
		$(document).ready(function () {
                    /* ---------------------------Animations------------------------------- */
                    $(".addon-section").hide(); 
                    $(".checkout-section").hide();
                 	$(".card-image").click(function () {     	
					$("#addons-cont-btn").slideUp("slow");
					});  
            
//                        $("#cardsize").show();   // basket type class e.g. either Basic or Premium
		
			$("#addons-cont-btn").click(function () {
				$(".addon-section").fadeOut("slow");
//				$(".addon-section").slideUp("slow");
			});
			$("#add-voice").click(function () {
				
				$("#add-message-area").slideUp("slow");
				$('#add-message-area').css('visibility','hidden');
				$("#add-voice-btn").slideDown("slow");
			});
			$("#audio-done").click(function () {
				$('#add-message-area').css('visibility','visible');
				$("#add-message-area").slideDown("slow");
				$("#add-voice-btn").hide();
				$("#add-voice").slideDown("slow");
			});
			
			$('#voiceUploaded').click(function(){

				$("#add-voice-btn").slideUp("slow");
				$("#add-voice").slideDown("slow");
				$('#add-message-area').css('visibility','visible');
				$("#add-message-area").slideDown("slow");
			});
			$('#receiverConfirmed').click(function(){

				$("#add-voice-btn").slideUp("slow");
				$("#add-voice").slideDown("slow");
				$('#add-message-area').css('visibility','visible');
				$("#add-message-area").slideDown("slow");
			});
			

                        
                        // form submissions

                        $(".eventSelected").click(function(){
                            $("#event_form").submit();
                        });

                        $(".basket_class").click(function(){
                            $("#basket_form").submit();
                        });

                        $(".card_class").click(function(){
                            $("#card_form").submit();
                        });

                        $(".addons_class").click(function(){
                            $("#addons_form").submit();
                        });
                        
                        // others
                        
                        $("#Basic").click(function(){
                            $(".Basic").css("color", "green");
                            $(".Basic").css("text-decoration", "underline");
                            $(".Premium").css("color", "grey");
                        });
                        $("#Premium").click(function(){
                            $(".Premium").css("color", "green");
                            $(".Premium").css("text-decoration", "underline");
                            $(".Basic").css("color", "grey");
                        });

			$("#add-voice").click(function () {
				$("#add-voice").hide();
				$("#add-voice-btn").show();
			});
			
			

			$('#browseBtn').change(function() {
				
			$('#filename').val($(this).val());
			});
		});

	</script>
	<style>
		table.tableSection {
        display: table;
        width: 100%;
    }
    table.tableSection thead, table.tableSection tbody {
        float: left;
        width: 100%;
    }
    table.tableSection tbody {
        overflow: auto;
        height: 150px;
    }
    table.tableSection tr {
        width: 100%;
        display: table;
        text-align: left;
    }
		
		.card-type-size {
			background-image: url("<?php echo base_url();?>assets/img/logo.png");
		}

		.booking-form{
			display: block;
		}
	</style>
		<style>
		
		.checkout-section .nav-tabs>li {
			color: #fff;
		}
		
		.checkout-section .nav-tabs>li.active>a {
			background-color: #3796c7;
		}
		
		.checkout-section .nav>li>a:focus,
		.nav>li>a:hover {
			background-color: rgba(55, 150, 199, 0.85);
		}
		
		.li-header {
			border: none !important;
			color: #fff !important;
		}
		
		.textbox {
			height: 50px;
			border: 2px solid #14a3a7;
		}
		
		.nav-border {
			border: none !important;
		}
		
		
		.tab-content {
			background-color: #e5e5e5;
			height: 400px;
		}
		
		/* The Overlay (background) */
.overlay {
    /* Height & width depends on how you want to reveal the overlay (see JS below) */    
    height: 100%;
    width: 0;
    position: fixed; /* Stay in place */
    z-index: 10000; /* Sit on top */
    left: 0;
    top: 0;
    background-color: rgba(255,255,255, 0.85); /* Black w/opacity */
    overflow-x: hidden; /* Disable horizontal scroll */
    transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
}

/* Position the content inside the overlay */
.overlay-content {
    position: relative;
    top: 25%; /* 25% from the top */
    width: 100%; /* 100% width */
    text-align: center; /* Centered text/links */
    margin-top: 30px; /* 30px top margin to avoid conflict with the close button on smaller screens */
}

/* The navigation links inside the overlay */
.overlay a {
    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: block; /* Display block instead of inline */
    transition: 0.3s; /* Transition effects on hover (color) */
}

/* When you mouse over the navigation links, change their color */
.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

/* Position the close button (top right corner) */
.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 30px;
    z-index: 10000;
}

.overlay .stopbtn {
    position: absolute;
    top: 20px;
    left: 47%;
    font-size: 40px;
    z-index: 10000;
    color:#de1919;
}

/* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
@media screen and (max-height: 450px) {
    .overlay a {font-size: 20px}
    .overlay .closebtn {
        font-size: 40px;
        top: 15px;
        right: 35px;
    }
    .overlay .stopbtn {
        font-size: 40px;
        top: 15px;
        right: 35px;
    }
}

.controls {
  position: fixed;
  text-align: center;
  top: 1em;
  width: 100%;
}

.button {
  color: #bbb;
  font-size: 4vw;
  margin: 0 0.5em;
  text-decoration: none;
}

.button:first-child {
    margin-left: 0;
}

.button:last-child {
    margin-right: 0;
}

.button:hover {
  color: white;
}

.stopwatch {
  font-size: 5vw;
  height: 100%;
  line-height: 0vh;
  text-align: center;
  color: #080808;
}

.results {
  border-color: lime;
  list-style: none;
  margin: 0;
  padding: 0;
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}



	</style>


			<div class="clearfix"></div>
				<div class="booking-form row">
					<div class="basket col-md-8 col-sm-8">
					<div class="col-sm-2 col-md-2"></div>
					<div class="col-sm-10 col-md-10">
						<div class="container-fluid">
							<div class="row">
							  <div class="row">
							  	 <ul class="pager">
    								<li class="previous" ><a id="btn_previous" class="btn btn-default" style="color: #14a3a7;" href="#"> ❮ Previous</a></li>
    								<li class="next"><a  id="btn_next" class="btn btn-default" style="color: #14a3a7;" href="#">Next ❯</a></li>
  							     </ul>
							  </div>


<!--								event section-->
								<div class="options_basket" id="basketdiv">
									<h3>Select Event <small>(so we can decorate the basket accordingly)</small></h3>
									<div style="width:100%; height:162px;  overflow: overlay; white-space: nowrap; font-size: 14px" class="flexcroll">
										<ul class="list-inline margin-bottom" id="eventslist">
								
                             			</ul>
                             		</div>
								</div>
							</div>
							<div class="clearfix"></div>
<!--							back type-->
							<div class="row">
								<div id="cardsize">
									<h3>Select Category <small>(Choose a gift basket or a gift box with magical packaging)</small> <small><strong id="basketinfo_mobile">Long click basket to view its details.</strong></small></h3>
									<div  style="width:100%; height:175px;  overflow: overlay; white-space: nowrap; font-size: 14px" class="flexcroll options">
									<ul class="list-inline" id="categorylist">
									
                             		</ul>
									</div>
								</div>
							</div>
<!--							add card section-->
							<div class="cardtype" id="test">
								<div class="row">
									
									
										<h3>Select Card</h3>
										<!-- <div class="col-sm-6">
											<div class="filter">
												<select class="form-control floatr" id="sel1">
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</div>
										</div> -->
									
									<div class="clearfix"></div>
									<div class="options_basket">
									<div class="flexcroll" style="width:100%; height:162px;  overflow: overlay; white-space: nowrap; font-size: 14px">
										<ul class="list-inline" id="cardslist">

                             			</ul>
                             			</div>
										
									</div>
									<div class="clearfix"></div>
									<div  class="done-btn">
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<button id="add-voice" type="button" class="btn fleft btn-card add-voice-btn hide">Add Voice</button>
											</div>

											<div class="col-md-6 col-sm-6 col-xs-6 audio_div add-voice-btn" style="display:none;">
												<lable id="audiofilename"></lable><span style="cursor:pointer;" class="glyphicon glyphicon-remove remove_audiofile"></span>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-3" >
			
											</div>
										 </div>
										<div id="add-voice-btn" class="">
										<form action="" method="post" id="uploadaudio_file">		
										<div class="row"> 
										
										<div class="col-md-3 fileUpload">
											<input id="filename" placeholder="File Name" style="margin-top:9px;" disabled="disabled" />
										</div>
										<div class="col-md-2 fileUpload">
											<div class=" btn  fleft btn-card add-voice-btn btn-margin">
    											<span>Browse</span>
   													 <input type="file" name="file_name" id="browseBtn" class="upload"  accept=".mp3,audio/*"/>
											</div>
										</div>
										<div class="col-md-2 col-sm-2">
										<button id="voiceUploaded" name="submit" type="submit" class="btn fleft btn-card add-voice-btn">
											Upload file</button>
										</div>


										</div>
										</form>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<p> <strong>Or</strong></p>
											</div>

										</div>

										<div class="row">
											<div class="col-md-2 col-sm-2">
												<button type="button" class="btn btn-card" data-toggle="modal" data-target="#recordermodal">
													  Record an audio message</button>
											</div>

										</div>
											
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-2"></div>
											<div class="col-md-2"></div>
											<div class="col-md-2"></div>
												<button id="audio-done" type="button" class="btn btn-card">
													  Done</button>
											</div>

										</div>
											

											
											<!-- <button type="button" class="btn  fleft btn-card add-voice-btn btn-margin">Browse</button> -->
										</div>
										<div class="clearfix"></div>
										<div id="add-message-area">
											<textarea class="form-control" id="greetings" rows="5" id="comment" placeholder="Enter your message"></textarea>
											<button id="addon-btn" type="button" class="btn   btn-card add-voice-btn done-btn">Done</button>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="row">
<!--								addon section-->
								<div class="addon-section">
									<div class="row">
										<div class="col-sm-4">
											<h3>Add ons</h3> 
											</div>

								<div class="col-sm-8 col-md-8 margin-top-temp">
									<div class="row">
									<label for="addonsel1" class="col-xs-6 col-sm-6 addoncategoryfilter">Choose Addons Category</label>	
										<div class="col-sm-6 col-xs-6">

											<select class="form-control floatr" id="addonsel1">
														
											</select>
										</div>	

											</div>
											
										</div>
									
									</div>
									<div class="clearfix"></div>
									<div class="optionscheckbox addon-product y-scroll">
									<ul class="list-inline" id="addonslist">

                             		</ul>	
									</div>
								</div>
							</div>
						</div>
					</div>
					
<!--					cart section-->
					<div id="scroll-div" class="col-sm-3 col-md-3 card-padding">
						<div class="container-fluid">
							<div class="row">
								<div class="pricing-container cart-shadow">
									<div class="pricing-img"></div>
									<div class="pricing-header "> <img class="cart-basket" src="<?php echo base_url();?>assets/img/cart.png">
									<div id="selectedbasket"> 
									<h3 class="heading-card">No Basket is selected</h3>
									<p> Total Price: 0</p>
									</div>
										
										
										<h5 id="basketcateselected" class="heading-card">No category selected</h5> 
										<p id="voiceuploadedselected"></p> 
										</div>
									<div class="product-pricing y-scroll">
										<div class="table-responsive">
										<div>
											<table class="table">
												<thead>
													<tr class="cart-color">
														<th class="cart-font-weight">Add ons</th>
														<th class="cart-font-weight">QTY</th>
														<th class="cart-font-weight">Price</th>
														<th class="cart-font-weight">Remove</th>
														
													</tr>
												</thead>
												<tbody id="addon_billing">
													
												</tbody>
											</table>
											 </div>
										</div>
									</div>
									<button id="checkout-btn"  class="cart-checkout-button btn btn-lg nohover  btn-card-disabled disabled">Check Out</button>
								</div>
							</div>
						</div>
					</div>
				</div>
	

<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="stopbtn" onclick="stoprecordingandsave()" <span> <i class="glyphicon glyphicon-stop"></i></span></a>
  
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">cancel</a>

  <!-- Overlay content -->
  <div class="overlay-content">
   <div id="recording_spinner" 
		style="top:0px;right:0px;width:100%;height:100%; background-image:url('<?php echo base_url();?>/assets/img/recorder.gif'); background-repeat:no-repeat;background-position:center;">
	</div>
	<div >
		<div class="stopwatch"></div>
		<ul class="results"></ul>
	</div>

  </div>

</div>

            <div id="recordermodal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">Message Recording</h4>
                  </div>
                 <section class="content">
                    <div class="row">
                    <div class="col-md-12">
                         <div class="box-body table-responsive" style="padding: 10px 15px;">
                           <div class="row">
                           	<div class="col-sm-2">
                           		<button id="startrecording" type="button" class="btn btn-card">
								<span class="glyphicon glyphicon-record"></span> Record</button>
                           	</div>
                           	  	<div class="col-sm-4">
                           		<audio id="recordedaudio" src="" controls=""></audio>
                           		</div>
                       		</div>
                         </div>
                         </div>
                         </div>
                  </section> 
                   <div class="modal-footer">
        <button type="button" class="btn btn-default" id="receiverConfirmed" >Upload</button>
      </div>
               </div>
             </div>
           </div>

           	<div class="modal fade" id="modelSignup" tabindex="-1">
			<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
						 
							<div class="col-sm-5">
							
								<div class="form-group">
									<input type="text" class="form-control" id="firstname_signup" name="firstname" placeholder="First Name"> </div>
								<div class="form-group">
									<input type="text" class="form-control" name="lastname" id="lastname_signup" placeholder="Last Name"> </div>

								<div class="form-group">
									<input type="email" class="form-control" name="email" id="email_signup" placeholder="Email Address"> </div>
									<?php echo form_error('email');?>
								<div class="form-group">
									<input type="password" class="form-control" id="password_signup" name="password" placeholder="Password"> </div>
									<?php echo form_error('Password');?>
							</div>
							<div class="col-sm-2"></div>
							<div class="col-sm-5">
								<div class="form-group">
									<input type="text" class="form-control" id="address_signup" name="address" placeholder="Address"> </div>
								<div class="form-group">
									<input type="text" class="form-control" id="city_signup" name="city" placeholder="City"> </div>
								<div class="form-group">
									<input type="text" class="form-control" id="number_signup" name="mobile" placeholder="Mobile No"> </div>
									<input type="button" name="submit" onclick="registerUserCheckout()" value="Register" class="btn btn-primary btn-flat">
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade vertical-alignment-helper" id="modelgetCalendar" tabindex="-1">
		<div class="modal-dialog vertical-align-center">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
				<div class="modal-header">
				
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Kindly give delivery Date.</h4>
					</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row" style="height:200px;">
						 
							<div class="col-sm-3">
							
								
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="text"  placeholder="Select here" class="form-control select-delivery-time" id="datepicker" readonly="readonly"> </div>
							</div>
							<div class="col-sm-3">
							
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

  <div class="modal fade" id="addonDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modalheadercustom">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   
                  </div>
                  <div class="modal-body">
                   <div class="col-md-5"> 
                       <span class='zoom addonImageZoom'> <img src="" id="modal_addon_image"  class="img-thumbnail"></span>  
                    </div>
                    <div class="col-md-7 ">
                     <h4 class="modal-title" id="myModalLabel"><i class="text-muted fa fa-shopping-cart"></i> <strong id="modal_addon_name"></strong></h4>
                     <h6 id="modal_addon_cname"></h6>

                     <hr>
                     <h5 id="modal_addon_desc"></h5>
                     <div class="price-box-modal">
                       <span class="regular-price" id="product-price-114">
                        <span class="price-modal" id="modal_addon_price"></span>
                        </span>
       					 </div>

                    </div>
                    <div class="clearfix"></div>
                    
                  </div>
              </div>
            </div>
            </div>

            <div class="boxFAQ loading" id="questionMarkId" style="display: none; border:1px solid #cecece;">
  					<img src="" id="showdetailimage" width="250" height="250"/>
			</div>

			<a href="#" class="float floatingbutton">
				<i id="floaticon" class="fa fa-shopping-cart my-float"></i>
			</a>

	<?php echo asset_js("servelet.js"); ?>
	<?php echo asset_js("recordmessage.js"); ?>
	<?php echo asset_js("recordmp3.js"); ?>

<script>
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