<?php 
@session_start();  

header("Content-Type: text/html; charset=UTF-8");

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- 
    More Templates Visit ==> Free-Template.co
    -->
    <?php 
	      
		  $event_image  =  glob_site_url."/images/banner.jpg";
			$script_name = basename($_SERVER['PHP_SELF']);
			
	?>
    
    <title><?php echo glob_site_name; ?> | <?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="theme-color" content="#06F"/>
    <meta name="msapplication-TileColor" content="#06F" />
    <link rel="shortcut icon"  href="./images/favicon.ico"/>
    
   <meta name="description" content="" />
    <meta name="keywords" content="Poll, <?php echo glob_site_name; ?>, <?php echo $page_title; ?>" />
    <meta name="author" content="<?php echo glob_site_name; ?>" />
    <?php 
	
			$event_image  =  glob_site_url."/images/banner.jpg";
	?>
    	
        <meta property="og:url" content="<?php echo glob_site_url; ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="<?php echo glob_site_name; ?> | <?php echo $page_title; ?>"/>
        <meta property="og:description" content=""/>
        <meta property="og:image" content="<?php echo $event_image; ?>"/>
           
        
    
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo glob_site_url; ?>/css/bootstrap.min.css?version=<?php echo glob_version; ?>">
    
    <link rel="stylesheet" href="<?php echo glob_site_url; ?>/css/owl.carousel.min.css?version=<?php echo glob_version; ?>">
    <link rel="stylesheet" href="<?php echo glob_site_url; ?>/css/owl.theme.default.min.css?version=<?php echo glob_version; ?>">
    
    
    

    <link rel="stylesheet" href="<?php echo glob_site_url; ?>/css/font-awesome.min.css?version=<?php echo glob_version; ?>">
    <link rel="stylesheet" href="<?php echo glob_site_url; ?>/css/style.css?version=<?php echo glob_version; ?>">
    <link rel="stylesheet" href="<?php echo glob_site_url; ?>/css/magnific-popup.min.css?version=<?php echo glob_version; ?>">
    <link rel="stylesheet" href="<?php echo glob_site_url; ?>/css/custom.css?version=<?php echo glob_version; ?>">
   </head>
  <body data-spy="scroll" data-target="#ftco-navbar" data-offset="200" dir="">
    
    
    <nav class="my_nav" id="my_nav">
    	<div class="has_logo">
        	<a href="<?php echo glob_site_url; ?>"><img src="<?php echo glob_site_url; ?>/images/logo.jpg"></a>
        </div> 
        
        <div class="nav_menu">
           <?php if(isset($_SESSION['uid'])){ ?>
            <div class="coln">
            	<a href="<?php echo glob_site_url; ?>/home"><span class="hd_sm">Home</span></a>
            </div>
            <div class="coln">
            	<a href="<?php echo glob_site_url; ?>/profile"><span class="hd_sm">Profile</span></a>
            </div>
	<?php }elseif(isset($_SESSION['admina'])){ ?>
			<div class="coln">
            	<a href="<?php echo glob_site_url; ?>/admin"><span class="hd_sm">Home</span></a>
            </div>
    
    <?php }else{ ?>
    		<div class="coln">
            	<a href="<?php echo glob_site_url; ?>"><span class="hd_sm">Login</span></a>
            </div>
            <div class="coln">
            	<a href="<?php echo glob_site_url; ?>/signup.php"><span class="hd_sm">Signup</span></a>
            </div>
    <?php } ?>
      
      </div>
      
    </nav>
    <!-- END nav -->

   
   
 