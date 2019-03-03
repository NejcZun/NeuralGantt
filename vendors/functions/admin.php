<?php
require_once 'db_mysql.php';

function admin_user_display(){
	if(isset($_GET['delete']) or isset($_GET['edit'])){
		if(isset($_GET['edit'])){
			if(db_user_exists_byId($_GET['edit'])){
				
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
				 	<a href="users.php?delete='.$row['id'].'" style="text-decoration:none;"><button type="button" class="btn btn-danger btn-fw" style="min-width:100px;"><i class="mdi mdi-delete"></i>Yes</button>
					<a href="users.php" style="text-decoration:none;"><button type="button" class="btn btn-success btn-fw" style="min-width:100px;"><i class="mdi mdi-back"></i>No</button>
				  </td>
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