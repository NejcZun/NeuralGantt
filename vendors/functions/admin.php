<?php
require_once 'db_mysql.php';

function admin_user_display(){
	/*on completed action as edit or delete */
	if(isset($_POST['delete']) or isset($_POST['edit'])){
		if(isset($_POST['delete'])){
			delete_user($_POST['delete']);
		}else{
			edit_user($_POST['edit']);
		}
	}
	
	
	if(isset($_GET['delete']) or isset($_GET['edit'])){
		if(isset($_GET['edit'])){
			if(db_user_exists_byId($_GET['edit'])){
				display_users_admin_edit($_GET['edit']);
			}else{
				echo '<script>window.location.replace("users.php");</script>';
			}
		}else{
			if(db_user_exists_byId($_GET['delete'])){
				display_delete_card();
				display_users_admin_delete($_GET['delete']);
			}else{
				echo '<script>window.location.replace("users.php");</script>';
			}
		}			
	}else{
		display_users_admin();
	}
}

function display_users_admin_edit($id){
	global $db;
	$str = "SELECT u.id, u.uname, u.fname, u.lname, u.email, r.rolename, r.role_id from user u join role r on r.role_id = u.role_id where u.id={$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1">
			  <table id="table" class="table table-hover table-mc-light-blue table-big-boy">
				<thead>
					<tr>
						<th>Name</th>
						<th>Surname</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
			<form method="POST" action="users.php">
				 <td data-title="Name" style="vertical-align:middle;"><input type="text" value="'.$row['fname'].'" name="fname" class="form-control"/></td>
				 <td data-title="Surname" style="vertical-align:middle;"><input type="text" value="'.$row['lname'].'" name="lname" class="form-control"/></td>
				 <td data-title="Username" style="vertical-align:middle;"><input type="text" value="'.$row['uname'].'" name="uname" class="form-control"/></td>
				 <td data-title="Email" style="vertical-align:middle;"><input type="text" value="'.$row['email'].'" name="email" class="form-control"/></td>
				 <td data-title="Role" style="vertical-align:middle;">';
				 if($row['rolename']=='admin')display_active_select_admin();
				 else if($row['rolename']=='manager')display_active_select_manager();
				 else display_active_select_user(); 
				 echo '</td>
				 <td data-title="Action" class="material-table-td-action">
				 	<button type="submit" class="btn btn-success btn-fw" style="min-width:100px;" name="edit" value="'.$row['id'].'"><i class="mdi mdi-update"></i>Update</button>
					<a href="users.php" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-fw" style="min-width:100px;"><i class="mdi mdi-back"></i>Back</button>
				</td></form>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
	
}

function display_active_select_admin(){
	echo '<select name="rolename" class="form-control">
			<option value="1" selected> Admin </option>
			<option value="2"> Manager </option>
			<option value="3"> User </option>
		  </select>';
}
function display_active_select_manager(){
	echo '<select name="rolename" class="form-control">
			<option value="1"> Admin </option>
			<option value="2" selected> Manager </option>
			<option value="3"> User </option>
		  </select>';
}
function display_active_select_user(){
	echo '<select name="rolename" class="form-control">
			<option value="1"> Admin </option>
			<option value="2"> Manager </option>
			<option value="3" selected> User </option>
		  </select>';
}

function edit_user($id){
	global $db;
	$str = "UPDATE user SET fname = :fname, lname = :lname, uname = :uname, email = :email, role_id = :role WHERE id = :id";
    $stmt = $db->prepare($str);
	$stmt->bindParam(":id", $id);
    $stmt->bindParam(":fname", $_POST['fname']);
	$stmt->bindParam(":lname", $_POST['lname']);
	$stmt->bindParam(":uname", $_POST['uname']);
	$stmt->bindParam(":email", $_POST['email']);
	$stmt->bindParam(":role", $_POST['rolename']);
    $stmt->execute();
	
}


