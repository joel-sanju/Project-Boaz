<?php
session_start();

if(!isset($_SESSION['uid'])) die(header('Location: ../'));
require_once('../connect/config.php');


$page_title = "Home"; // Title of page

$uid = $_SESSION['uid'];

$pdo = new mypdo();


if(isset($_GET['pg'])) $pg = $_GET['pg']; else $pg = 1;

if($pg < 1) $pg = 1;


$nom_row = 30;
$lmt = ($pg - 1) * $nom_row;

$files = $pdo->get_files($uid, $lmt, $nom_row);

require_once('../templates/header.php');



?>  
<style>
.file_role a {color:blue !important; font-size:16px; }
.date_role {color:#888; font-size:12px; }

</style>

   <section style="background-color:#EEE">
    <div class="container main_container" style=" min-height:80vh; padding-top:10px; color:#333; text-align:center; background-color:#FFF;">
     
     <h2>  Invoice </h2>
    
    <div style="max-width:800px; display:inline-block; width: 100%; text-align:left">
    
    <table class="table table-bordered table-hover">
    <?php $ic = 0; for($ic; $ic < count($files); $ic++){ $file = $files[$ic]; 
			
			$file_n = $file['file'];
			$f_data = explode(',', $file_n);
			$file_name = $f_data[0];
			$real_path = $f_data[1];
			$mime = explode('.', $real_path)[1];
			
			$real_path_wtm = substr($real_path, 0, strpos($real_path,  $mime));
			
			$fake_path =  "../uploads/".$real_path_wtm . '/' . urlencode($file_name) . '.' . $mime;
			
			$lnkb = '<a target="_blank" href="'.$fake_path.'">'.$file_name.'.'.$mime.'</a>';
			
			$date = date("M d, Y @ h:i a", strtotime($file['date']));		
		
		
	?>
    <tr>
    	<td class="file_role"><?php echo $lnkb; ?></td>
        <td style="text-align:right" class="date_role">Uploaded: <?php echo $date; ?></td>
    </tr>  
    
    <?php } ?>
    
    </table>
    
   	<div style="margin:40px 5px; text-align:left;">
    
    <?php if($ic ==$nom_row){ ?>	<a href="?pg=<?php echo ($pg + 1); ?>" class="btn nav_btn pull-right">Next</a>  <?php } ?>
       
    <?php if($pg > 1){ ?>	<a href="?pg=<?php echo ($pg - 1); ?>" class="btn nav_btn">Previous</a>  <?php } ?>
    </div>
   
    </div>
    
   
    
</div>
</section>    
    <script>
	
	
	</script>
    
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
	 
	 
   
		 public function get_files($uid, $lmt, $nom_row){
		 
		 $qry = "SELECT file, date FROM user_files  WHERE uid = ?  ORDER BY date DESC LIMIT $lmt, $nom_row";
		
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $uid, PDO::PARAM_INT);
		 $stmt->execute();
		 return $stmt->fetchAll();
	 }
	 
	 
	 
	 
	
}