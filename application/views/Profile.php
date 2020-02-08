			<style>
		.profile
		{
			height: 114vh;
			margin-top: 150px;
		}
		.profile-section{
			padding-top: 15px;
			background-color: #f2f2f2;
			border-radius: 10px;
			text-align: center;
			padding-bottom: 15px;
			height: 70vh;
		}
		.profile-section img{
			border-radius: 100px;

		}
		.profile-section-table{
			overflow-y: scroll;
			overflow-x: hidden;
			padding-top: 15px;
			background-color: #f2f2f2;
			border-radius: 10px;
			
			padding-bottom: 15px;
		}
		.profile-section-table h3{
			text-align: center;
		}
		.profile-section-table-td{
			border-right: 1px solid #c3c3c3;
		}
		.edit-profile, .edit-profile:hover, .edit-profile:focus{
			    color: #337ab7;
			    font-size: small;
		}

	</style> 
	<script type="text/javascript">
		var facebookconnecturl = "<?php echo $this->facebook->connect_url(); ?>";
	</script>

			<div class="container-fluid profile">
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<div class="col-sm-3">
							<div class="profile-section">
								<?php  if($data[0]['fbID']) { ?>
								<img src="<?php echo $data[0]['profile_pic']?>" alt="profile pic" width=150 height=150>
								<?php } else {?>
								<img src="<?php echo base_url();?>assets/img/profile_image/<?php echo $data[0]['profile_pic']?>" alt="profile pic" width=150 height=150>
								<?php }?>
								<h3><?php echo $data[0]['firstname']." ".$data[0]['lastname']; ?></h3>
								<h4>Contact</h4>
								<p><?php echo $data[0]['phone_number']; ?></p>
								<h4>Address</h4>
								<p><?php echo $data[0]['address']." ".$data[0]['city'] ?></p>
								<?php if($data[3]) { ?>
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<button type="button" onclick="connect_with_facebook()" class="btn btn-block btn-social btn-facebook"> <i class="fa fa-facebook"></i>Connect with Facebook</button>
									</div>
									<div class="col-md-1"></div>
								</div>
								<?php } ?>
								</br>
								<div class="row" >
									<div class="col-md-12 text-center">
										<a href="#" style="display:none" data-toggle="modal" data-target="#model-edit-profile" data-dismiss="modal" class="edit-profile"> Edit your contact and basic info</a>
									</div>
								</div>
								
								
							</div>

						</div>
						<div class="col-sm-1"></div>
						<div class="col-sm-8">
						<h3 class="text-center">Order History</h3><hr>
							<div class="table-responsive profileorderstable y-scroll">
								
								<?php if(!$data[1]){?>
										<div class="row">
										<h4 class="text-center"> No Orders Yet!</h4>
										</div>
										
									<?php 
										}  else{?>
										<div class="">
								<table class="table">
									<thead>
										<tr>
											<th>Order id</th>
											<th>Send To</th>
											<th>Date</th>
											<th>Order Status</th>
										</tr>
									</thead>
									<tbody id="orders_table_user">
									
										
									</tbody>
								</table>
								</div>
								<?php }?>
							</div>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		
	<div class="clearfix"></div>

	





