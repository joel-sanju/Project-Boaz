<?php 
session_start();
   //date_default_timezone_set("Africa/Lagos");
      if(!isset($_SESSION['admina'])) die(header("Location: ./"));

$uid = $_SESSION['admina'];
require '../connect/config.php';	


 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Users</title>
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
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/custom.css?version=<?php echo glob_version; ?>">
    <link rel="stylesheet" href="css/select2.min.css?version=<?php echo glob_version; ?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    
    
    
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="css/dataTables.fontAwesome.css" />
    

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?version=<?php echo glob_version; ?>"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?version=<?php echo glob_version; ?>"></script><![endif]-->
  
  <style>
  .sch {padding::1px !important;}
  .sch input{height:33px; max-width:100px !important;}
  .sch_sel select{height:33px; max-width:130px !important;}
  .my_table{ border-collapse:collapse; border:#999 1px solid;}
	.my_table td{ border:#CCC thin solid; font-size:14px; padding:1px;}
	.my_table td img{ max-height:50px}
	div.DTE_Inline select{
      border: 1px solid #09F;
	  background-color:transparent;
	  height:34px;
	  padding:: 0 !important;
	  font-size:90%;
	  margin: -6px 0;
	  padding: 5px 4px;
	  width: 100%;
	  box-sizing: border-box;
	  
		}
	
	.dt-button.buttons-columnVisibility.active{background:#0C0 !important; background-color:#0C0 !important; }
	.editor_remove{background-color:#B72515; color:#FFF; padding:3px; border-radius:3px; font-size:12px; font-weight:bold;}
	
	
	 #modal_file table td a { font-weight:bold; color: #06F; font-size:16px;}
	 #modal_file table td button { color:#F00; background-color:#FFF; font-size:12px; padding:4px;}
	
	.has_file button{ background-color:#F0F0F0 border-radius:4px;}
	.has_file button.not_empty{ background-color:#0F6;}

  </style>
  
  
  </head>
  <body>
    
    <?php  require("templates/header.php"); ?>  
    
       <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ul>
        </div>
      </div>
      
      
   <!-- Item Section -->
     <section>
     <div class="container-fluid" style="">
     
     
     <div class="table-responsive">
          <table id="myTable" class="my_table table table-hover" style="width:100%">
        <thead>
             <tr>
            	<th> #</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Phone</th>
                <th>Files</th>
             </tr>

             <tr>
            	<th class=""></th>
                <th class="sch"></th>
                <th class="sch"></th>
                <th class="sch"></th>
                <th></th>
                
             </tr>
             
             
        </thead>
        
        </table>
       
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
   
   
  
  <div class="modal" id="modal_file">
	<form action="" target="_blank" id="uploadform" onsubmit="uploadform(event)">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
    	<h4>Invoice / Files for this User </h4>
        <div style="text-align:right"> <button  data-dismiss="modal" type="button" class="close">&times;</button></div>
        
      </div>
 <!-- Modal body -->
      <div class="modal-body" style="font-size:14px;">
         
         <div class="table-responsive">
         	<table class="table table-bordered">
            	<tbody>
            	<tr id="file_"><td><a></a></td><td><button class="fa fa-times" type="button"></button></td></tr>
            	</tbody>
            </table>
         		
         </div>
         
        <div class="" style="border-bottom:1px #333 solid; margin-bottom:10px; max-width:500px;">
        	
             <div class="form-group">
                <label style="font-weight:600">Select file</label>
                <input  name="file" id="file_m_n"  onChange="render_filename()" required type="file" class="form-control">
                <input type="hidden" id="row_id" name="row_id" />
             </div>
             <div class="form-group">
                <label style="font-weight:600">File Name</label>
                <input required name="filename"  id="filename" class="form-control">
             </div>
             
        </div>
      </div>
 <!-- Modal footer -->
      <div class="modal-footer" id="fsbutton">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" style="font-weight:bold" type="submit">Add New File</button>
      </div>

    </div>
  </div>
  </form>
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

    
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="vendor/popper.js/umd/popper.min.js?version=<?php echo glob_version; ?>"> </script>
    
    <!-- Main File-->
   
    <script> 
	
    </script>
     
     <script src="js/datatables.min.js?version=<?php echo glob_version; ?>"></script>
	<script src="js/dataTables.editor.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="js/dataTables.buttons.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="js/buttons.html5.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="js/buttons.colVis.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="js/moment.min.js?version=<?php echo glob_version; ?>"></script>
    
     <script src="js/papaparse.min.js?version=<?php echo glob_site_version; ?>"></script>    
<script src="js/buttons.print.min.js?version=<?php echo glob_site_version; ?>"></script>
<script src="js/jszip.min.js?version=<?php echo glob_site_version; ?>"></script>
<script src="js/pdfmake.min.js?version=<?php echo glob_site_version; ?>"></script>
<script src="js/vfs_fonts.js?version=<?php echo glob_site_version; ?>"></script>

    
	 <script src="js/magnificent_popup.js?version=<?php echo glob_version; ?>"></script>
	<script src="js/main.js?version=<?php echo glob_version; ?>"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js?version=<?php echo glob_version; ?>"></script>
	<script src="js/users.js?version=<?php echo glob_version; ?>"></script>
    
      <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js?version=<?php echo glob_version; ?>"></script>
     <script src="js/front.js?version=<?php echo glob_version; ?>"></script>
       
  </body>
</html>


