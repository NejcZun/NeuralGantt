<?php
require_once '_db_mysql.php';

$stmt = $db->prepare("DELETE from task WHERE id = :id");
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';

header('Content-Type: application/json');
echo json_encode($response);

?>
