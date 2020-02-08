<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
    .wrapper {    
    margin-top: 80px;
    margin-bottom: 20px;
}

.form-signin {
  max-width: 420px;
  padding: 30px 38px 66px;
  margin: 0 auto;
  background-color: #eee;
  border: 3px dotted rgba(0,0,0,0.1);  
  }

.form-signin-heading {
  text-align:center;
  margin-bottom: 30px;
}

.form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
}

input[type="text"] {
  margin-bottom: 0px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

input[type="password"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.colorgraph {
  height: 7px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}

</style>
            <!--            content area start-->
  <div class="container-fluid section1-bg viewport-size">
    <div class = "container" style="margin-top:80px;">
    <div class="wrapper">
      <?php if($data['isvalid'] == TRUE) { ?>
           <?php echo form_open(base_url().'change_password',array(
                      'class' => 'form-signin','id'=>'forgotpassword','name' => 'Login_Form')); ?>       
            <h3 class="form-signin-heading">Change Password</h3>
              <hr class="colorgraph"><br>
              
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" autofocus="" />
              <input type="password" class="form-control" id="confirm_password" name="confirm-password" placeholder="Confirm Password" required=""/>
              <input type="hidden" value="<?php echo $data['email']; ?>" name="email" required="" />
              <input type="hidden" value="<?php echo $data['token']; ?>" name="token" required="" />     
              <button class="btn btn-lg btn-primary btn-block"  name="submit" type="Submit">Change Password</button>            
        </form>   
        <?php }else{ ?>
        <div class="row"> <div class="col-md-3"></div>
        <div class="col-md-6">
          <h2 class="headerchangepassword"><?php echo $data['message']; ?></h2>
          <a class="btn btn-block btn-emoey" href="<?php echo base_url(); ?>">Enjoy Emoey!</a>
        </div>
      <div class="col-md-3"></div> </div>
        <?php }?>    
    </div>
 </div>
</div>

<script type="text/javascript">

$( document ).ready(function() {
    var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
});
</script>