<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="model-edit-profile" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit profile
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form">
                	<div class="row">
                		<div class="col-sm-6">
                			 <div class="form-group">
                    		<label for="user_firstname">First name</label>
                    	  <input type="text" class="form-control"
                     			 id="user_firstname" placeholder="Enter firstname"
                     			 value="<?php echo $data[0]['firstname']; ?>"
                     			 />
                 			 </div>
                 		
                   <div class="form-group">
                    <label for="user_contact">Contact No.</label>
                      <input type="tel" class="form-control"
                      id="user_contact" placeholder="Enter contact no."
                       value="<?php echo $data[0]['phone_number']; ?>"
                      />
                  </div>

                   <div class="form-group">
                   			 <label for="user_city">City</label>
                     	 <input type="text" class="form-control"
                          id="user_city" placeholder="Enter City"
                           value="<?php echo $data[0]['city']; ?>"
                          />
                		  </div>

                  
                		</div>
                		<div class="col-sm-6">

                				  <div class="form-group">
                    		<label for="user_lastname">Last name</label>
                    	  <input type="text" class="form-control"
                     			 id="user_lastname" placeholder="Enter lastname"
                     			  value="<?php echo $data[0]['lastname']; ?>"
                     			 />
                 			 </div>

                 			  <div class="form-group">
                   			 <label for="user_address">Address</label>
                     	 <input type="text" class="form-control"
                          id="user_address" placeholder="Enter Address"
                           value="<?php echo $data[0]['address']; ?>"
                          />
                		  </div>
                			
                		  
                		 
                		</div>
                	</div>
                </form>
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button id="save-edit-profile" type="button" class="btn btn-emoey">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

	<script type="text/javascript">
	$( document ).ready(function() {

		$('#save-edit-profile').click(function(){
	var firstname = $('#user_firstname').val();
	var lastname = $('#user_lastname').val();

	var phonenumber = $('#user_contact').val();
	var address = $('#user_address').val();
	var city = $('#user_city').val();
	if(!firstname)
	{
		alert('Enter First name');
		return;
	}
	if(!lastname)
	{
		alert('Enter Last name');
		return;
	}
	if(!phonenumber)
	{
		alert('Enter Phone number');
		return;
	}
	if(!address)
	{

	alert('Enter Full address');
		return;
	}
	if(!city)
	{
		alert('Enter City');
		return;
	}
	$('#model-edit-profile').modal('hide');

	$('#spinner').show();
	var data_ = {firstname: firstname,lastname:lastname,number:phonenumber,address:address,city:city};
	data_[Object.keys(token_)[0]] = Object.values(token_)[0];

 $.ajax({
		type: "post",
		url: baseurl+"UserController/updateuserprofile",
		cache: false,
		data:data_,
		success: function(json){						
		try{
			
			var result = jQuery.parseJSON(json);
			if(result==1)
			{
				location.reload();
			}else{
				alert('Cannot Update changes.');
				location.reload();
			}
			
		}
		catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(xhr, ajaxOptions, thrownError){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});

		});


		var $table = $('table'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Get the tbody columns width array
colWidth = $bodyCells.map(function() {
    return $(this).width();
}).get();

// Set the width of thead columns
$table.find('thead tr').children().each(function(i, v) {
    $(v).width(colWidth[i]);
});
var token_ = {};
token_[token_name] = csrf_hash;
	$('#spinner').show();
 $.ajax({
		type: "post",
		url: baseurl+"UserController/fetchorders",
		cache: false,
		data:token_,
		success: function(json){						
		try{
			$('#spinner').hide();
			var obj = jQuery.parseJSON(json);
			obj.forEach(function(item,index)
			{
				$('#orders_table_user').append('<tr>\
					<td>'+item.customerorderid+'</td>\
					<td>'+item.firstname+'</td>\
					<td>'+item.date+'</td>\
					<td>'+item.status+'</td>\
					</tr>');
			});
		}catch(e) {		
			$('#spinner').hide();
			console.log(e);
			alert('Exception while request..');
		}		
		},
		error: function(){	
		$('#spinner').hide();					
			alert('Error while request..');
		}

});

 	$( ".profile-section" ).on({
		mouseenter: function() {
			$('.edit-profile').show();
    	
	  }, mouseleave: function() {
	  	$('.edit-profile').hide();
	   
	  }
	});



	});



	</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90389312-1', 'auto');
  ga('send', 'pageview');
  var userid  = '<?php echo $data[2];?>';
  if(userid)
  {
  	 ga('set', 'userId', {userid}); // Set the user ID using signed-in user_id.
  }
 

</script>