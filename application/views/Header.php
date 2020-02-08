<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript">
  		var baseurl = "<?php echo base_url(); ?>";
  		var facebookloginurl = "<?php echo $this->facebook->login_url(); ?>";
  		var token_name = "<?php echo $this->security->get_csrf_token_name(); ?>";
  		var csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
	</script>
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Emoey</title>

	<meta name="Description" content="Send Gifts to Pakistan, Send Gifts like Mugs, Cakes, Bags, Shoes and much more from Pakistan's most favourite gifting portal">

	<meta name="Keywords" content="send gifts to pakistan, send gifts in pakistan, sending Gifts Pakistan, cakes delivery in Pakistan, flowers delivery in Pakistan, Gifts to Pakistan, Online gift delivery, Gift delivery in Pakistan, Pakistani gift store, Online shopping in Pakistan, Shop online Pakistan, Online gift delivery Pakistan, sending Gifts to Pakistan, gifts to Pakistan, online gifts Pakistan, online gift delivery Pakistan, gifting service in Pakistan, flowers to Pakistan, Same day delivery in Pakistan, Gifts to Pakistan, Online gift shopping in Pakistan, Online gifts to Pakistan, Pakistan gift online, Pakistan gifts, Send birthday gifts to Pakistan, Send flowers to Pakistan, Send gift to Pakistan, Send gifts to Pakistan, Send gifts to Pakistan from USA, Send gifts to Pakistan from UK, Send gifts to Pakistan from Germany, Facebook Friends, Product issues">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<?php echo asset_css("bootstrap.min.css", false); ?>
	<?php echo asset_css("header.css", false); ?>
	<?php echo asset_css("index.css", false); ?>
	<?php echo asset_css("booking.css", false); ?>


	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>assets/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>assets/img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>assets/img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>assets/img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>assets/img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>assets/img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>assets/img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>assets/img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>assets/imgandroid-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>assets/img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/img/favicon-16x16.png">
	
	<link rel="shortcut icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/img/favicon.ico">
	<link rel="manifest" href="<?php echo base_url();?>assets/img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo base_url();?>assets/img/ms-icon-144x144.png">



	<!-- Crousal style sheets -->
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" media="all">
	 <script src="<?php echo base_url();?>assets/js/jquery-2.2.4.min.js"></script>   
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<meta name="theme-color" content="#14a3a7"/>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>
	<div id="spinner" 
	style="display:none;position:fixed;top:0px;right:0px;width:100%;height:100%; background-color:rgba(189, 206, 204, 0.498039);background-image:url('<?php echo base_url();?>/assets/img/spinner.gif'); background-repeat:no-repeat;background-position:center;z-index:10000000; ">
