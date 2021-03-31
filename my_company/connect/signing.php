<?php
//require our database config 
require '../connect/config.php';	



$global_report = ""; 




///##################################################
/////      USER REGISTRATION
///####################################################

if(isset($_POST['sign_up'])) {

		$fname = validate('first name', 3, $_POST['fname']);
	    $email = validate('email address', 8, $_POST['email']);
		
		$password = validate('password', 6, $_POST['password'], $_POST['password_2']);
		
	 //Check if there is any error in our validation 
		if($GLOBALS['global_report'] != ''){
		die($GLOBALS['global_report']);
		}
		
	   $pdo = new mypdo();    //Instantiate new PDO class
	   
	/*   check if Email already exist*/
	   if($pdo->check_user($email, 'email'))
		   die('Error! Email address already exist');
	  
	//We can now proceed to register user
	    
	$profn_d = $pdo->insert_user($email,  $fname, $password);
	
	$profn = $pdo->get_user($email);
	
	@session_start();
	$_SESSION['uid'] = $profn['id'];
	$_SESSION['email'] = $profn['email'];
	
	die($profn_d);
	
}



///##################################################
/////      SIGN IN
///####################################################
if(isset($_POST['sign_in'])) {

		$email = validate('email address', 3, $_POST['email']);
	    $password =  $_POST['password'];
		
		$utype = $_POST['sign_in'];

			
	  //Check if there is any error in our validation 
		if($GLOBALS['global_report'] != ''){
		die($GLOBALS['global_report']);
		}
	   $pdo = new mypdo();
	   
	   if($utype == ''){
		   $profn = $pdo->get_user($email);
		   $profm = $pdo->get_manager($email);
		   if($profn != null && $profm != null) die('ALT');
		   
		   if($profn == null && $profm == null) die('No login match');
		   
		   if($profn != null){
			  $verify = password_verify($password, $profn['password']);
			  if(!$verify)die('Password or user detail not match..');
			  session_start();
			  $_SESSION['uid'] = $profn['id'];
			  $_SESSION['email'] = $profn['email'];
			  //$pdo->update_lastime($profn['id'], time());
			  die('PASSO');  
		   }
		   elseif($profm != null){
			  $verify = password_verify($password, $profm['password']);
			  if(!$verify)die('Password or user detail not match..');
			  session_start();
			  $_SESSION['admina'] = $profm['id'];
			  $_SESSION['email'] = $profm['email'];
			  $_SESSION['role'] = $profm['level'];
			  die('PASSM');  
		   }
		
		}
		elseif($utype == 'unit_owner'){
			$profn = $pdo->get_user($email);
			if($profn == null) die('No login match');
			$verify = password_verify($password, $profn['password']);
			if(!$verify)die('Password or user detail not match..');
			session_start();
			$_SESSION['uid'] = $profn['id'];
			$_SESSION['email'] = $profn['email'];
			//$pdo->update_lastime($profn['id'], time());
			die('PASSO');
			
		}
		elseif($utype == 'manager'){
			$profm = $pdo->get_manager($email);
			$verify = password_verify($password, $profm['password']);
			 if(!$verify)die('Password or user detail not match..');
			 session_start();
			 $_SESSION['admina'] = $profm['id'];
			 $_SESSION['email'] = $profm['email'];
			 $_SESSION['role'] = $profm['level'];
			 die('PASSM');
			
		}
	  
	  
		
	  
       
		
		 
}




///##################################################
/////      Forgot PW
///####################################################

if(isset($_POST['forgot_password'])) {

		$email = validate('email address', 4, $_POST['email']);
		
		$utype = $_POST['forgot_password'];
	    
		//Check if there is any error in our validation 
		if($GLOBALS['global_report'] != ''){
			die($GLOBALS['global_report']);
		}
		$timec = time();
		
		$pdo = new mypdo();
		  
		if($utype == ''){
		   $profn = $pdo->get_user($email);
		   $profm = $pdo->get_manager($email);
		   if($profn != null && $profm != null) die('ALT');
		   if($profn == null && $profm == null) die('No record for this Email address');
		   
		   if($profn != null){
			  $username = $profn['fname'];  $email = $profn['email']; $utype_n = 'un';
		   }
		   elseif($profm != null){
			  $username = $profm['fname'];  $email = $profm['email'];  $utype_n = 'mn';
		   }
		   $stg =  $pdo->insert_recover($timec, $email);
		   mailler($username, $email, $timec, $utype_n);  //Send recover password link to the user
		   die('PASS');
		
		}
		elseif($utype == 'unit_owner'){
			$profn = $pdo->get_user($email);
			if($profn == null) die('No record for this Email address');
			$username = $profn['fname'];  $email = $profn['email']; $utype_n = 'un';
			
		   $stg =  $pdo->insert_recover($timec, $email);
		   mailler($username, $email, $timec, $utype_n);  //Send recover password link to the user
		   die('PASS');
			
		}
		elseif($utype == 'manager'){
			$profm = $pdo->get_manager($email);
			if($profm == null) die('No record for this Email address');
			$username = $profm['fname'];  $email = $profm['email']; $utype_n = 'mn';
			
		   $stg =  $pdo->insert_recover($timec, $email);
		   mailler($username, $email, $timec, $utype_n);  //Send recover password link to the user
		   die('PASS');
			
		}
		
		
		
		
		
		
	   
		
		
		 
}








