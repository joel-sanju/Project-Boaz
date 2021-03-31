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

if($_SESSION['role'] == '9') $kzn =  1; else {
	die('auttentication error. Please login');	
}

$uid = $_SESSION['admina'];


		 

$pdo = new mypdo();


if(isset($_POST['action']) && $_POST['action'] == 'remove'){
	
	$datan = $_POST['data'];
	$rdata = array();
	
	foreach($datan as $index => $row){
		
		      //DELETE the ROW here
				$pdo->gen_qry_one('DELETE FROM managers WHERE id = ?',$index);
				
	}
	    
	$return_d = json_encode(array('data' => $rdata));
	
    die($return_d);
	
}



if(isset($_POST['action']) && $_POST['action'] == 'edit'){
	
	
	$datan = $_POST['data'];
	$rdata = array();
	
	foreach($datan as $index => $row){
		    
			 $fname = $row["1"];
			 $lname = $row["2"];
			 $email = $row["3"];
			 $phone = $row["4"];
			 //$password = $row["5"];
			 
			 $pdo->update_table($index, $fname, $lname, $email, $phone);
			 $rdata[] = array(0 => $index);	
		
		}
	    
	$return_d = json_encode(array('data' => $rdata));
	
    die($return_d);
	
}
if(isset($_POST['action']) && $_POST['action'] == 'create'){
	
	$datan = $_POST['data'];
	$rdata = array();
	
	foreach($datan as $index => $row){
		    
			 $fname = $row["1"];
			 $lname = $row["2"];
			 $email = $row["3"];
			 $phone = $row["4"];
			 $password = password_hash($row["5"], PASSWORD_DEFAULT);;
			 
			 $new_idx = $pdo->new_entry($fname, $lname, $email, $phone, $password);
			 $rdata[] = array(0 => $new_idx);
			 //$rdata[] = $pdo->get_word_translation($index, $table_name);	
		
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
	
	
	public function update_table($index, $fname, $lname, $email, $phone){
		
		$qry = "UPDATE   managers SET fname = ?, lname = ?, email = ?, phone = ? WHERE id = ?";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $fname, PDO::PARAM_STR);
		$stmt->bindParam(2, $lname, PDO::PARAM_STR);
		$stmt->bindParam(3, $email, PDO::PARAM_STR);
		$stmt->bindParam(4, $phone, PDO::PARAM_STR);
		$stmt->bindParam(5, $index, PDO::PARAM_INT);
		$stmt->execute();
		return "PASS";
	}
	
	public function new_entry($fname, $lname, $email, $phone, $password){
		
		$qry = "INSERT INTO  managers(fname, lname, email, phone, password)VALUES(?, ?, ?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $fname, PDO::PARAM_STR);
		$stmt->bindParam(2, $lname, PDO::PARAM_STR);
		$stmt->bindParam(3, $email, PDO::PARAM_STR);
		$stmt->bindParam(4, $phone, PDO::PARAM_STR);
		$stmt->bindParam(5, $password, PDO::PARAM_STR);
		$stmt->execute();
		return $this->pdc->lastInsertId();
	}
	 
	
}

