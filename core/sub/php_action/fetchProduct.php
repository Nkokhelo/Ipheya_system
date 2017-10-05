<?php



require_once 'core.php';

$sql = "SELECT * FROM product
		INNER JOIN brands ON product.brand_id = brands.brand_id
		INNER JOIN categories ON product.categories_id = categories.categories_id
		WHERE product.status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

 // $row = $result->fetch_array();
 $active = "";

 while($row = $result->fetch_assoc()) {
 	$productId = $row['product_id'];
 	// active
 	if($row['status'] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	     <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
	  </ul>
	</div>';
  $reorder = $row['reorder'];
  $productname = $row['product_name'];
	$brand = $row['brand_name'];
	$category = $row['categories_name'];

	$productImage = "<img class='img-round' src='data:image; base64,".$row['product_image']."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array(
 		// image
 		$productImage,
 		// product name
 		$productname,
  	// brand
 		$brand,
 		// category
 		$category,
    //reorder
    $reorder,
 		// active
 		$active,
 		// button
 		$button
 		);
 } // /while

}// if num_rows

$connect->close();

echo json_encode($output);
