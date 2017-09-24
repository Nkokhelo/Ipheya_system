<?php 	

require_once 'core.php';
include("../../logic.php");
$orderId = $_POST['orderId'];

$sql = "SELECT * FROM purchase_orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_assoc();

$order_id = $orderData['order_id'];
$supplier_id = $orderData['supplier_id'];
$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
	INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table ='
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				Order Date : '.$orderDate.'
				<center>Client Name : '.$clientName.'</center>
				Contact : '.$clientContact.'
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>S.no</th>
			<th>Product</th>
			<th>Rate</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>';

		$x = 1;
		while($row = $orderItemResult->fetch_array()) {			
						
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$row[4].'</th>
				<th>'.$row[1].'</th>
				<th>'.$row[2].'</th>
				<th>'.$row[3].'</th>
			</tr>
			';
		$x++;
		} // /while

		$table .= '<tr>
			<th></th>
		</tr>

		<tr>
			<th></th>
		</tr>

		<tr>
			<th>Sub Amount</th>
			<th>'.$subTotal.'</th>			
		</tr>

		<tr>
			<th>VAT (13%)</th>
			<th>'.$vat.'</th>			
		</tr>

		<tr>
			<th>Total Amount</th>
			<th>'.$totalAmount.'</th>			
		</tr>	

		<tr>
			<th>Discount</th>
			<th>'.$discount.'</th>			
		</tr>

		<tr>
			<th>Grand Total</th>
			<th>'.$grandTotal.'</th>			
		</tr>

		<tr>
			<th>Paid Amount</th>
			<th>'.$paid.'</th>			
		</tr>

		<tr>
			<th>Due Amount</th>
			<th>'.$due.'</th>			
		</tr>
	</tbody>
</table>
 ';


$connect->close();

echo $table;