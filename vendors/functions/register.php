<?php
if(isset($_POST['txt_fname']) && isset($_POST['txt_lname']) && isset($_POST['txt_uname']) &&
isset($_POST['txt_email']) && isset($_POST['txt_password']) && isset($_POST['txt_confirm_password'])){
	user_register_attempt();
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
							//rederec:
							echo "<script>window.location.replace('login.php');</script>";
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