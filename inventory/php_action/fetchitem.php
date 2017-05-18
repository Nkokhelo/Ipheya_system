<?php

require_once 'cart_info.php';

$sql = "SELECT items.item_id, items.item_name, items.item_code, items.quantity, items.unit_price,
 		items.description, items.arrival_date, items.active, items.status,items.item_img_name
 		FROM items
		WHERE items.status = 1";

$result = $mysqli->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

 // $row = $result->fetch_array();
 $active = "";

 while($row = $result->fetch_array()) {
 	$item_id = $row[0];
 	// active
 	if($row[7] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="edititemModalBtn" data-target="#edititemModal" onclick="edititem('.$item_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeitemModal" id="removeitemModalBtn" onclick="removeitem('.$item_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE description = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }


	$imageUrl = substr($row[9], 3);
	$item_img_name = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array(
 		// image
 		$item_img_name,
 		// item name
 		$row[1],
 		// item_code
 		$row[2],
 		// quantity
 		$row[3],
    	// unit_price
 		$row[4],
 		// description
 		$row[5],
 		// arrival_date
 		$row[6],
 		// active
 		$active,
 		// button
 		$button
 		);
 } // /while

}// if num_rows

$mysqli->close();

echo json_encode($output);
