<?php

require_once 'cart_info.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

$item_id = $_POST['item_id'];

$type = explode('.', $_FILES['edititem_img_name']['name']);
	$type = $type[count($type)-1];
	$url = '../images/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['edititem_img_name']['tmp_name'])) {
			if(move_uploaded_file($_FILES['edititem_img_name']['tmp_name'], $url)) {

				$sql = "UPDATE items SET item_img_name = '$url' WHERE item_id = $item_Id";

				if($mysqli->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Updated";
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while updating product image";
				}
			}	else {
				return false;
			}	// /else
		} // if
	} // if in_array

	$mysqli->close();

	echo json_encode($valid);

} // /if $_POST
