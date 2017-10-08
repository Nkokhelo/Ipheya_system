<?php
require_once('_db.php');

$stmt = $pdo->prepare("DELETE from task WHERE task_id = :id");
$stmt->bindParam(':id', $_POST['task_id']);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';

header('Content-Type: application/json');
echo json_encode($response);

?>
