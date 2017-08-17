<?php 	

require_once 'cart_info.php';


$valid['success'] = array('success' => false, 'messages' => array());

$item_id = $_POST['item_id'];

if($item_id) { 

 $sql = "UPDATE items SET active = 2, status = 2 WHERE item_id = {$item_id}";

 if($mysqli->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $mysqli->close();

 echo json_encode($valid);
 
} // /if $_POST