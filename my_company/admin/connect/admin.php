<?php
session_start(); 

require '../../connect/config.php';	

$dataz = json_decode(file_get_contents('php://input'), true);


if(isset($_SESSION['admina'])){
	$idc = 	$_SESSION['admina'];
 }
else{
			 
    die('auttentication error. Please login');
	}





///##################################################
/////     Update Password
///####################################################

if(isset($_POST['password'])) {

		$password =  $_POST['m_password'];
		$password_1 =  $_POST['m_password_1'];
		$password_2 =  $_POST['m_password_2'];
		
		if(($password_1 != $password_2)  || (strlen($password_1) < 6))
			die('Please retype password. New password not match');
		
		$pdo = new mypdo();    //Instantiate new PDO class
		
		$profn = $pdo->get_user($idc);
		
		$verify = password_verify($password, $profn['password']);
	  	if(!$verify)
			die('Old password is incorrect');
	   
	   $password =  password_hash($password_1, PASSWORD_DEFAULT);
	 	
		die($pdo->update_password($idc, $password));
		
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
	 
	 
 
 
    public function update_password($uid, $password){
		// try{
		  $qry = "UPDATE managers SET password = ? WHERE  id = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $password, PDO::PARAM_STR);
		 $stmt->bindParam(2, $uid, PDO::PARAM_INT);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return 'PASS'; else die('No update was made');
		  
	 
	 }
	
 	
    
	public function get_user($uid){
		
		 $qry = "SELECT id, password FROM managers WHERE id = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $uid, PDO::PARAM_INT);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return $stmt->fetch(); else return null;
		  
	 
	 }

}


