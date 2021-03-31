<?php 
session_start();
   //date_default_timezone_set("Africa/Lagos");
      if(!isset($_SESSION['admina'])) die(header("Location: ./"));



require '../connect/config.php';
$pdo =  new mypdo();

 ?> 




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> ADMIN | Change Password</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css?version=<?php echo glob_version; ?>">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css?version=<?php echo glob_version; ?>">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css?version=<?php echo glob_version; ?>">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css?version=<?php echo glob_version; ?>">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css?version=<?php echo glob_version; ?>">
    
    <link rel="stylesheet" href="css/magnific-popup.css?version=<?php echo glob_version; ?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?version=<?php echo glob_version; ?>"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?version=<?php echo glob_version; ?>"></script><![endif]-->
  
  <style>
  .button_active{display:inline-block; min-width:100px;  border:3px outset #0F0; border-radius:20px; box-shadow:4px 4px 4px #6FF; padding:10px; margin:20px;  background-color:#06F; color:#FFF; font-weight:bold}
  
  .button_active:hover, .button_active:focus{ background-color:#006; border-color:#FFF;}
  
   .button_inactive{display:inline-block; min-width:100px;  border:3px outset #FFF; border-radius:20px; box-shadow:4px 4px 4px #6FF; padding:10px; margin:20px;  background-color:#CCC; color:#FFF; font-weight:bold}  
.edit_n{margin:3px; border-right:2px solid#CCC; padding-right:20px; color:#06F; font-weight:bolder; cursor:pointer}
.delete_n{margin:3px; padding-right:20px; color:#F60; font-weight:bolder; cursor:pointer}
  
  </style>
  
  
  </head>
  <body>
    
    <?php  require("templates/header.php"); ?>  
    
       <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">ADMIN</a></li>
            <li class="breadcrumb-item active"> Change Password     </li>
          </ul>
        </div>
      </div>
      
      
   <!-- Item Section -->
     <section>
     <div class="container-fluid">
     <div class="card">
     <div class="card-body p-0">
                                        <div class="table-responsive">
                                        
                                        
                                        
                                    <div class="modal-body pf_password">
            <div class="row">
              <div class="col-12">
                 
                <form action="#" id="password_form" onSubmit="update_password(event, 'password')" method="post">
                 <div class="errmsg" style=" margin: 20px;"></div>
                  
                  <div class="row" style="max-width:400px;">
                    <div class="col-12 form-group">
                      <label for="m_password">Enter Old Password </label>
                      <input type="password" required minlength="6" maxlength="50" class="form-control" id="m_password" name="m_password">
                    </div>
                    <div class="col-12 form-group">
                      <label for="m_password">New Password </label>
                      <input type="password" required minlength="6" maxlength="50" class="form-control" id="m_password" name="m_password_1">
                    </div>
                    <div class="col-12 form-group">
                      <label for="m_password">Retype New Password </label>
                      <input type="password" required minlength="6" maxlength="50" class="form-control" id="m_password" name="m_password_2">
                    </div>
                  </div>
                  
                  <div class="row"  style="max-width:400px; padding:40px 10px;">
                    <input type="hidden" name="password" value="sup">
                    <div class="col-md-12 text-center msbutton">
                      <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
            
          </div>
          
              
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                        </div>
                                    </div>
                                </div>
      
      </div>         
     </section>
  
  
  
  
  
              
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>&copy;  <?php echo glob_site_name; ?></p>
            </div>
            <div class="col-sm-6 text-right">
              <p> <span class="fa fa-star"></span> <a href="" class="external"><small>ADMIN</small></a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
    
    
    <!--  Modal  ALert -->
<div class="modal" id="modal_alert">
  <div class="modal-dialog">
    <div class="modal-content">
    <div style="text-align:right"> <button type="button" class="close" data-dismiss="modal">&times;</button></div>
 <!-- Modal body -->
      <div class="modal-body" style="font-size:14px;">
        Modal body..
      </div>
 <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

             <!-- Modal-->
                  <div id="modal_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-center">
                    <div role="document" class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">  </h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <form id="cform" onSubmit="perform_operation(event)">
                        <div class="modal-body">
                          <p id="errormsg" style="font-size:12px; color:#F00">&nbsp;</p>
                            <div class="form-group">
                              <label>Select an Action</label>
                              <select id="option_op" placeholder="Item name" required class="form-control"></select>
                            </div>
                               
                        </div>
                        <div class="modal-footer" id="sbutton">
                          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                          <button type="submit" id="sbtn" class="btn btn-primary">Add Item</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
    
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="vendor/popper.js/umd/popper.min.js?version=<?php echo glob_version; ?>"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js?version=<?php echo glob_version; ?>"> </script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js?version=<?php echo glob_version; ?>"></script>
    <!-- Main File-->
    <script src="js/front.js?version=<?php echo glob_version; ?>"></script>
    <script src="js/magnificent_popup.js?version=<?php echo glob_version; ?>"></script>
     <script src="js/admin.js?version=<?php echo glob_version; ?>"></script>
  
 
  </body>
</html>


<?php 




function get_time_ago( $time ) { $time_difference = time() - $time; if( $time_difference < 1 ) { return 'less than 1 second ago'; } $condition = array( 12 * 30 * 24 * 60 * 60 => 'year', 30 * 24 * 60 * 60 => 'month', 24 * 60 * 60 => 'day', 60 * 60 => 'hour', 60 => 'minute', 1 => 'second' ); foreach( $condition as $secs => $str ) { $d = $time_difference / $secs; if( $d >= 1 ) { $t = round( $d ); return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago'; } } }





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
	 
	  public function get_admin(){
		 try{
		  $qry = "SELECT id, email, fname, level FROM admins ORDER BY id DESC";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->execute();
		  return $stmt->fetchAll();
	 }
	 
	 catch(Exception $e){
		 return [];
		 }
     
	 }

	 
	 }
 		

