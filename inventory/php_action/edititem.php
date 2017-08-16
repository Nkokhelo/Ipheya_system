<?php

require_once 'cart_info.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
  $item_id = $_POST['item_id'];
  $item_name 		= $_POST['edititem_name'];
  $item_code			= $_POST['edititem_code'];
  $quantity 			= $_POST['editQuantity'];
  $unit_price					= $_POST['editunit_price'];
  $description 			= $_POST['editdescription'];
  $status 	= $_POST['editstatus'];


	$sql = "UPDATE items SET item_name = '$item_name', item_code = '$item_code',quantity = '$quantity', unit_price = '$unit_price',description = '$description', active = '$status', status = 1 WHERE item_id = $item_id ";

	if($mysqli->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating item info";
	}

} // /$_POST

$mysqli->close();

echo json_encode($valid);
