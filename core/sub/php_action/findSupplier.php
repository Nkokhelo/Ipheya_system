<?php

require_once 'core.php';

$supplier_id = $_POST['supplier_id'];

$sql = "SELECT * FROM suppliers WHERE supplier_id = $supplier_id";
$result = $connect->query($sql);

if($result->num_rows > 0) {
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);
