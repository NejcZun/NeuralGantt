<?php
require_once '_db_mysql.php';
$user_id_local = db_get_usersId(cookie_get_username());
$stmt = $db->prepare("INSERT INTO link (from_id, to_id, type, user_id, project_id) VALUES (:from, :to, :type, :user_id, :project_id)");
$stmt->bindParam(':from', $_POST['from']);
$stmt->bindParam(':to', $_POST['to']);
$stmt->bindParam(':type', $_POST['type']);
$stmt->bindParam(":user_id", $user_id_local);
$stmt->bindParam(":project_id", $_GET['id']);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();
$response->id = $db->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);

?>
