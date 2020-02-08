<div class="checkout-section" id="checkout-section">
		<div class="container">
		<a id="btn_edit_Order" class="btn btn-default btn-edit" href="<?php echo base_url(); ?>SendBasket"> ❮ Edit Your order</a>
			<ul class="nav nav-tabs nav-justified nav-border checkoutul">
				<li class="active nav-border disabled"><a class="li-header" data-toggle="" href="#tab1">1. Sign In</a></li>
				<li class="disabled"><a class="li-header" id="receiver" data-toggle="" href="#tabreceiver">2. Receiver</a></li>
				<li class="disabled"><a class="li-header" data-toggle="" href="#tab3">3. Invoice</a></li>
				<li class="disabled"><a class="li-header" data-toggle="" href="#tab4">4. Let the swan fly</a></li>
			</ul>
			<div class="tab-content">
				<div id="tab1" class="tab-pane fade in active">
				<div class="row checkout-login-padding">
				<div class="col-sm-1"> </div>
					<div class="col-sm-5">
					<div class="row checkoutsign">
					<div class="col-sm-10">
						<div class="form-group">
							<input type="email" class="form-control textbox checkout-input emoey-input" id="email_" placeholder="Email"> 
						</div>
						<div class="form-group">
						<input type="password" class="form-control textbox checkout-input emoey-input" id="password_" placeholder="Password"> </div>
						<button type="button" class="btn btn-emoey btn-block" onclick="login_checkout()">Sign In</button>
					</div>
						
					</div>
					</div>
					<div class="col-sm-1 vertical-line-checkout"></div>
					
					<div class="col-sm-5 text-center checkout-register-padding">
					<div class="row">
					<div class="col-xs-1 col-sm-2"></div>
						<div class="col-xs-10 col-sm-8">
							<button type="button" onclick="login_with_facebook()" class="btn btn-block btn-social btn-facebook"> <i class="fa fa-facebook"></i>Login with Facebook</button>
								
								<em class="text-muted text-center">We will not post without your permission</em>
						</div>
					<div class="col-xs-1 col-sm-2"></div>
					</div>
					
						<h4 class="italic-font">OR</h4>

						<div class="row">
							<div class="col-sm-2 col-xs-1"></div>
								<div class="col-sm-8 col-xs-10">
									<button type="button" class="btn btn-emoey btn-block" data-toggle="modal" data-target="#model-2" data-dismiss="modal">Register here</button>
								</div>
							<div class="col-sm-2 col-xs-1"></div>
						</div>
						
					 </div>
					 </div>
				</div>
				<div id="tabreceiver" class="tab-pane fade" style="padding: 10px">
					<div class="add-contacts text-center">
					<button type="button" onclick="fetchcontacts()" class="btn addtocontacts"><span class="glyphicon glyphicon-user"></span>  Add from contacts</button>
					</div>
					<div class="text-center padding-top-25"> 
					<h4 class="italic-font">Provide info of your loved one, to whom you want to send the gift</h4>
					<div class="clearfix padding-top-25"></div>
					<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
							<div class="form-group">
								<input type="text" class="form-control textbox" id="reName" placeholder="Name"> </div>
						<div class="form-group">
							<input type="text" class="form-control textbox" id="rePhoneNumber" placeholder="Contact Number"> </div>
			
					</div>
						
					
					<div class="col-sm-5">
						
							<div class="form-group">
								<input type="text" class="form-control textbox" id="reFullAddress" placeholder="Address"> </div>
						
						<div class="form-group">
							<input type="text" class="form-control textbox" id="reCity" placeholder="City"> </div>
					</div>
					</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4"><div class="text-center">
						<button type="button" class="btn signin-button" onclick="savereceiver()">submit</button>
					</div></div>
					<div class="col-sm-4"></div>
					</div>
					
				</div>
				<div id="tab3" class="tab-pane fade">
				<div class="row padding-20" >
				<div class="col-sm-10"></div>
				<div class="col-sm-2" ><button type="button" id="btnAllSet" class="btn btn-info">Continue ❯</button></div>
				</div>
				<div class="row">
					
					<div class="col-sm-12 checkout-table-padding">
						<div class="table-responsive">
						<table class="table tableSection">
								<thead>
							    <tr>
							      <th>Basket</th>
							      
							      <th id="addons_text">Addons</th>
							      <th>Price</th>
							    </tr>
							  </thead>
								<tbody id="checkoutInvoice">

								</tbody>
								<tbody id="subtotal-checkout">
								<tr>
								<td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Subtotal</td>
								<td id="checkoutAddonsTotal" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0"></td>
								</tr>
								<tr>
								<td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Voice Message</td>
								<td id="checkoutVoiceMessage" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0"></td>
								</tr>
								<tr>
								<td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Category</td>
								<td  id="basketCategoryPrice" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">20</td>
								</tr>
								
								<tr>
								<td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Shipping & Handling</td>
								<td align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">0</td>
								</tr>
								<tr>
								<td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0"><b>Grand Total</b></td>
								<td id="grandTotal" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">0</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-sm-1">
					</div>
					</div>
					
				</div>
				<div id="tab4" class="tab-pane fade">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4 id="checkout_details_dummy" class="orderid-details"></h4>
					</div>
					<div class="col-sm-3"></div>
				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Kindly, Select one of the payment mode.</h4>	
						<form id="paymentmethodsform">
							<div class="block">
						<input type="radio" name="radgroup" value="1">

							<a href="#" class="payment-button payment-methods" data-toggle="collapse" data-target="#easypay">
							  		 <span class="glyphicon glyphicon-info-sign margins-payment-method"></span>
							  		Easypay</a>
							  <div id="easypay" class="row">
							   <p class="margin-left-38"> CNIC # 38403-3492818-7, Mobile # 03127861300 </p>
							  </div>
							  </div>

							  <div class="block">
						<input type="radio" name="radgroup" value="2">
						<a href="#"  class="payment-button payment-methods" data-toggle="collapse" data-target="#wire">
							  			 <span class="glyphicon glyphicon-info-sign margins-payment-method"></span>
							  			Wire Transfer</a>
							  <div id="wire" class=" row">
							  	
							 <p class="margin-left-38">  Bank Islami, Acc. # 202000653070001, Acc. Title Muhammad Bilal Javed </p>
							  </div>
							</div>
							<div class="block">
								<input  type="radio" name="radgroup" value="3">
								<a href="#" class="payment-methods" data-toggle="collapse" data-target="#cash">
							  			 <span class="glyphicon glyphicon-info-sign margins-payment-method"></span>
							  			COD</a>
							  <div id="cash" class=" row">
							   <p class="margin-left-38"> Cash on delivery - If you want to give the gift personally. </p>
							  </div>
							</div>

						</form>
					</div>
					<div class="col-sm-3"></div>

				</div>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3">
						<button type="button" id="btnlettheswanfly" class="btn btn-info">Let the swan fly</button>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

		<div class="clearfix"></div>
	
	      <div id="receivermodal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">Choose Receiver</h4>
                  </div>
                 <section class="content">
                    <div class="row">
                    <div class="col-md-12">
                         <div class="box-body table-responsive" style="padding: 10px 15px;">
                            <form id="genericuserslist" >
                            	
                            </form>
                         </div>
                         </div>
                         </div>
                  </section> 
                   <div class="modal-footer">
        <button type="button" class="btn btn-default" id="receiverConfirmed" >Choose</button>
      </div>
               </div>
             </div>
           </div>

                <div id="ordersuccessmodal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">Order sent</h4>
                  </div>
                 <section class="content">
                    <div class="row">
                    <div class="col-md-12">
                         <div class="box-body table-responsive" style="padding: 10px 15px;">
                            <form id="" >
                            	<h4 id="checkout_details" class="orderid-details"></h4>
                            </form>
                         </div>
                         </div>
                         </div>
                  </section> 
                   <div class="modal-footer">
        	<a href="<?php echo base_url(); ?>" class="btn btn-emoey" id="" >Continue Sending gifts..</a>
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


	<div class="modal fade" id="model-facebook-user-info" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
				<div class="modalheadercustom">
					
					</div>
				<div class="modal-body ">
					<div class="container-fluid">
						<div class="row text-center">
							<h3>Kindly give us your Information</h3>
							<small class="text-muted text-center"><em>It would be only first time</em></small>
						</div>
						<div class="row top-buffer">
							<div class="col-sm-5">
							<div class="form-group">
									<input  type="text" class="form-control emoey-input" id="address_sender" placeholder="Your Address"> </div>
								<div class="form-group">
									<input  type="text" class="form-control emoey-input" id="city_sender" placeholder="Your City"> </div>	
							</div>
							<div class="col-sm-2"></div>
							<div class="col-sm-5">
								<div class="form-group">
									<input type="text" class="form-control emoey-input" id="mobile_sender" placeholder="Your Mobile No"> </div>
								 <button class="btn btn-block btn-emoey" onclick="saveuserContactinfo()"  type="button">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo asset_js("checkout.js"); ?>

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