</div>

	<div class="container-fluid">
		<div class="row">
			<header id="headerheight">
				<div class="col-md-12 login-bar" id="loginBar">

			
					<div class="login">
						<div><span class="glyphicon glyphicon-earphone"></span> Call us at: +923127861300</div>
					 </div>
					</div>
				<div class="clearfix"></div>
			<div class="custom-navbar">
					<nav class="navbar navbar-default" role="navigation">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
						</div>
						<a class="navbar-brand" href="<?php echo base_url();?>">
						<img style="cursor: pointer;" src="<?php echo base_url();?>assets/img/emoey.png" width="117">
						</a>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-position font-size-medium" id="navbar-collapse-1">
							<ul class="nav navbar-nav navbar-left">
								<?php 
								$hotdealsclass = "";
								$customizedbasketclass = "";
								if($this->uri->segment(1) && $this->uri->segment(1)=="hotdeals") { 
									$hotdealsclass = "ispageactive";
								  }	else if($this->uri->segment(1) && $this->uri->segment(1)=="giftstore") {
								  	$customizedbasketclass= "ispageactive";
								  }
								?>
								<li><a class="underlined-link <?php echo $hotdealsclass; ?>" href="<?php echo base_url();?>hotdeals">Hot Deals</a></li>
								<li><a class="underlined-link <?php echo $customizedbasketclass; ?>" href="<?php echo base_url();?>giftstore" >Gift Store</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right" style="margin-right:0px;">
							<?php	if($data['name']) { ?>

								<li><a class="underlined-link" href="<?php echo base_url();?>account"><?php echo $data['name']; ?></a></li>
								<li><a class="underlined-link" href="<?php echo base_url();?>logout">Logout</a></li>
								<?php } else { ?>
								<li><a class="underlined-link" href="#"  data-toggle="modal" data-target="#model-facebook">Login</a></li>
								<li><a class="underlined-link" href="#"  data-toggle="modal" data-target="#model-2" data-dismiss="modal">Sign up</a></li>
								 <?php } ?>
							</ul>
						</div>
						<!-- /.navbar-collapse -->
					</nav>
				</div>

			</header>


		<div class="modal fade" id="model-facebook" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
					<div class="modalheadercustom">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row facebookbuttonoverallmargin">
							<div class="col-sm-3"></div>
							<div class="col-sm-6">
								<button type="button" onclick="login_with_facebook()" class="btn btn-block btn-social btn-facebook"> <i class="fa fa-facebook"></i>Login with Facebook</button>
								
								<small class="text-muted text-center"><em>We will not post without your permission</em></small>
							</div>
							<div class="col-sm-3"></div>
							</div>
							<div class="row footerlogin">
								<div class="col-sm-6 text-center">
									<a class="emoeylink sign-in-to-emoey" href="#" data-toggle="modal" data-target="#model-1">Sign in to emoey</a>
								</div>
								
								<div class="col-sm-6 verticalLine  text-center">
								<a class="emoeylink" href="#" data-toggle="modal" data-target="#model-2">Create Account</a>           
								 </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	
		<div class="modal fade" id="model-1" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
					<div class="modalheadercustom">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
							<div class="col-sm-3"></div>
								<div class="col-sm-6">
									<form>
										<div class="form-group">
											<input  type="email" class="form-control emoey-input" id="Username" name="Username" placeholder="Email"> </div>
										<div class="form-group">
											<input  type="password" class="form-control emoey-input" id="Password" name="Password" placeholder="Password"> </div>
										<button type="button" onclick="login()" class="btn btn-block btn-emoey">Sign In</button>
									</form>
									<div class="row done-btn">
											<div class="col-sm-4">
											</div>
											<div class="col-sm-8"> <a href="#" class="emoeylink" data-toggle="modal" data-target="#forgot-password-modal">Forgot your Password?</a> </div>
											
										</div>
								</div>
								<div class="col-sm-3"></div>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="forgot-password-modal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
					<div class="modalheadercustom">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
							<div class="col-sm-3"></div>
								<div class="col-sm-6">
									<h3>Forgot Password?</h3>
									<p>Kindly enter your login email below and we'll send you reset password link.</p>
										 <?php echo form_open('#',array(
    									'class' => '','id'=>'forgotpassword')); ?>
										<div class="form-group">
											<input  type="email" required title="Kindly enter your email of Emoey Account." class="form-control emoey-input" id="forgot-password-email" name="forgot-password-email" placeholder="Enter Email"> </div>
										<button type="submit" name="submit" class="btn btn-block btn-emoey">Reset Password</button>
									</form>
								</div>
								<div class="col-sm-3"></div>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="model-2" tabindex="-1">
			<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
				<div class="modalheadercustom">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
				<div class="modal-body ">
					<div class="container-fluid">
						<div class="row">
							<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-6">
								<button type="button" onclick="login_with_facebook()" class="btn btn-block btn-social btn-facebook"> <i class="fa fa-facebook"></i>Login with Facebook</button>
								
								<small class="text-muted text-center"><em>We will not post without your permission</em></small>
							</div>
							<div class="col-sm-3"></div>
						</div>
						<div class="col-sm-12 text-center"><h3> OR </h3></div>
						
						<hr/>
						 	 <?php echo form_open('#',array(
    									'class' => '','id'=>'signupform')); ?>
							<div class="col-sm-5">
							
								<div class="form-group">
									<input type="text" class="form-control emoey-input" name="firstname" placeholder="First Name" required> </div>
								<div class="form-group">
									<input  type="text" class="form-control emoey-input" name="lastname" placeholder="Last Name" required> </div>
								<div class="form-group">
									<input  type="email" class="form-control emoey-input" name="email" placeholder="Email Address" required> </div>
									<?php echo form_error('email');?>
									<div class="form-group">
									<input type="text" class="form-control emoey-input numeric" name="mobile" placeholder="Mobile No" required pattern='^\+?\d{10,16}' title="Invalid phone number.">
								
								</div>
								<?php echo form_submit(array('class'=>"btn btn-block btn-emoey",'value'=>'Register','id'=>'btn_registerUser','name'=>'submit'));?>
								
							</div>
							<div class="col-sm-2"></div>
							<div class="col-sm-5">
								<div class="form-group">
									<input  type="text" class="form-control emoey-input" name="address" placeholder="Address" required> </div>
								<div class="form-group">
									<input  type="text" class="form-control emoey-input" name="city" placeholder="City" required>  </div>
								

								<div class="form-group">
									<input  type="password" id="password" class="form-control emoey-input" title="6 to 20 characters" pattern=".{6,20}"name="password" placeholder="Create Password" required> </div>
									<?php echo form_error('Password');?>

								<div class="form-group" id="confirmpassword">
									<input  type="password" id="confirm_password" class="form-control emoey-input" title="6 to 20 characters" pattern=".{6,20}"name="confirm_password" placeholder="Confirm Password" required> </div>
									<?php echo form_error('Password');?>

								 
							</div>
							
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="signup-error" tabindex="-1">
			<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
				<div class="modalheadercustom">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
				<div class="modal-body ">
					<div class="container-fluid">
						<div class="row">
						<div class="alert alert-danger">
  							<strong>Error!</strong> <h3 id="signuperror_msg"></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="signup-success" tabindex="-1">
			<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
				<div class="modalheadercustom">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
				<div class="modal-body ">
					<div class="container-fluid">
						<div class="row">
						<div class="alert alert-success">
  								<strong>Successfully!</strong> <h3 id="signupsuccess_msg"></h3>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php echo asset_js("user.js"); ?>