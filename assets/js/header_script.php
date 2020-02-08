		<?php
		if(!empty($_REQUEST['name']))
				{ ?>
					<div class="login"> <a href="<?php echo base_url();?>logout"> <?php echo $_REQUEST['name']; ?></a> <a href="./logout" >Logout</a>
					 </div>
				<?php } else { ?>
						<div class="login"> <a href="#" data-toggle="modal" data-target="#model-1">Login</a> <a href="#" data-toggle="modal" data-target="#model-2" data-dismiss="modal">sign up</a>
					 </div>
					 <?php } ?>