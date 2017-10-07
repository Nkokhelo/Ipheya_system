<?php
require_once('_db.php');

$stmt = $pdo->prepare("INSERT INTO link (from_id, to_id, type) VALUES (:from, :to, :type)");
$stmt->bindParam(':from', $_POST['from']);
$stmt->bindParam(':to', $_POST['to']);
$stmt->bindParam(':type', $_POST['type']);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$pdo->lastInsertId();
$response->id = $pdo->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);

?>
