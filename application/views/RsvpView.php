<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/rsvpstyle.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>RSVP form</title>
	</head>
	<body>

		<div class="container">
			<?php if($data == "1"){ ?>
			<div class="row main text-center">
				<div class="main-login main-center">
				<h5>Your Response</h5>
					<form class="" method="post" action="<?php echo base_url();?>Rsvp/submitform">

						<div class="form-group">
						<label class="radio-inline">
     						 <input type="radio" value="will-attend" name="response">Will attend
    					</label>
   					 <label class="radio-inline">
      						<input type="radio" value="will-not" name="response"> Will not attend
    					</label>

    				</div>

    					<div id="will-attend" style="display:none;">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Full Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" required="required" name="name" id="name"  placeholder="Name"/>
								</div>
							</div>
						</div>
						<div class="form-group ">
							<label for="organization" class="cols-sm-2 control-label">Organization</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" required="required" name="organization" id="organization"  placeholder="Organization name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="cols-sm-2 control-label">Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="title" id="title"  placeholder="Your title"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="contact" class="cols-sm-2 control-label">Contact no.</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon">+92</i></span>
									<input type="tel" class="form-control"  name="contact" id="contact"  placeholder="Contact no."/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="vehicle" class="cols-sm-2 control-label">Vehicle # (For Security clearance )</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="text" class="form-control" required="required" name="vehicle" id="vehicle"  placeholder="Vehicle #"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<button id="button" type="submit" class="btn btn-primary btn-lg btn-block login-button">Submit</button>
						</div>

						</div>

						<div id="will-not" style="display:none;">
							<div class = "alert alert-info alert-dismissable">
   								No problem, we look forward to host you some other time.
								Also, give our web portal a fair try by ordering an emoey present for your loved ones :)
							</div>
						</div>
						
					</form>
				</div>
			</div>
			<?php }else { ?>

					<div class="alert alert-success positioning">
 					 <strong>Thanks, We are waiting to welcome you.</strong>
					</div>


			<?php } ?>

		</div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript">

		$( document ).ready(function() {


			$("input[name='response']").change(function(){
				$('#will-not').hide();
				$('#will-attend').hide();
   				 $('#'+$(this).val()).slideDown("slow");
				});
		});
		</script>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	</body>
</html>