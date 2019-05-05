<?php
require '_db_mysql.php';
$str = "select * from on_board where user_id = ".$_POST['user_id']." and project_id = ".$_POST['project_id'];
$stmt = $db->prepare($str);
$stmt = $db->prepare($str);
$stmt->execute();
if($stmt->rowCount() === 0){
	$stmt2 = $db->prepare("INSERT INTO on_board (user_id, project_id) VALUES (:user_id, :project_id)");
	$stmt2->bindParam(':user_id', $_POST['user_id']);
	$stmt2->bindParam(':project_id', $_POST['project_id']);
	$stmt2->execute();

	class Result {}

	$response = new Result();
	$response->result = 'OK';
	$response->message = 'Created with id: '.$db->lastInsertId();
	$response->id = $db->lastInsertId();

	header('Content-Type: application/json');
	echo json_encode($response);
}


?>