<?php
session_start(); 

session_write_close(); //prevent session locking

require '../../connect/config.php';

if(isset($_SESSION['admina'])){
	$uid = 	$_SESSION['admina'];
	}
else{
	
	die(die(json_encode(array("error" => 'auttentication error. Please refresh browser and login'))));
	}


$uid = $_SESSION['admina'];


		 

$pdo = new mypdo();


if(isset($_POST['action']) && $_POST['action'] == 'remove'){
	
	$datan = $_POST['data'];
	$rdata = array();
	
	foreach($datan as $index => $row){
		
		    
			$user_files = $pdo->get_files($index);    
			
			foreach($user_files as $file_sn){	
				
				$file_n = $file_sn['file'];
				
				 $f_data = explode(",", $file_n);
				 $file_name = $f_data[0];
				 $real_path = $f_data[1];
				 
				 $fpath = explode(".", $real_path);
				
				 $path_nxx =  explode('_', $fpath[0]);
				
				$folder = date("Y/m/", (int)$path_nxx[1]).$real_path;
				$pford = '../../uploads/'.$folder;
				@unlink($pford);
			}
			  
				$pdo->gen_qry_one('DELETE FROM user_files WHERE uid = ?',$index);
				$pdo->gen_qry_one('DELETE FROM users WHERE id = ?',$index);
				
	}
	    
	$return_d = json_encode(array('data' => $rdata));
	
    die($return_d);
	
}



if(isset($_POST['action']) && $_POST['action'] == 'edit'){
	
	
	$datan = $_POST['data'];
	$rdata = array();
	
	foreach($datan as $index => $row){
		    
			 
			 $fname = $row["1"];
			 $email = $row["2"];
			 $phone = $row["3"];
			 
			 $pdo->update_table($index, $fname, $email,  $phone);
			 $rdata[] = array(0 => $index);	
		
		}
	    
	$return_d = json_encode(array('data' => $rdata));
	
    die($return_d);
	
}
if(isset($_POST['action']) && $_POST['action'] == 'create'){
	
	$datan = $_POST['data'];
	$rdata = array();
	
	
	foreach($datan as $index => $row){
		    
		 $b_id = $row["1"];
			
			 $fname = $row["1"];
			 $email = $row["2"];
			 $phone = $row["3"];
			 $password = $row["4"];
			 
		
		$pwd = password_hash($password, PASSWORD_DEFAULT);
		$new_idx = $pdo->new_entry($fname, $email,  $phone, $pwd);
	    
	    $rdata[] = array(0 => $new_idx);
			 
		
		}
	    
	$return_d = json_encode(array('data' => $rdata));
    die($return_d);
	
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
	 
	 
		  
   public function gen_qry_one($qry, $id){
		 
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $id, PDO::PARAM_INT);
         $stmt->execute();		
	}
	
	public function gen_get_one($qry, $id, $ch){
		 $stmt = $this->pdc->prepare($qry);
	    if($ch == 0)
		 $stmt->bindParam(1, $id, PDO::PARAM_INT);
	   else
	   	$stmt->bindParam(1, $id, PDO::PARAM_INT);
         $stmt->execute();
		if($stmt->rowCount() > 0) return true; else return false;		
	}
	
	
	public function update_table($index, $fname, $email,  $phone){
		
		$qry = "UPDATE   users SET fname = ?, email = ?, phone = ? WHERE id = ?";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $fname, PDO::PARAM_STR);
		$stmt->bindParam(2, $email, PDO::PARAM_STR);
		$stmt->bindParam(3, $phone, PDO::PARAM_STR);
		$stmt->bindParam(4, $index, PDO::PARAM_INT);
		$stmt->execute();
		return "PASS";
	}
	
	public function new_entry($fname, $email, $phone, $pwd){
		
		$qry = "INSERT INTO  users(fname, email, phone, password)VALUES(?, ?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $fname, PDO::PARAM_STR);
		$stmt->bindParam(2, $email, PDO::PARAM_STR);
		$stmt->bindParam(3, $phone, PDO::PARAM_STR);
		$stmt->bindParam(4, $pwd, PDO::PARAM_STR);
		$stmt->execute();
		return $this->pdc->lastInsertId();
	}
	 
	 
	 public function get_files($uid){
		 $qry = "SELECT file FROM user_files WHERE uid = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $uid, PDO::PARAM_INT);
		 $stmt->execute();
		 return $stmt->fetchAll();
	}
	
	
	
}




