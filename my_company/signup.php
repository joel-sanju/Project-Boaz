<?php
require_once('connect/config.php');

$page_title = "Account Registration"; // Title of page
$header_n = 'Sign Up';


require_once('templates/header.php');

$reff = glob_site_url;

if(isset($_GET['reff'])){
	
	$reff = $_GET['reff'];
	
}



?>  

   <section class="ftco-cover" style="background-image: url(images/bg_1.jpg); min-height:100vh; padding:40px 0px;" id="section-home">

    <div class="container main_container" style="">
    	   	     
    <h1 class="main_header" style="color:red"></h1> 
      <div class="modal-dialog modal-lg" role="document" style="text-align:center">
        <div class="modal-content" style="background-color:transparent; max-width:500px; display:inline-block;">
          <div class="modal-body" style="background-color:#FFF; color:#333; border-radius:10px; text-align:left">
            <div class="row">
              <div class="col-12">
                 
                <form action="#" id="reg_form" onSubmit="submit_reg_form(event)" method="post">
                 <div id="errmsg" style=" margin: 20px;"></div>
                  
                  <div class="row">
                    <div class="col-12 form-group">
                      <label for="m_fname">FullName  *</label>
                      <input type="text" required minlength="3" maxlength="50" class="form-control" id="m_fname" name="fname">
                    </div>
                    <div class="col-12 form-group">
                      <label for="m_email">Email Address *</label>
                      <input type="email"  required class="form-control" id="m_email" name="email">
                    </div>
                    <div class="col-12 form-group">
                      <label for="m_password">Password  *</label>
                      <input type="password"  minlength="6" required class="form-control" id="m_password" name="password">
                    </div>
                    <div class="col-12 form-group">
                      <label for="m_password_2">Retype Password *</label>
                      <input type="password" minlength="6"  required class="form-control" id="m_password_2" name="password_2">
                    </div>
                  </div>
                  
                  
                  <div class="row">
                    <input type="hidden" name="user_type" id="user_type" value="">
                    <input type="hidden" name="sign_up" value="sign_up">
                    <div class="col-md-12 text-center " id="sbutton">
                      <input type="submit" class="btn btn-primary" value="Sign Up">
                    </div>
                  </div>

                </form>
              </div>
            </div>
            
        </div>
      </div>
   </div> 
    <!-- END Modal -->
    
    
</div>
</section>    
  
    <script>
	
	var glob_reff = '<?php echo $reff; ?>';
	
	</script>  
    
 <?php require_once('templates/footer.php');  ?>

</body>
</html>