class mypdo{
	 public $pdc = null;
	 public function __construct(){
		 $host = dbhost;
		 $db   =  dbname;
		 $user  =  dbuser;
		 $pass  =   dbpass;
		 $charset = 'utf8';
		 $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		 $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];
		 $this->pdc = new PDO($dsn, $user, $pass, $opt);
		 }
	 
	 	
		
	public function get_user($email){
		
		 $qry = "SELECT id, password, fname,  email FROM users WHERE email = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $email, PDO::PARAM_STR);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return $stmt->fetch(); else return null;
		  
	 
	 }
	
	public function check_user($val, $ch){
		
		$qry = "SELECT id  FROM users WHERE $ch = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $val, PDO::PARAM_STR);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return true; else return false;
		 }
	 
	 
  public function insert_user($email, $fname,   $pwd){
		  $qry = "INSERT INTO users(email, fname, password)VALUES(?, ?, ?)";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $email, PDO::PARAM_STR);
		 $stmt->bindParam(2, $fname, PDO::PARAM_STR);
		 $stmt->bindParam(3, $pwd, PDO::PARAM_STR);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return 'PASS'; else return 'An error occured while creating account';
		  
	 
	 }
	
	
	public function get_manager($email){
		
		 $qry = "SELECT id, password,  email, fname, level FROM managers WHERE email = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $email, PDO::PARAM_STR);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return $stmt->fetch(); else return null;
		  
	 
	 }
	 
	 public function insert_recover($timec, $username){
		 $qry = "INSERT INTO recovertb (id, username) VALUES (?, ?)";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $timec, PDO::PARAM_INT);
		 $stmt->bindParam(2, $username, PDO::PARAM_STR);
		 $stmt->execute();
		 if($stmt->rowCount() < 1)
		 die(json_encode(array('status' => 'error', 'message' => 'A database error occured')));
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







use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailler($username,$email,$timec, $utype){

/****  Required all necessary PHPMail library and a custom encrypt library to encrypt our data */

				   require 'Mailer/src/Exception.php';
				   require 'Mailer/src/PHPMailer.php';
				   require 'Mailer/src/SMTP.php';
				   require 'crypto.php';
		 
		$ref2 = encrypt($username.">>".time().">>".$username.">>8");
		
		$ref = encrypt($timec."___".$email."___".$username."___".$timec);
		
		$recover_link = glob_site_url."/password_recovery.php?pl=$ref&n=$utype&ch=1o";   
		
		
		$mssg = '<!doctype html><html> <head> <meta name="viewport" content="width=device-width"> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <title>'.glob_site_url_fd.' | PASSWORD RECOVERY</title> </head> <body style="text-align:center; background-color:#EEE; color:#333"> <div style="text-align:center; max-width:600px; display:inline-block;"> <div style=" text-align:left; background-color:#FFF; padding:10px "> <h3 style=" font-size:20px; text-align:center; color:#D23D0B; margin-bottom: 30px;">Recover Password   </h3> <p style="margin-bottom: 15px; text-align:center; font-weight:normal; color:#333"><span style="color:#D23D0B; font-weight:bolder; font-size:18px; margin-right:20px">Hello! '. $username. '</span> Please click on the link below to recover your password</p> <p style="text-align:center"><a style="color:#ffffff; margin:20px; padding:10px; border-radius:5px; display:inline-block; text-decoration:none; background-color: #D23D0B; border: solid 2px #FFF;  font-size: 18px; font-weight: bold;" href="'. $recover_link.'"> Recover Password </a></p><p style="font-size: 12px">Or copy the link below and paste it in a browser address bar</p><p style="font-size:12px; white-space:pre-wrap"><a STYLE="color:#06F" href="'. $recover_link.'">'. $recover_link.'</a></p> <p style="font-style:italic; font-size: 12px; font-weight: normal; margin-bottom: 15px; color:#333">You received this mail because you were about recovery a password at '.glob_site_url_fd.' Kindly ignore if you were not the one.</p> </div> <div style=" margin-top:40px; margin-bottom:10px; color: #999999; font-size: 12px; text-align: center;">'.glob_site_url_fd.'. </div><div style="font-size: 12px; text-align: center;"> <a href="'.glob_site_url.'" style="color: #999999;text-decoration: none;">&copy; '.glob_site_url_fd.'</a>. </div> </div> </body></html>';
		
		//die($mssg);
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		
		//Remove this block. It is unsecure to some extent. It was added because of encryption problem at my local host
		   $mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		
			  $mail->isSMTP();
			   $mail->Host = smtp_host;
			   $mail->Port = smtp_port;
			   //$mail->SMTPDebug = 5;
			  
			   $mail->CharSet = 'utf-8';
			   $mail->SMTPAuth = true;
				  //Username to use for SMTP authentication
			   $mail->Username = smtp_username;
				//Password to use for SMTP authentication
			   $mail->Password = smtp_password;
				// Enable TLS encryption, `ssl` also accepted
			   $mail->SMTPSecure = smtp_secure;                             
		
		//Set who the message is to be sent from
		$mail->setFrom(smtp_username, glob_site_name);
		//Set an alternative reply-to address
		$mail->addReplyTo("noreply@".glob_site_url_fd, 'No Reply');
		//Set who the message is to be sent to
		$mail->addAddress($email, '');
		//Set the subject line
		$mail->Subject = "Reset Your Password";
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($mssg);
		//Replace the plain text body with one created manually
		$mail->AltBody = "Please click on the link below to reset your password /n/n $recover_link";
		
		//Attach an image file
		//$mail->addAttachment('1473787167.5497.JPEG');
		
		if (!@$mail->send()) {
			return "error";
		} else {
			return "good";
		}
}