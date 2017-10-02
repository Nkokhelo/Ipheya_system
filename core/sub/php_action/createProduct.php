<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

	$productName 		= $_POST['productName'];
  $productImage 	= $_FILES['productImage']['name'];
  $reorder 				= $_POST['reorder'];
  $brand_id 			= $_POST['brandName'];
  $category_id 	= $_POST['categoryName'];
  $productStatus 	= $_POST['productStatus'];

		if(is_uploaded_file($_FILES['productImage']['tmp_name']))
		{
				if($_FILES['productImage']['size'] != "")
				{
					$productImage=addslashes($_FILES['productImage']['tmp_name']);
					$productImage=file_get_contents($productImage);
					$productImage=base64_encode($productImage);

					$sql = "INSERT INTO product (product_name, product_image, brand_id, categories_id, reorder, active, status)
					VALUES ('$productName', '$productImage', $brand_id, $category_id, $reorder, $productStatus, 1)";

					if($connect->query($sql) === TRUE)
					{
						$valid['success'] = true;
						$valid['messages'] = "Successfully Added";
					}
					else
					{
						$valid['success'] = false;
						$valid['messages'] = "Error while adding the Product".$sql;
					}
				}
				else
				{
					$valid['success'] = false;
					$valid['messages'] = "Error".$_FILES['profile_pic']['error'];
				}// /else

		} // if

	$connect->close();

	echo json_encode($valid);

} // /if $_POST
