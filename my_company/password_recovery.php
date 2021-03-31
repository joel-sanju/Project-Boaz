<?php
require './connect/config.php';


if(isset($_POST["token"]) and !isset($_POST["submitf"])){
	require './connect/crypto.php';

    	 
	$pword = password_hash($_POST['pword'], PASSWORD_DEFAULT); 
    
	$token =  $_POST['token'];
	
	    if($token == "") die("This link has already been used");
		  $raw_data = decrypt($token);
		  $data = explode("___", $raw_data); 
		  //$timec."___".$email."___".$username."___".$timec
		  $timec = $data[0]; 
		  if($data[0] != $data[3]) die("");
		  if((time() - $timec) > 7200) die("Sorry! This link has expired");
		  
		  
		   $pdo = new mypdo();
		  $pdo->get_recover($timec, $data[1]);
		     
		  $pdo->delete_recover($timec, $data[1]);
		  
		  $ucn = $_POST['ucn'];
		  if($ucn == 'un')
		  	$table = 'users';
		  elseif($ucn == 'mn')
		  	$table = 'managers';
		  else
		  	die('Error');
			
					  
		  $pdo->update_password($pword, $data[1], $table);
          
		   die("PASS");  

 
			  }
             

     
elseif(isset($_REQUEST["pl"]) and !isset($_POST["submitf"])){
              
			 require'./connect/crypto.php';
			 $raw_data = decrypt($_REQUEST["pl"]);
		     $data = explode("___", $raw_data); 
			 $username =	$data[2];
			 $utype =	$_REQUEST['n'];	 
             
			 html_out($_REQUEST["pl"], $username, $utype); }





function html_out($token, $username, $utype){
	
$page_title = "Reset Password";

require_once('templates/header.php');


?>  

   <section class="ftco-cover" style="background-image: linear-gradient(to bottom, rgba(3, 2, 2, 0.3), rgba(4, 2, 2, 0.3)), url(images/bg.jpg); min-height:100vh; padding:40px 0px;" id="section-home">

    <div class="container main_container" style="">
    	   	     
    
    
   <div id="login_section_n0">
    <h2 class="main_header" style="color:#FFF; text-align:center">Reset your Password</h2> 
      <div class="modal-dialog modal-lg" role="document" style="max-width:400px;">
        <div class="modal-content" style="background-color:transparent;">
          <div class="modal-body" style="background-color:#FFF; color:#333; border-radius:10px;">
            <div class="row">
              <div class="col-12">
                <form action="#" method="post" onSubmit="password_change_form(event)" id="password_reset_form">
                  <div class="row">
                  	<div class="col-md-12">
                    	<p style="font-size:12px; background-color:rgba(50,50,50, 0.7); padding:10px; border-radius:5px;">Enter your new password detail below. </p>
                    </div>
                    <div class="col-md-12 form-group">
                      <label>New Password </label>
                      <input class="form-control" id="pword1" name="pword" required placeholder="*******" type="password" />
                      
                    </div>
                    <div class="col-md-12 form-group">
                    	<label>Retype Password </label>
                    	<input class="form-control" id="pword2" name="pword2" required placeholder="*******" type="password"/>
                     </div>
                    <div class="col-12"><div id="errmsg" style=" margin: 20px;"></div>
</div>
                    <div class="col-md-12 form-group" id="sbutton" style="text-align: center">
                      <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" /><input type="hidden" id="token" name="ucn" value="<?php echo $utype; ?>" /><input type="hidden" name="username" id="username" value="<?php echo $username; ?>" /><input type="submit" class="btn btn-primary btn-lg btn-block" value="Reset">
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
   
   
   
     
</div>
</section>    
    
    
    <?php require_once('templates/footer.php');  ?>

</body>
</html>


<?php 
}







class mypdo{
	 public $pdc = null;
	 public function __construct(){
		 $host = dbhost;
		 $db   =  dbname;
		 $user  =  dbuser;
		 $pass  =   dbpass;
		 $charset = 'utf8mb4';
		 $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		 $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];
		 $this->pdc = new PDO($dsn, $user, $pass, $opt);
		 }
	 
	 
	 
	 public function get_recover($timec, $username){
		 $qry = "SELECT username FROM recovertb WHERE id = ? AND username = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $timec, PDO::PARAM_INT);
		 $stmt->bindParam(2, $username, PDO::PARAM_STR); 
		 $stmt->execute();
		 if($stmt->rowCount() < 1)
		 die('link has expired');
		 else{
		  return $stmt->fetch();
		    }
		    
		 }
	  
	  public function delete_recover($timec, $username){
		 $qry = "DELETE FROM recovertb WHERE id = ? AND username = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $timec, PDO::PARAM_INT);
		 $stmt->bindParam(2, $username, PDO::PARAM_STR); 
		 $stmt->execute();
		 }
	   
	   
	   public function update_password($pword, $username, $table){
		 $qry = "UPDATE $table SET password = ? WHERE email = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $pword, PDO::PARAM_STR);
		 $stmt->bindParam(2, $username, PDO::PARAM_STR); 
		 $stmt->execute();
		  }
	 }
