<?php session_start();  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- 
    More Templates Visit ==> Free-Template.co
    -->
    <title><?php echo glob_site_name; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#06F"/>
    <meta name="msapplication-TileColor" content="#06F" />
    <link rel="shortcut icon"  href="./images/favicon.ico"/>
    
    <meta name="description" content="Your Opinion count in where you leave. Participate in poll. It is all about your decision" />
    <meta name="keywords" content="Poll, <?php echo glob_site_name; ?>, building, opinion, our decision" />
    <meta name="author" content="<?php echo glob_site_name; ?>" />
    <?php 
	
			$event_image  =  glob_site_url."/images/banner.jpg";
	?>
    	
        <meta property="og:url" content="<?php echo glob_site_url; ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="<?php echo glob_site_name; ?>"/>
        <meta property="og:description" content="Your Opinion count in where you leave. Participate in poll. It is all about your decision"/>
        <meta property="og:image" content="<?php echo $event_image; ?>"/>
    
    
    
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    
    
    
    

    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
   
   
   </head>
  <body data-spy="scroll" data-target="#ftco-navbar" data-offset="200">
    
    
    <nav class="my_nav" id="my_nav">
    	<div class="has_logo">
        	<a href="<?php echo glob_site_url; ?>"><img src="<?php echo glob_site_url; ?>/images/logo.jpg"></a>
        </div> 
        
        <div class="nav_menu">
            <div class="coln">
            	<a href="http://www.torontominutes.com/contact/"><span class="hd_sm">Contact Us</span></a>
            </div>
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
            	<a href="<?php echo glob_site_url; ?>/login.php"><span class="hd_sm">Login</span></a>
            </div>
    <?php } ?>
      
      </div>
      
    </nav>
    <!-- END nav -->
    
   
 <div class="slick_main">
   
    <section class="ftco-cover" style="background-image: linear-gradient(to bottom, rgba(2, 2, 2, 0.1), rgba(2, 2, 2, 0.1)), url(./images/banner.jpg); background-size: contain; background-repeat:no-repeat; background-position:center;" id="section-home">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">
          
            
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
    
    <!-- END section -->
    
    
</div>