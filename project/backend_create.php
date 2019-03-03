<?php
require '_db_mysql.php';

$now = (new DateTime("now"))->format('Y-m-d H:i:s');
$ordinal = db_get_max_ordinal(null) + 1;
$user_id_local = db_get_usersId(cookie_get_username());

$stmt = $db->prepare("INSERT INTO task (name, start, end, ordinal, ordinal_priority, user_id, project_id) VALUES (:name, :start, :end, :ordinal, :priority, :user_id, :project_id)");
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(":ordinal", $ordinal);
$stmt->bindParam(":priority", $now);
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
