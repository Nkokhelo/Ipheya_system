<?php

require_once 'cart_info.php';

$sql = "SELECT item_id, item_name FROM items WHERE status = 1 AND active = 1";
$result = $mysqli->query($sql);

$data = $result->fetch_all();

$mysqli->close();

echo json_encode($data);
  