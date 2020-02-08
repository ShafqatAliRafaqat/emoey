<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Emoey</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">
  		var baseurl = "<?php echo base_url(); ?>";
  		var token_name = "<?php echo $this->security->get_csrf_token_name(); ?>";
  		var csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
	</script>
	<!-- Bootstrap -->
	
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/header.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/index.css" rel="stylesheet">
	
	<link href="<?php echo base_url();?>assets/css/addonscheckbox.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

	 <script src="<?php echo base_url();?>assets/js/jquery-2.2.4.min.js"></script>   
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		@import 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<header>
			<div class="col-md-12 login-bar">
					
				</div>
				<div class="clearfix"></div>
			<div class="custom-navbar">
					<nav class="navbar navbar-default" role="navigation">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
						</div>
						<a class="navbar-brand" href="<?php echo base_url();?>index.php/admin/adminPanel"><img src="<?php echo base_url();?>assets/img/emoey.png" width="100"></a>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-position" id="navbar-collapse-1">
							<ul class="nav navbar-nav navbar-left">
								<li><a href="../Admin_p/Vieworders">Customized orders</a></li>
								<li><a href="../Admin_p/ViewBasketStoreOrders">Basket Store orders</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="<?php echo base_url(); ?>Admin_p/EditDeleteProducts">Edit/Delete Products</a></li>
								<li><a href="<?php echo base_url(); ?>admin/logout">Logout</a></li>
							</ul>
						</div>
						<!-- /.navbar-collapse -->
					</nav>
				</div>

			</header>