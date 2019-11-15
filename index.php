<?php session_start(); ?>
<?php include 'vendors/functions/auth.php'; user_has_valid_cookie_index(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NeuralGantt | Main</title>
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="media/pictures/logo.png" />
</head>
<body>
	<div class="row responsive-web-view">
			<div class="col-lg-6 home-page-left-box">
			<ul>
				<li><i class="mdi mdi-chart-line mr-1" aria-hidden="true"></i><span>A new inovative way to track projects!</span></li>
				<li><i class="mdi mdi-clock-fast mr-1" aria-hidden="true"></i><span>Fast and responsive.</span></li>
				<li><i class="mdi mdi-account-multiple mr-1" aria-hidden="true"></i><span>User friendly.</span></li>
			</ul>
			</div>
			<div class="col-lg-6 home-page-right-box">
				<div class="home-page-card">
					<div class="home-page-head">
						<img class="logo-icon" src="media/pictures/logo-mini.svg"/>
						<a href="login.php"><button class="home-page-button outline">Log in</button></a>
					</div>
					<h1>Start making contributions to projects today!</h1>
					<p>Join right now.</p>
					<a href="signup.php"><button class="home-page-button primary block">Sign up</button></a>
					<a href="login.php"><button class="home-page-button outline block">Log in</button></a>
				</div>
			</div>
	</div>
    <div class="row responsive-phone-view" style="display:none;">
		<div class="col-lg-6 home-page-right-box">
				<div class="home-page-card">
					<div class="home-page-head">
						<img class="logo-icon" src="media/pictures/logo-mini.svg"/>
						<a href="login.php"><button class="home-page-button outline">Log in</button></a>
					</div>
					<h1>Start making contributions to projects today!</h1>
					<p>Join right now.</p>
					<a href="signup.php"><button class="home-page-button primary block">Sign up</button></a>
					<a href="login.php"><button class="home-page-button outline block">Log in</button></a>
				</div>
			</div>
		<div class="col-lg-6 home-page-left-box">
			<div class="home-page-center">
				<ul>
					<li><i class="mdi mdi-chart-line mr-1" aria-hidden="true"></i><span>A new inovative way to track projects!</span></li>
					<li><i class="mdi mdi-clock-fast mr-1" aria-hidden="true"></i><span>Fast and responsive.</span></li>
					<li><i class="mdi mdi-account-multiple mr-1" aria-hidden="true"></i><span>User friendly.</span></li>
				</ul>
			</div>
		</div>
	</div>
	<?php include 'vendors/functions/footer.php'; ?>
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
</body>

</html>