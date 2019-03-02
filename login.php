<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UV | Login</title>
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body style="background: #5983e8">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
			<h2 class="text-center mb-4">Login</h2>
			<?php include_once 'vendors/functions/auth.php'; 
			user_has_cookie_rederect();
			?>
              <form action="./login.php" method="POST">
			    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend bg-primary border-primary">
                            <span class="input-group-text bg-transparent">
                               <i class="mdi mdi mdi-account text-white"></i>
                            </span>
                        </div>
                        <input type="text" id="formUsername" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="colored-addon2" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend bg-primary">
                            <span class="input-group-text bg-transparent">
                              <i class="mdi mdi-shield-outline text-white"></i>
                            </span>
                        </div>
                        <input id="formPassword" type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="colored-addon1" required>
                    </div>
                </div>
                <div class="form-group">
                  <input id="formSubmit" type="submit" value="Login" class="btn btn-primary submit-btn btn-block">
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" name="remember" class="form-check-input" checked> Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="signup.php" class="text-black text-small">Create new account</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer" style="background:white; border-top: 1px solid white;">
    <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
			<a href="https://www.fri.uni-lj.si/sl" target="_blank" style="color:#5983e8;">FRI Ljubljana</a>. All rights reserved.</span>
			<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Avtorja: Nejc Žun, Grega Černak
		</span>
    </div>
  </footer>
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/login_auth.js"></script>
</body>

</html>