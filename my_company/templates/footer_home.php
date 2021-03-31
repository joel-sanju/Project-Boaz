<footer class="ftco-footer ftco-bg-dark ftco-section" style="background-color:#000; margin:0px !important">
      <div class="container">
      	<div class="ftco-animate foot_nav">
        	<a href="#" style="text-transform: uppercase"><i>get reliable and accurate results in a timely manner</i></a>
            <?php if(!(isset($_SESSION['uid']) || isset($_SESSION['admina']))){ ?>
            <a href="<?php echo glob_site_url; ?>/login.php">log in</a>
            <?php } ?>
        </div>
        
      </div>
    </footer>

   
    

    

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="<?php echo glob_site_url; ?>/js/jquery.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/popper.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/bootstrap.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/jquery.waypoints.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/owl.carousel.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/magnificent_popup.js?version=<?php echo glob_version; ?>"></script>
    
	<script src="<?php echo glob_site_url; ?>/js/bootstrap-datetimepicker.js?version=<?php echo glob_version; ?>"></script>
    
    <script src="<?php echo glob_site_url; ?>/js/main.js?version=<?php echo glob_version; ?>"></script>
     <script src="<?php echo glob_site_url; ?>/js/my_main.js?version=<?php echo glob_version; ?>"></script>
