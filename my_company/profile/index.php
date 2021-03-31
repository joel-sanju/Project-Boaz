<?php
session_start();

if(!isset($_SESSION['uid'])) die(header('Location: ../'));
require_once('../connect/config.php');


$page_title = "Profile"; // Title of page

$uid = $_SESSION['uid'];

$global_report = ""; 

$pdo = new mypdo();


if(isset($_POST['ch']) && $_POST['ch'] == "update_profile") {
		
	    $fname =  validate('Full Name', 2, $_POST['fname']);
		$email =  validate('email', 6, $_POST['email']);
		$phone =  validate('Phone', 0, $_POST['phone']);
		
		
	    //Check if there is any error in our validation 
		if($GLOBALS['global_report'] != '')
			die($GLOBALS['global_report']);
		
		
		die($pdo->update_profile($uid, $fname, $email, $phone));
			 	
}
if(isset($_POST['ch']) && $_POST['ch'] == "password") {

		$password =  $_POST['password'];
		$password_1 =  $_POST['password1'];
		$password_2 =  $_POST['password2'];
		
		if(($password_1 != $password_2)  || (strlen($password_1) < 6))
			die('Please retype password. New password not match');
		
		$pdo = new mypdo();    //Instantiate new PDO class
		
		$profn = $pdo->get_user($uid);
		
		$verify = password_verify($password, $profn['password']);
	  	if(!$verify)
			die('Old password is incorrect');
	   
	   $password =  password_hash($password_1, PASSWORD_DEFAULT);
	 	
		die($pdo->update_password($uid, $password));
		
}



$user = $pdo->get_user($uid);

require_once('../templates/header.php');



?>  

   <section style="background-color:#EEE">
    <div class="container main_container" style=" min-height:80vh; padding-top:10px; color:#333; text-align:center; background-color:#FFF;">
    <p style="text-align:right"><a href="../?logout=1"> <span class="fa fa-sign-out"></span> Logout</a></p>
   <div style="max-width:900px; display:inline-block; width: 100%;">
    
    
     
     <table class="table table-hover" style="border:1px solid #CCC; border-radius:10px; color: #555; text-align:left">
     
     	<tr><td colspan="2" style="padding:10px; background-color:#CCC"> <span style="font-size:19px; font-weight:bold; color:#555;">Profile details</span> <button class="btn" style="background-color:#06C; color:#FFF; float:right" onclick="$('#modal_profile').modal('show')"> Update</button></td></tr>
     	
        <tr><th>FullName.</th><td id="fname_vx"> <?php echo $user['fname']; ?></td></tr>
        <tr><th>Email address.</th><td id="email_vx"> <?php echo $user['email']; ?></td></tr>
        <tr><th>Phone Number.</th><td id="phone_vx"> <?php echo $user['phone']; ?></td></tr>
        
     	<tr><td colspan="2" style="padding:10px; background-color:#F9F9F9"> <button class="btn" style="background-color:#06C; color:#FFF; float:right" onclick="$('#modal_password').modal('show')"><span class="fa fa-lock"></span> Change Password</button></td></tr>
      
      
     </table>
    
    
    
   	
    
    
    </div>
    
   
    
</div>
</section> 


<div class="modal" id="modal_profile">
	<form action="" target="_blank" id="update_profile" onsubmit="update_profile(event)">
  	<div class="modal-dialog">
    <div class="modal-content" style="background-color: #AAA; color:#333">
     <div class="modal-header">
    	<h4>Update Profile</h4>
        <div style="text-align:right"> <button  data-dismiss="modal" type="button" class="close">&times;</button></div>
        
      </div>
 <!-- Modal body -->
      <div class="modal-body" style="font-size:14px;">
         
        <div class="form-group" style="border-bottom:1px #333 solid; margin-bottom:10px">
        	 <div class="form-group">
                <label style="font-weight:600">FullName</label>
                <input minlength="2" required name="fname" value="<?php echo $user['fname']; ?>" id="fname_x"  class="form-control">
             </div>
             <div class="form-group">
                <label style="font-weight:600">Email Address</label>
                <input type="email" minlength="6" required name="email" value="<?php echo $user['email']; ?>" id="email_x"  class="form-control">
             </div>
             <div class="form-group">
                <label style="font-weight:600">Phone</label>
                <input type="tel" minlength="6"  name="phone" id="phone_x" value="<?php echo $user['phone']; ?>"  class="form-control">
             </div>
             
        </div>
        
      </div>
 <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary fa fa-plus" style="font-weight:bold" type="submit"> Update</button>
      </div>

    </div>
  </div>
  </form>
