<?php

require_once 'cart_info.php';

$item_id = $_POST['item_id'];

$sql = "SELECT item_id, item_name, item_img_name, description, quantity, item_code , unit_price, active, status FROM items WHERE item_id = $item_id";
$result = $mysqli->query($sql);

if($result->num_rows > 0) {
 $row = $result->fetch_array();
} // if num_rows

$mysqli->close();

echo json_encode($row);
