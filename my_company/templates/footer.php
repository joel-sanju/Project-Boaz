
    
    <!-- Modal -->
    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body" style="color:#555">
            <div class="row">
              <div class="col-12">
                <button onclick="$('pledgeModal').modal('hide')" style="cursor:pointer" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <small>CLOSE </small><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="mb-4">Comfirmation</h4>  
                  <p> Do you want to perform this operation?.</p>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <input style="max-width:150px" type="button" onclick="submit_action(0, '')" class="btn btn-primary btn-lg btn-block fa fa-heart-o" value="Yes">
                    </div>
                  </div>
			
               </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <!-- END Modal -->
   
    <!-- Modal -->
    <div class="modal fade" id="confModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body" style="color:#555">
            <div class="row">
              <div class="col-12">
                <button onclick="$('pledgeModal').modal('hide')" style="cursor:pointer" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <small>CLOSE </small><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="mb-4">Comfirmation</h4>  
                  <p> Do you want to perform this operation?.</p>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <input id="confButton" style="max-width:150px" type="button" onclick="" class="btn btn-danger  btn-block btn-sm" value="Yes">
                    </div>
                  </div>
			
               </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <!-- END Modal -->
   
    

    

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="<?php echo glob_site_url; ?>/js/jquery.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/popper.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/bootstrap.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/jquery.easing.1.3.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/jquery.waypoints.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/owl.carousel.min.js?version=<?php echo glob_version; ?>"></script>
    <script src="<?php echo glob_site_url; ?>/js/magnificent_popup.js?version=<?php echo glob_version; ?>"></script>
    
    <script src="<?php echo glob_site_url; ?>/js/moment.js?version=<?php echo glob_version; ?>"></script>
	 
    <script  src="<?php echo glob_site_url; ?>/js/main.js?version=<?php echo glob_version; ?>"></script>
     <script charset="utf-8" src="<?php echo glob_site_url; ?>/js/my_main.js?version=<?php echo glob_version; ?>"></script>
