<?php
require_once 'core.php';

  $invetory_id = $_POST['inventory_id'];
  $data = '';
  $query="SELECT i.inventry_id, i.quantity, p.product_name FROM inventories as i JOIN product as p ON p.product_id = i.product_id  WHERE i.inventry_id =$invetory_id" ;
  $res= $connect->query($query);
  
  while($d =$res->fetch_assoc())
  {
   $data = $d;
  }
  echo json_encode($data);
?>