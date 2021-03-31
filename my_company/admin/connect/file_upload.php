<?php
session_start(); 


require '../../connect/config.php';

if(isset($_SESSION['admina'])){
	$idc = 	$_SESSION['admina'];
 }
else{
	
	die('auttentication error. Please refresh browser and login');
	
	}


 
 if(isset($_POST['filename'])){

     $global_report = ""; 
	 
	 $filename =  str_replace(",", "", trim(str_replace(",", "", $_POST['filename'])));
	 $id =  $_POST['row_id'];
    
	 $filen = $_FILES['file'];


	 $mime = strtolower(pathinfo($filen["name"], PATHINFO_EXTENSION));
	 if(!in_array($mime, array("jpg", "jpeg", "png", "gif", "pdf", "docx", "doc", "xlsx", "pptx", "xls", "ppt")))
 		die("not a valid file type");
	    
	 $time_n = time();
		
	 	$pford = '../../uploads/'.date("Y/m/", $time_n);
	  
		$token = $id.'_'.$time_n;
	  
	    if(!file_exists($pford)){ mkdir($pford, 0777, true);}
		 
		$file_n = $token.".".$mime;
		 
		 $pford .= "/".$file_n;
		 
		 move_uploaded_file($filen['tmp_name'], $pford);
		 
		 $pdo = new mypdo();
		 
		 if($id == 'new')
		 	die("PASS,,".$filename.",".$file_n);
		 
		 die($pdo->update_user_file($id, $filename.",".$file_n));

 }




 if(isset($_POST['file_n'])){

     $global_report = ""; 
	 
	 $file_n =  $_POST['file_n'];
	 $f_data = explode(",", $file_n);
	 $file_name = $f_data[0];
	 $real_path = $f_data[1];
	 
	 $id =  $_POST['row_id'];
    
	 $fpath = explode(".", $real_path);
	
	 $path_nxx =  explode('_', $fpath[0]);
	
	$folder = date("Y/m/", (int)$path_nxx[1]).$real_path;
	$pford = '../../uploads/'.$folder;
	   
	 @unlink($pford);
		 
	$pdo = new mypdo();
		 
	die($pdo->update_user_file_2($id, $file_n));

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
	 
	
	public function update_user_file($id, $file){ 
		 
		$qry = "INSERT INTO user_files(uid, file)VALUES(?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $id, PDO::PARAM_INT);
		$stmt->bindParam(2, $file, PDO::PARAM_STR);
		$stmt->execute();
		return 'PASS'.$file;
	}
	
	public function update_user_file_2($id, $file){ 
		 
		$qry = "DELETE FROM user_files WHERE uid = ? AND file = ?";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $id, PDO::PARAM_INT);
		$stmt->bindParam(2, $file, PDO::PARAM_STR);
		$stmt->execute();
		return 'PASS';
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




