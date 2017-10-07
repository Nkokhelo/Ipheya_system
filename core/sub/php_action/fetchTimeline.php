<?php

require_once 'core.php';

$rental_id = $_POST['rentId'];
$row=array();

$sql = "SELECT t.timeline, tr.rental_charge FROM timeline_rental as tr JOIN timelines as t ON t.timeline_id =tr.timeline_id WHERE rental_id = $rental_id";
$result = $connect->query($sql);

if($result->num_rows > 0) {
 while($row1 = $result->fetch_assoc())
 {
  $row['timelines'][] = $row1;
 }
} // if num_rows

$connect->close();

echo json_encode($row);
?>