			<div class="footer">
				
			<div class="container-fluid section3-bg">
				<div class="row contactus">
					<div class="col-sm-3"> </div>
					<div class="col-sm-6 whatisEmoey">
					
					<?php echo form_open('ContactUs/submitcontactform'); ?>
						<div class="contact">
							<h3 class="footer-color">WANT TO CONTACT US?</h3>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<input type="text" class="form-control" name="contact_name" placeholder="Your name" required> </div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<input type="email" class="form-control" name="contact_email" placeholder="Your email" required> </div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<textarea class="form-control" rows="col-sm-3"  name="contact_message" placeholder="Your message" required></textarea>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<button type="submit" class="btn btn-default bt">send</button>
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
				<div class="container-fluid">
					<div>
						<div class="col-sm-1"></div>
						<div class="col-sm-3 ">
							<h5 class="copyright">&copy; 2017 EMOEY,INC</h5> </div>
						<div class="col-sm-4 "> <a target="_blank" href="https://www.instagram.com/emoey.company/"> <img class="social-icon" src="<?php echo base_url();?>assets/img/intagram.png" width="30">   </a> <a target="_blank" href="https://twitter.com/EmoeyCompany"> <img class="social-icon" src="<?php echo base_url();?>assets/img/twiter.png" width="30"> </a>
						<a target="_blank" href="https://www.facebook.com/emoey.company/"> <img class="social-icon" src="<?php echo base_url();?>assets/img/facebook.png" width="30"> </a> </div>
						<div class="col-sm-3 ">
							<h5 class="copyright"></h5> </div>
						<div class="col-sm-1"></div>
					</div>
				</div>
			</div>

			<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/tether.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

			
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.zoom.js"></script>
			<script src="<?php echo base_url();?>assets/js/jquery.touchSwipe.min.js"></script>

			



			

	</div>
</body>

</html>