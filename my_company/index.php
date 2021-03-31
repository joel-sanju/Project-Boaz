<?php

require_once('connect/config.php');

if(isset($_REQUEST['logout'])){   ///Logout  area
     session_start();	   
	session_unset();
	session_destroy();
	die(header('Location: ./'));
	
}

else {  // login form  

$page_title = "Login"; // Title of page
$header_n = 'Login';

require_once('templates/header.php');

$reff = glob_site_url;

if(isset($_GET['reff'])){
	
	$reff = $_GET['reff'];
	
}

?>  

   <section class="ftco-cover" style="background-image: linear-gradient(to bottom, rgba(3, 2, 2, 0.3), rgba(4, 2, 2, 0.3)), url(images/bg.jpg); min-height:100vh; padding:40px 0px;" id="section-home">

    <div class="container main_container" style="">
    
    
    <?php if(!(isset($_SESSION['admina']) || isset($_SESSION['uid']))){ ?> 	   	     
    
   <div id="login_section_n0">
   	<h2 style="text-align:center; color:#FFF">Login here</h2>
      <div class="modal-dialog modal-lg" role="document" style="max-width:400px;">
        <div class="modal-content" style="background-color:transparent;">
          <div class="modal-body" style="background-color:#FFF; color:#333; font-size:16px; border-radius:10px;">
            <div class="row">
              <div class="col-12">
                <form action="#" method="post" onSubmit="sign_in_form(event)" id="log_form">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="m_email">Email Addess</label>
                      <input type="email" minlegth="3"  reqiured  required class="form-control" id="m_email" name="email">
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="m_password">Password</label>
                      <input type="password" required class="form-control" id="m_password" name="password">
                       <input type="hidden" name="sign_in" id="sign_in" value="">
                       
                    </div>
                    <div class="col-12"><div id="errmsg" style=" margin: 20px;"></div>
</div>
                    <div class="col-md-12 form-group" id="sbutton" style="text-align: center">
                      <button type="submit" class="btn btn-primary btn-lg btn-block fa fa-sign-in" style="border-radius:10px;"> Log in</button>
                      
					</div>
                </form>
              </div>
              <div style=" min-width:100%; text-align:left;">
              <div style="margin-left:10px; margin-top:30px; display:inline-block; display:inline-block"><a style="border-bottom:1px #06C solid; padding-bottom:3px; cursor:pointer" onclick="change_login_mode(0)">Forgot Password?</a></div>
            </div>
            
           </div>
            
          </div>
            
          </div>
        </div>
      </div>
    <!-- END Modal -->
   </div>
   
   
   
   <div id="login_section_n1" style="display:none">
      <div class="modal-dialog modal-lg" role="document" style="max-width:400px;">
        <div class="modal-content" style="background-color:transparent;">
          <div class="modal-body" style="background-color:#FFF; border-radius:10px; color:#333;">
            <div class="row">
              <div class="col-12">
                <form action="#" method="post" onSubmit="forgot_p_form(event)" id="forgot_p_form">
                  <div class="row">
                  	<div class="col-md-12">
                    	<p style="font-size:12px; background-color:rgba(50,50,50, 0.7); padding:10px; border-radius:5px;">Input the Email address you used in registering account. We will send a password reset link to your Email address</p>
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="m_email">Email Addess</label>
                      <input type="hidden" name="forgot_password" id="forgot_password" value="">
                      <input type="email" minlegth="3"  reqiured  required class="form-control" id="m_email_p" name="email">
                    </div>
                    <div class="col-12"><div id="errmsg_p" style=" margin: 20px;"></div>
</div>
                    <div class="col-md-12 form-group" id="sbutton_p" style="text-align: center">
                      <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>
					</div>
                </form>
              </div>
              <div style="margin-left:20px; margin-top:30px"><a style="border-bottom:1px #F30 solid; padding-bottom:3px; cursor:pointer" onclick="change_login_mode(1)" class="fa fa-sign-in"> Login</a></div>
            </div>
            
          </div>
        </div>
      </div>
    <!-- END Modal -->
   </div>
   
   <?php } ?>
   
     
</div>
</section>    
    <script>
	
	var glob_reff = '<?php echo $reff; ?>';
	
	</script>
    
   <?php require_once('templates/footer.php');  ?>

</body>
</html>


<?php

}
?>