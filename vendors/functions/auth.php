<?php
include_once('db_mysql.php');
if(isset($_POST['username']) && isset($_POST['password'])){
	user_login_attempt();		
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
?>