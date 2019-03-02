<?php
require_once 'db_mysql.php';

function get_user_id_project(){
	return base64_decode($_COOKIE['user']);
}
function add_project($project_name){
	global $db;
	$user_id = db_get_userId(get_user_id_project());
	$projects = array(array('user_id' => $user_id,
                        'project_name' => $project_name)
                );

    $insert = "INSERT INTO project(user_id, project_name) VALUES (:user_id, :project_name)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':project_name', $project_name);

    foreach ($projects as $m) {
      $user_id = $m['user_id'];
      $project_name = $m['project_name'];
      $stmt->execute();
    }
	project_created_message();
}
function project_created_message(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Project created - </b> View your projects <a href="index.php">here</a>.</span>
				</div>
		</div>';
}

?>