function delete_user($id){
	global $db;
	
	/*deletes from links */
	$stmt = $db->prepare("DELETE FROM link WHERE user_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	/*deletes all tasks from deleted projects */
	$str = "SELECT project_id from project where user_id = :id";
    $stmt = $db->prepare($str);
	$stmt->bindParam(':id', $id);
    $stmt->execute();
	while ($row = $stmt->fetch()) {
		$delete = $db->prepare("DELETE FROM link WHERE project_id = :project_id");
		$delete->bindParam(':project_id', $row['project_id']);
		$delete->execute();
		
		$delete2 = $db->prepare("DELETE FROM on_board WHERE project_id = :project_id");
		$delete2->bindParam(':project_id', $row['project_id']);
		$delete2->execute();
		
		$delete3 = $db->prepare("DELETE FROM task WHERE project_id = :project_id");
		$delete3->bindParam(':project_id', $row['project_id']);
		$delete3->execute();
	}
	/* deletes from tasks */
	
	$stmt = $db->prepare("DELETE FROM task WHERE user_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	/*deletes all projects */
	
	$stmt = $db->prepare("DELETE FROM project WHERE user_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	/*deletes from on_board */
	
	$stmt = $db->prepare("DELETE FROM on_board WHERE user_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	
	/*deletes from users */
	$stmt = $db->prepare("DELETE FROM user WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
}

function display_users_admin(){
    global $db;
	$str = "SELECT u.id, u.uname, u.fname, u.lname, u.email, r.rolename from user u join role r on r.role_id = u.role_id";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Name</th>
						<th>Surname</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				 <td data-title="Name" style="vertical-align:middle;">'.$row['fname'].'</td>
				 <td data-title="Surname" style="vertical-align:middle;">'.$row['lname'].'</td>
				 <td data-title="Username" style="vertical-align:middle;">'.$row['uname'].'</td>
				 <td data-title="Email" style="vertical-align:middle;">'.$row['email'].'</td>
				 <td data-title="Role" style="vertical-align:middle;">'.ucfirst($row['rolename']).'</td>
				 <td data-title="Action" class="material-table-td-action">
					<a href="users.php?edit='.$row['id'].'" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-fw" style="min-width:100px;"><i class="mdi mdi-pencil"></i>Edit</button>
					<a href="users.php?delete='.$row['id'].'" style="text-decoration:none;"><button type="button" class="btn btn-danger btn-fw" style="min-width:100px;"><i class="mdi mdi-delete"></i>Delete</button>
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function display_users_admin_delete($id){
    global $db;
	$str = "SELECT u.id, u.uname, u.fname, u.lname, u.email, r.rolename from user u join role r on r.role_id = u.role_id where u.id={$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Name</th>
						<th>Surname</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Delete?</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				 <td data-title="Name" style="vertical-align:middle;">'.$row['fname'].'</td>
				 <td data-title="Surname" style="vertical-align:middle;">'.$row['lname'].'</td>
				 <td data-title="Username" style="vertical-align:middle;">'.$row['uname'].'</td>
				 <td data-title="Email" style="vertical-align:middle;">'.$row['email'].'</td>
				 <td data-title="Role" style="vertical-align:middle;">'.ucfirst($row['rolename']).'</td>
				 <td data-title="Action" class="material-table-td-action">
				 <form method="POST" action="users.php">
				 	<button type="submit" class="btn btn-danger btn-fw" style="min-width:100px;" name="delete" value="'.$row['id'].'"><i class="mdi mdi-delete"></i>Yes</button>
					<a href="users.php" style="text-decoration:none;"><button type="button" class="btn btn-success btn-fw" style="min-width:100px;"><i class="mdi mdi-back"></i>No</button>
				  </form></td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function display_delete_card(){
	echo '<div class="col-md-6 d-flex align-items-stretch grid-margin" style="margin:auto; margin-bottom: 40px;">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title" style="font-size:24px;">Warning:</h3>
					  <p>By deleting this user you are also deleting all his contribution (projects created, tasks and links made)</p>
					  <p>Are you sure you want to continue?</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
	
}
?>