<?php include 'vendors/functions/auth.php'; user_has_valid_cookie(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UV Projektna Naloga</title>
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="media/pictures/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #5983e8;">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
          <img src="media/pictures/logo-mini.svg" alt="logo" style="height: 40px;width: 40px;"/><h2 style="color:rgb(74, 74, 74); padding-top:10px;">UV Projektna</h2>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
		<img src="media/pictures/logo-mini.svg" alt="logo" style="height: 40px;width: 100%;"/>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item active">
            <a href="index.php" class="nav-link">Home
            </a>
          </li>
          <li class="nav-item">
            <a href="editor" class="nav-link">
              <i class="mdi mdi-folder"></i>Project</a>
          </li>
        </ul>
        <?php include_once 'vendors/functions/menu.php'; 
			display_user_navbar_root();
		?>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
	<!-- sliding dash -->
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="media/pictures/user.png" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">User Name and Surname</p>
                  <div>
                    <small class="designation text-muted">Title</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-television" style="color:#979797"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-folder-open" style="color:#979797"></i>
              <span class="menu-title">My Projects</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-folder"></i>
              <span class="menu-title">Last 4 Projects</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="editor">Project 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="editor">Project 2</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="editor">Project 3</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="editor">Project 4</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-folder-multiple text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">My Projects</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Click here to view your projects
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-multiple text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">Manage users</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Click here to manage users on your projects
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">Neural Networks</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Click here to view neural networks
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-settings text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">Settings</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Click here to view your settings
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
              <a href="https://www.fri.uni-lj.si/sl" target="_blank" style="color:#5983e8;">FRI Ljubljana</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Avtorja: Nejc Žun, Grega Černak
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/dashboard.js"></script>
</body>

</html>
