<?php include 'vendors/functions/auth.php'; user_has_cookie_rederect(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UV | Register</title>
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="media/pictures/logo.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="./vendors/js/register.js"> </script>
  <style>
  .injection-burek{
	border: 1px solid #e5e5e5;
    border-right-color: rgb(229, 229, 229);
    border-right-style: solid;
    border-right-width: 1px;
	border-right-color: rgb(229, 229, 229);
	border-right-style: solid;
	border-right-width: 1px;
	border-radius: 6px 6px 6px 6px;
	padding: 15px;
  }
  </style>
</head>
<body style="background: #5983e8">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
		<div class="col-lg-12 mx-auto">
			<div class="col-lg-6 mx-auto">
			<?php include 'vendors/functions/register.php'; ?>
			</div>
		</div>
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
			            <h2 class="text-center mb-4">Sign Up</h2>
              <form action="signup.php" method="POST" >
			  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <input type="text" class="form-control injection-burek" placeholder="First name" pattern="[A-Za-zčćžđšČĆŽĐŠ]*" name="txt_fname" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <input type="text" class="form-control injection-burek" placeholder="Last name" pattern="[A-Za-zčćžđšČĆŽĐŠ]*" name="txt_lname" required>
                          </div>
                        </div>
                      </div>
                    </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" id="txt_uname" name="txt_uname" pattern="[A-Za-z0-9čćžđšČĆŽĐŠ]*" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline" id="uname_response_true"></i>
						<i class="mdi mdi-close-circle-outline" id="uname_response_false" style="display:none;"></i>
                      </span>
                    </div>
                  </div>
                </div>
				<div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" name="txt_email" id="txt_email" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline" id="email_response_true"></i>
						<i class="mdi mdi-close-circle-outline" id="email_response_false" style="display:none;"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" name="txt_password" id="txt_password" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline" id="password_response_true"></i>
						<i class="mdi mdi-close-circle-outline" id="password_response_false" style="display:none" ></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="txt_confirm_password" id="txt_confirm_password" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline" id="confirm_password_response_true"></i>
						<i class="mdi mdi-close-circle-outline" id="confirm_password_response_false" style="display:none" ></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> I agree to the terms
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Register</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="login.php" class="text-black text-small">Login</a>
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
			<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Avtorja: Nejc Žun, Gregor Černak
		</span>
    </div>
  </footer>
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
</body>

</html>