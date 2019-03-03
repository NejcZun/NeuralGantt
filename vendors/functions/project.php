<?php
require_once 'db_mysql.php';

function get_user_id_project(){
	return base64_decode($_COOKIE['user']);
}
function add_project($project_name, $project_end){
	global $db;
	$project_start = (new DateTime("now"))->format('Y-m-d H:i:s');
	$project_end = $project_end. ' 00:00:00';
	$user_id = db_get_userId(get_user_id_project());
	$projects = array(array('user_id' => $user_id,
                        'project_name' => $project_name,
						'start' =>$project_start,
						'end' => $project_end)
                );

    $insert = "INSERT INTO project(user_id, project_name, start, end) VALUES (:user_id, :project_name, :project_start, :project_end)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':project_name', $project_name);
	$stmt->bindParam(':project_start', $project_start);
	$stmt->bindParam(':project_end', $project_end);
    foreach ($projects as $m) {
      $user_id = $m['user_id'];
      $project_name = $m['project_name'];
	  $project_start = $m['start'];
	  $project_end = $m['end'];
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