<?php

require_once 'cart_info.php';

$item_id = $_GET['i'];

$sql = "SELECT item_img_name FROM items WHERE item_id = {$item_id}";
$data = $mysqli->query($sql);
$result = $data->fetch_row();

$mysqli->close();

echo "cart3/" . $result[0];
