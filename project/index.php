<?php 
include '../vendors/functions/auth.php'; 
include '../vendors/functions/menu.php'; 
include '../vendors/functions/project.php';
user_has_valid_cookie_project(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NeuralGantt | Projects</title>
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/magicsearch.css">
  <link rel="stylesheet" href="../css/material-table.css">
  <link rel="shortcut icon" href="../media/pictures/logo.png" />
  <!-- editor -->
  <link rel="stylesheet" href="../media/layout.css">
  <link rel="stylesheet" href="../css/gantt.css">
  <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="../js/gantt.js" type="text/javascript"></script>
  <style>
	.gantt_default_corner  > div:nth-child(4) {
	    background: #F5F5F5!important;
		color: #F5F5F5!important;
		content: 'Burek'!important;
	}
	.profile-name{
		font-family: "Poppins", sans-serif;
	}
</style>
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #5983e8;">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
          <img src="../media/pictures/logo-mini.svg" alt="logo" style="height: 40px;width: 40px;"/><h2 style="color:rgb(74, 74, 74); padding-top:10px;">NeuralGantt</h2>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
		<img src="../media/pictures/logo-mini.svg" alt="logo" style="height: 40px;width: 100%;"/>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item">
            <a href="../home.php" class="nav-link">Home
            </a>
          </li>
          <li class="nav-item active">
            <a href="index.php" class="nav-link">
              <i class="mdi mdi-folder-multiple"></i>My Projects</a>
          </li>
		  <?php 
			display_admin_mod_list_item_projects();
		  ?>
        </ul>
        <?php
			display_user_navbar_project();
		?>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <?php
		display_user_navigation_project();
	  ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
			<?php 
			parent_display_project();
			?>
			
        <div class="clear">
        </div>
		</div>
      <?php include '../vendors/functions/footer.php'; ?>
		</div>
	</div>
  </div>
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <script src="../js/magicsearch.js"></script>
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <script src="../js/dashboard.js"></script>
  <script src="../js/material-table.js"></script>
</body>

</html>
