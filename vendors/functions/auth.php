<?php
include_once('db_mysql.php');
if(isset($_POST['username']) && isset($_POST['password'])){
	user_login_attempt();		
}

if(isset($_POST['txt_fname']) && isset($_POST['txt_lname']) && isset($_POST['txt_uname']) &&
isset($_POST['txt_email']) && isset($_POST['txt_password']) && isset($_POST['txt_confirm_password'])){
	user_register_attempt();
}

function get_username(){
	return base64_decode($_COOKIE['user']);
}

function user_login_attempt(){
	if(db_user_exists($_POST['username'])) {
        if(db_user_login($_POST['username'], $_POST['password'])){
            if($_POST['remember']){
                  /* MAYBE LONGER THAN 1 DAY SECURITY, BASE 64 ENCODE MAYBE FROM hmac_hash w/ keyval */
                setcookie('user', base64_encode($_POST['username']), time() + 86400); //echo base64_decode($_COOKIE['user']);
				echo '<script>window.location.replace("home.php");</script>';
            }else{
                setcookie('user', base64_encode($_POST['username']), time() + 3600); // SET FOR 1 hour
				echo '<script>window.location.replace("home.php");</script>';
            }
        }else {
			wrong_username_or_pass();
        }
    }else wrong_username_or_pass();
}

function user_register_attempt(){
	if($_POST['txt_uname'] != ''  && $_POST['txt_fname'] != '' && $_POST['txt_lname'] != '' && $_POST['txt_email'] != ''
	&& $_POST['txt_password'] != '' && $_POST['txt_confirm_password'] != ''){
		if(!db_user_exists($_POST['txt_uname'])){
			if(!db_email_exists($_POST['txt_email'])){
				// regex
				if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $_POST['txt_email'])){
					if($_POST['txt_password'] == $_POST['txt_confirm_password']){
						if(preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/", $_POST['txt_confirm_password'])){
							// $user, $pass, $fname, $lname, $email
							db_user_register($_POST['txt_uname'], $_POST['txt_confirm_password'], $_POST['txt_fname'], 
											$_POST['txt_lname'], $_POST['txt_email']);
						}else{
							// password does not match regex
							alert_password_regex();
						}
					}else{
						// passwords are not the same
						alert_password_matching();
					}
				}
				else{
					// not an email
					alert_email_regex();
				}
			}			
			else{
				// email already exists
				alert_email_exists();
			}
		}
		else{
			// username already exists
			alert_user_exists();
		}
	}
	else{
		// empty form fields
		alert_empty_fields();
	}

}

/* valid cookie on signup.php and login.php*/
function user_has_cookie_rederect(){
	if(isset($_COOKIE['user'])){
		$user=base64_decode($_COOKIE['user']);
		if(db_user_exists($user)){
			echo '<script>window.location.replace("home.php");</script>';
		}else{
			setcookie("user", "", time()-3600);
			echo '<script>window.location.replace("index.php");</script>';
		}
	}else{
	}
}
/* valid cookie on home.php*/
function user_has_valid_cookie(){
	if(isset($_COOKIE['user'])){
		$user=base64_decode($_COOKIE['user']);
		if(!db_user_exists($user)){
			setcookie("user", "", time()-3600);
			echo '<script>window.location.replace("index.php");</script>';
		}
	}else{
		echo '<script>window.location.replace("index.php");</script>';
	}
}
/* valid cookie on index.php*/
function user_has_valid_cookie_index(){
	if(isset($_COOKIE['user'])){
		$user=base64_decode($_COOKIE['user']);
		if(db_user_exists($user)){
			echo '<script>window.location.replace("home.php");</script>';
		}else{
			setcookie("user", "", time()-3600);
		}
	}
}
function check_if_user_mod_or_above(){
	if(db_get_userRoleName(get_username()) == 'admin' or db_get_userRoleName(get_username()) == 'manager')return true;
	else return false;
}
/* valid cookie anywhere in /project*/
function user_has_valid_cookie_project(){
	if(isset($_COOKIE['user'])){
		$user=base64_decode($_COOKIE['user']);
		if(!db_user_exists($user)){
			setcookie("user", "", time()-3600);
			echo '<script>window.location.replace("../index.php");</script>';
		}
	}else{
		echo '<script>window.location.replace("../index.php");</script>';
	}
}
function user_has_valid_cookie_project_create(){
	if(isset($_COOKIE['user'])){
		$user=base64_decode($_COOKIE['user']);
		if(!db_user_exists($user)){
			setcookie("user", "", time()-3600);
			echo '<script>window.location.replace("../index.php");</script>';
		}else{
			if(!check_if_user_mod_or_above())echo '<script>window.location.replace("index.php");</script>';
		}
	}else{
		echo '<script>window.location.replace("../index.php");</script>';
	}
}
/* check if user has valid cookie and admin role /admin/ */
function user_has_valid_cookie_admin(){
	if(isset($_COOKIE['user'])){
		$user=base64_decode($_COOKIE['user']);
		if(!db_user_exists($user)){
			setcookie("user", "", time()-3600);
			echo '<script>window.location.replace("../index.php");</script>';
		}else{ /*valid cookie*/
			if(!check_if_user_admin()){ /*checks if user admin */
				echo '<script>window.location.replace("../home.php");</script>';
			}
		}
	}else{
		echo '<script>window.location.replace("../index.php");</script>';
	}
}



/* login error* */
function wrong_username_or_pass(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b> Wrong username or password.</span>
				</div>
		</div>';
}

/* register errors */
function alert_empty_fields(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b> You have not entered any data.</span>
				</div>
		</div>';
}

function alert_user_exists(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b>Username already in use.</span>
				</div>
		</div>';
}

function alert_email_exists(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b>Email already in use.</span>
				</div>
		</div>';
}

function alert_password_matching(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b>Passwords are not matching.</span>
				</div>
		</div>';
}

function alert_password_regex(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b>Password must contain atleast one number.</span>
				</div>
		</div>';
}

function alert_email_regex(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Error - </b>Entered value is not an email.</span>
				</div>
		</div>';
}
?>