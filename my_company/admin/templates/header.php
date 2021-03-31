
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-log" style=" text-align:left"><a style="width:100%; background-color:#636" href="#" class="brand text-center"><img src="../images/logo.jpg" style="width:95%; max-height:40px; border-radius:9px" /></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="./"> <i class="fa fa-tree"></i> Home</a></li>
            <li><a href="users.php"> <i class=""></i>Users   </a></li>
             <?php if($_SESSION['role'] == 9){ ?>
            <li><a href="managers.php"> <i class=""></i>Admins   </a></li>
              <?php } ?>
              <li><a href="change_password.php"> <i class="fa fa-lock"></i>Change Password </a></li>
              <li style="margin-top:30px;"><a href="../?logout=1"> <i class="fa fa-signout"></i> Logout                            </a></li>
                 </ul>
        </div>
       </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a style="background-color:#006; border-radius:50%; font-size:16px;" id="toggle-btn" href="#" class="menu-btn"><i class=" fa fa-bars"> </i></a><a href="#" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications dropdown-->
                
                
                
                
                   
                <!-- Log out-->
                <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><span class="fa fa-user-o"></span><span class="d-none d-sm-inline-block"><?php echo $_SESSION['email']; ?></span></a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li><a rel="nofollow" href="../?logout=1" class="dropdown-item"> <span class=" fa fa-sign-out"></span> <span>Logout</span></a></li>
                    
                  </ul>
                </li>
          </ul>
            </div>
          </div>
        </nav>
      </header>
    