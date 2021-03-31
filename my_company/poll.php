<?php
session_start();

require_once('connect/config.php');


$page_title = "Vote Now"; // Title of page


$pdo = new mypdo();

if(isset($_POST['ch']) && $_POST['ch'] == 'voting'){
	
	
	if(!isset($_SESSION['uid'])) die(header('Location: ./'));
	$uid = $_SESSION['uid'];

	$poll_id = $_POST['poll_id'];

	$index_m = explode(',', $_POST['index_n']);
	
	$v_allow = $pdo->get_vote_allowed($poll_id);
	
	if(count($index_m) != $v_allow) die("You have $v_allow choices. Please complete vote");	
	
	foreach($index_m as $index_n)
		$rstb = $pdo->vote_now($uid, $poll_id, $index_n);
	die($rstb);
	

}


elseif(isset($_GET['v_id'])){
	
try{
	require 'connect/crypto.php';
	$ref = explode('_', decrypt($_GET['v_id']));
	}catch(Exception $ex){ die(header('Location: ./'));}
//echo decrypt($_GET['v_id'])."___"; die();
$uid = $ref[1];

$_SESSION['uid'] = $uid;
$_SESSION['email'] = $ref[3];

$poll_id = $ref[2];


$user = $pdo->get_user($uid);

$poll = $pdo->get_polls($user['building_id'], $user['occupied'],  $uid, $poll_id);

$p_options = $pdo->get_poll_options($poll_id);

$ch_n = $poll['ch_m'];
$ch_m = array();
if($ch_n != '' && $ch_n != null)
	$ch_m = explode(',', $ch_n);
	
$v_allow  = $poll['v_allow'];

require_once('./templates/header.php');



?>  

   <section style="background-color:#EEE">
    <div class="container main_container" style=" min-height:80vh; padding-top:10px; color:#333; text-align:center; background-color:#FFF;">
   <div style="max-width:800px; display:inline-block; width: 100%;">
    
    <h2>  VOTE </h2>
    
    <?php  
	
		if(strtotime($poll['sdate']) >= time()){ $v_ch = 0; ?>
			
			<div class="alert alert-info"><span class="fa fa-info-circle"></span> Voting has not started. Voting Starts by <?php echo date("M d, Y @ h:i a", strtotime($poll['sdate'])); ?></div>		
		
       <?php }
		elseif(count($ch_m) > 0){ $v_ch = 1; ?>
			
			<div class="alert alert-success"><span class="fa fa-2x fa-check-circle"></span>  Thanks for voting</div>
		
		<?php }
		elseif(strtotime($poll['edate']) <= time()){ $v_ch = 2; ?>
			
			<div class="alert alert-warning"><span class="fa fa-2x fa-warning"></span>  Oop! You missed this poll. Voting has ended</div>		
		
        <?php }
		else{ $v_ch = 3; ?>
			
			<div class="alert alert-primary"><span class="fa fa-2x fa-weight-balance"></span>   Your decision matters. Vote now!</div>		
		<?php }
	
	
	?>
     
     
    
    
    <div class="sg_question">
    	<div class="question_ndate" style="background-color:#555; color:#FFF; border-radius:10px;"><div class="row"><div class="col-6">Start: <span style="color:#CCC"> <?php echo date("M d, Y @ h:i a", strtotime($poll['sdate'])); ?></span></div><div class="col-6">End: <span style="color:#CCC"> <?php echo date("M d, Y @ h:i a", strtotime($poll['edate'])); ?></span></div></div></div>
        <div class="question_nx" style="margin-top:30px;"><?php echo $poll['question']; ?></div>
        
        
        
        <div class="vote_options">
        		<?php foreach($p_options as $p_option){ 
                   if($v_ch == 1 && in_array($p_option['index_n'], $ch_m)){ ?>
                   <div class="active vote_option" data-index="<?php echo $p_option['index_n']; ?>"><div><input checked="checked" type="radio" /></div><div> <?php echo $p_option['option_n']; ?></div></div>
                <?php } else{ ?>
                
                <div class="vote_option" data-index="<?php echo $p_option['index_n']; ?>"><div><input type="radio" /></div><div> <?php echo $p_option['option_n']; ?></div></div>
                
				<?php } }?>
               
        </div>
       
       <div style="padding-bottom:40px;" id="sbutton">
       <?php if($v_ch == 3){ ?> 
        	<button onclick="vote_now()" disabled class="btn " style="background-color:#06F; color:#FFF"> Vote Now </button>
       <?php } ?> 
        </div>
    </div>
    
    
   	
    
    
    </div>
    
   
    
</div>
</section>    
    <script>
		
		 var voting_state_n = <?php echo  $v_ch;?>;
		 var voting_poll_id = <?php echo  $poll_id;?>;
		 var voting_max_count = <?php echo  $v_allow;?>;
		
		 
	</script>
    
   <?php require_once('./templates/footer.php');  ?>

</body>
</html>


<?php
}
else die(header('Location: ./'));

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
	 
	 
   
	  public function get_polls($building_id, $occupied, $uid, $poll_id){
		 
		 $qry = "SELECT a.id, a.question, a.sdate, a.edate, a.v_allow, c.ch_m FROM polls a JOIN building_polls b ON a.id = b.poll_id LEFT JOIN (SELECT poll_id, unit_owner_id, GROUP_CONCAT(ch separator ',') AS ch_m FROM unit_owners_ch GROUP BY poll_id, unit_owner_id) c ON (a.id = c.poll_id AND c.unit_owner_id = ?) WHERE a.id = ? AND (a.occupied = '' OR a.occupied = ?) AND b.building_id = ?";
		
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $uid, PDO::PARAM_INT);
	     $stmt->bindParam(2, $poll_id, PDO::PARAM_INT);
		 $stmt->bindParam(3, $occupied, PDO::PARAM_INT);
		 $stmt->bindParam(4, $building_id, PDO::PARAM_INT);
     	 $stmt->execute();
		 return $stmt->fetch();
	 }
	 
	 public function get_poll_options($poll_id){
		 
		 $qry = "SELECT index_n, option_n FROM poll_options WHERE poll_id = ?";
		
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $poll_id, PDO::PARAM_INT);
     	 $stmt->execute();
		 return $stmt->fetchAll();
	 }
	 
	 public function get_vote_allowed($poll_id){
		 
		 $qry = "SELECT v_allow FROM polls WHERE id = ?";
		
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $poll_id, PDO::PARAM_INT);
     	 $stmt->execute();
		 return $stmt->fetchColumn();
	 }
	 
	 
	 public function get_user($uid){
		 
		 $qry = "SELECT building_id, occupied FROM unit_owners WHERE id = ?";
		
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $uid, PDO::PARAM_INT);
     	 $stmt->execute();
		 return $stmt->fetch();
	 }
	
	
	public function vote_now($uid, $poll_id, $index_n){
		
		$qry = "INSERT INTO unit_owners_ch(unit_owner_id, poll_id, ch)VALUES(?, ?, ?)";
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $uid, PDO::PARAM_INT);
		 $stmt->bindParam(2, $poll_id, PDO::PARAM_INT);
		 $stmt->bindParam(3, $index_n, PDO::PARAM_INT);
     	 $stmt->execute();
		 if($stmt->rowCount() > 0){
			 $this->update_poll_result($poll_id, $index_n);
			 return 'PASS';
		}
		
			return 'Oop! There was an error';
	}
	 
	public function update_poll_result($poll_id, $index_n){
		
		$qry = "UPDATE poll_options SET count_n = count_n + 1 WHERE poll_id = ? AND index_n = ? ";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $poll_id, PDO::PARAM_INT);
		 $stmt->bindParam(2, $index_n, PDO::PARAM_INT);
     	 $stmt->execute();
		 
	}
	 
	 
	
}