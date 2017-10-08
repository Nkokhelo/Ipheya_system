<?php
require_once('_db.php');

$now = (new DateTime("now"))->format('Y-m-d H:i:s');
$ordinal = db_get_max_ordinal(null) + 1;

$stmt = $pdo->prepare("INSERT INTO task (project_id,name, start, end, ordinal, ordinal_priority) VALUES (:project_id, :name, :start, :end, :ordinal, :priority)");
$stmt->bindParam(':project_id', $_GET['project_id']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(":ordinal", $ordinal);
$stmt->bindParam(":priority", $now);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$pdo->lastInsertId();
$response->id = $pdo->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);

?>