</div>


<div class="modal" id="modal_password">
	<form action="" target="_blank" id="update_password" onsubmit="update_password(event)">
  	<div class="modal-dialog">
    <div class="modal-content" style="background-color: #AAA; color:#333">
     <div class="modal-header">
    	<h4><span class="fa fa-lock"></span>  Change Password</h4>
        <div style="text-align:right"> <button  data-dismiss="modal" type="button" class="close">&times;</button></div>
        
      </div>
 <!-- Modal body -->
      <div class="modal-body" style="font-size:14px;">
         
        <div class="form-group" style="border-bottom:1px #333 solid; margin-bottom:10px">
        	 <div class="form-group">
                <label style="font-weight:600">Old Password</label>
                <input minlength="6" required name="password"  type="password" id="password"  class="form-control">
             </div>
             <div class="form-group">
                <label style="font-weight:600">New Password</label>
                <input minlength="6" required name="password1"  type="password" id="password1"  class="form-control">
             </div>
             <div class="form-group">
                <label style="font-weight:600">Retype Password</label>
                <input minlength="6" required name="password2"  type="password" id="password2"  class="form-control">
             </div>
             
             
        </div>
        
      </div>
 <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" style="font-weight:bold" type="submit"> Update</button>
      </div>

    </div>
  </div>
  </form>
</div>


    
   <?php require_once('../templates/footer.php');  ?>

</body>
</html>


<?php


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
	 
	 
   
	  
	 public function get_user($uid){
		 
		 $qry = "SELECT password, fname, email, phone  FROM users WHERE id = ?";
		
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $uid, PDO::PARAM_INT);
     	 $stmt->execute();
		 return $stmt->fetch();
	 }
	
	 
	 
	 public function update_profile($uid, $fname, $email, $phone){
		 try{
		  $qry = "UPDATE users SET fname = ?, email = ?, phone = ? WHERE id = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $fname, PDO::PARAM_STR);
		 $stmt->bindParam(2, $email, PDO::PARAM_STR);
		 $stmt->bindParam(3, $phone, PDO::PARAM_STR);
		 $stmt->bindParam(4, $uid, PDO::PARAM_INT);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return 'PASS'; else return 'Error';
		 }catch(Exception $ex){ return "Error! Please use another Email address";}
	 
	 }

		
	public function update_password($uid, $password){
		// try{
		  $qry = "UPDATE users SET password = ? WHERE  id = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $password, PDO::PARAM_STR);
		 $stmt->bindParam(2, $uid, PDO::PARAM_INT);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return 'PASS'; else die('No update was made');
		  
	 
	 }
	 
	
}


function validate($field, $limit, $value, $extra = ''){
	
	  if(strlen($value) < $limit) $GLOBALS['global_report'] .=  'Not a valid data entry provided for '.$field.'<br><br>';
	  
	if($extra != '') // This must be a password field
	if($value  != $extra) $GLOBALS['global_report'] .=  'Password not match<br><br>';
	  
    if($extra != '') // This must be a password field; return a hash password
		return password_hash($value, PASSWORD_DEFAULT);
	else  /// Purify the string from html 
        return htmlspecialchars($value,  ENT_COMPAT);
	
	
	
}
