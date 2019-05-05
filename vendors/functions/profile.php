<?php
function display_user_profile(){
	if(!profile_exists($_GET['user'])){
		echo "<script>window.location.replace('home.php');</script>";
	}
	if(isset($_POST['fname'])){
		update_user_profile($_POST['fname'], $_POST['lname'], $_POST['email']);
	}
	if(user_owner_of_account($_GET['user'])){
		display_user_profile_edit($_GET['user']);
	}else{
		display_user_profile_view($_GET['user']);
	}
}
function update_user_profile($fname, $lname, $email){
	global $db;
	$user_id = db_get_userId(get_user_cookie_project());
	$query = "update user set fname = '{$fname}', lname='{$lname}', email='{$email}' WHERE id = {$user_id}";
    $stmt = $db->prepare($query);
    $stmt->execute();
}
function user_updated_message(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Profile updated</b>. The changes were applied.</span>
				</div>
		</div>';
}
function user_owner_of_account($user_hash){
	$username = base64_decode($user_hash);
	global $db;
	$user_id = db_get_userId(get_user_cookie_project());
	$query = "SELECT EXISTS(SELECT * from user WHERE id = {$user_id} AND uname='{$username}') AS checkExists";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkExists'] == 1) return true;
    return false;	
}
function profile_exists($user_hash){
	$username = base64_decode($user_hash);
	global $db;
	$user_id = db_get_userId(get_user_cookie_project());
	$query = "SELECT EXISTS(SELECT * from user WHERE uname='{$username}') AS checkExists";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkExists'] == 1) return true;
    return false;	
}
function get_user_cookie_project(){
	return base64_decode($_COOKIE['user']);
}
function display_user_profile_edit($id){
	global $db;
	$user_id = db_get_userId(get_user_cookie_project());
	$username = base64_decode($id);
	$query = "SELECT * from user WHERE id = {$user_id} AND uname='{$username}'";
    $stmt = $db->prepare($query);
    $stmt->execute();
	while ($row = $stmt->fetch()) {
		echo '<div class="card-body">
			<h3 class="card-title" style="font-size:24px;">Profile:</h3>
				<form method="POST" action="./profile.php?user='.$id.'">
				<div class="form-group">
				  <label for="fname">First name</label>
				  <input name="fname" type="text" class="form-control" id="fname" required="" value ='.$row['fname'].'>
				</div>
				<div class="form-group">
				  <label for="lname">Last name</label>
				  <input name="lname" type="text" class="form-control" id="lname" required="" value ='.$row['lname'].'>
				</div>
				<div class="form-group">
				  <label for="email">Email</label>
				  <input name="email" type="email" class="form-control" id="email" required="" value ='.$row['email'].'>
				</div>
				<button type="submit" class="btn btn-success mr-2">Update</button>
			  </form>
			</div>';
	}
}
function display_user_profile_view($id){
	global $db;
	$username = base64_decode($id);
	$query = "SELECT * from user WHERE uname = '{$username}'";
    $stmt = $db->prepare($query);
    $stmt->execute();
	while ($row = $stmt->fetch()) {
		echo '<div class="card-body">
			<h3 class="card-title" style="font-size:24px;">Profile:</h3>
				<form>
				<div class="form-group">
				  <label for="fname">First name</label>
				  <input name="fname" type="text" class="form-control" id="fname" required="" value ='.$row['fname'].' disabled>
				</div>
				<div class="form-group">
				  <label for="lname">Last name</label>
				  <input name="lname" type="text" class="form-control" id="lname" required="" value ='.$row['lname'].' disabled>
				</div>
				<div class="form-group">
				  <label for="email">Email</label>
				  <input name="email" type="email" class="form-control" id="email" required="" value ='.$row['email'].' disabled>
				</div>
			  </form>
			</div>';
	}
	
}
?>