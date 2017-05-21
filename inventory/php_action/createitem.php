<?php

require_once 'cart_info.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

	$item_name 		= $_POST['item_name'];
  // $item_img_name 	= $_POST['item_img_name'];
    $item_code 			= $_POST['item_code'];
  $quantity 			= $_POST['quantity'];
  $unit_price 					= $_POST['unit_price'];
  $description 			= $_POST['description'];
  $arrival_date 	= $_POST['arrival_date'];
  $status 	= $_POST['status'];

	$type = explode('.', $_FILES['item_img_name']['name']);
	$type = $type[count($type)-1];
	$url = '../images/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['item_img_name']['tmp_name'])) {
			if(move_uploaded_file($_FILES['item_img_name']['tmp_name'], $url)) {

				//Get the items in the database
				$itemName ="SELECT item_id, item_name, quantity, unit_price FROM items WHERE item_name LIKE '$item_name'";
				$results = $mysqli->query($itemName);
				$row = $results->fetch_array();
				$itemId = $row[0];
				//updating quantity
				$Quantity = $row[2] + $quantity;

				//check if item is a duplicate...
				//if yes, add new item else update quantity
				if($item_name == $row[1] && $unit_price == $row[3]){
					$sql = "UPDATE items SET quantity = '$Quantity' WHERE item_id = $itemId";
							}
				else {
				$sql = "INSERT INTO items (item_name, item_img_name, description, arrival_date, quantity,item_code , unit_price, active, status)
				VALUES ('$item_name', '$url', '$description', '$arrival_date', '$quantity','$item_code', '$unit_price', '$status', 1)";
					}

				if($mysqli->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			}	else {
				return false;
			}	// /else
		} // if
	} // if in_array

	$mysqli->close();

	echo json_encode($valid);

} // /if $_POST
