<?php

require_once 'core.php';
if(isset($_POST['supplier_id']))
{
 $supplier_id = $_POST['supplier_id'];
 
 $sql = "SELECT * FROM suppliers WHERE supplier_id = $supplier_id";
 $result = $connect->query($sql);
 
 if($result->num_rows > 0) {
  $row = $result->fetch_array();
 } // if num_rows
 
 $connect->close();
 
 echo json_encode($row);
}

if(isset($_POST['inventory_id']))
{
 $inventory_id = $_POST['inventory_id'];
 $valid = array('success' => false, 'messages' => array());
 $sql = "UPDATE `inventories` SET `is_on_hand` = '1' WHERE `inventories`.`inventry_id` = $inventory_id";
 if($connect->query($sql))
 {
  $valid['success'] =true;
  $valid['messages'] ='Order was added to inventory';
 }
 else{
  $valid['success'] =true;
  $valid['messages'] =$connect->error;
 }
 
 $connect->close();
 
 echo json_encode($valid);
}
?>