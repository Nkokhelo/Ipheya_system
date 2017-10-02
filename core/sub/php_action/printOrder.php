<?php 	

require_once 'core.php';
include("../../logic.php");
$logic = new Logic();
$orderId = $_POST['orderId'];

$sql = "SELECT * FROM purchase_orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_assoc();
// order data from a database -> Nkokhelo N Tembe "21406993"
$orderDate = $orderData['order_date'];
$supplier= $logic->getSupplier($orderData['supplier_id']);

$subTotal = number_format($orderData['order_amount'],2,","," ");
$vat = number_format($orderData['order_vat'],2,","," ");
$totalAmount =number_format($orderData['order_amount'] - $orderData['order_vat'],2,","," ");
$discount = number_format($orderData['discount'],2,","," ");
$grandTotal = number_format($orderData['amount_a_disc'],2,","," ");
$due = number_format($orderData['amount_a_disc'],2,","," ");

 $table ='
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">
			<center>
				Order Date : '.$orderDate.'
				<center>Supplier : '.$supplier['company_name'].'</center>
				Telephone : '.$supplier['telephone'].'
				Email : '.$supplier['email'].'
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>No.</th><th>Product</th><th>Unit Price</th><th>Quantity</th><th>Total Amount</th>
		</tr>';

		//we get all the inventory thaa has been ordered but not in hand
		$inventories = $connect->query("SELECT * FROM inventories WHERE order_id = ".$orderId);
		
		$x = 1;
		while($inventory = $inventories->fetch_assoc()) 
		{			
			$table .= 
			'<tr>
					<th>'.$x.'</th><th>'.$logic->getProduct($inventory['product_id'])['product_name'].'</th><th>'.$inventory['unit_price'].'</th><th>'.$inventory['quantity'].'</th><th>'.number_format($inventory['unit_price']*$inventory['quantity'],2,","," ").'</th>	
				</tr>';
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
			<th>R '.$subTotal.'</th>			
		</tr>

		<tr>
			<th>VAT (14%)</th>
			<th>R '.$vat.'</th>			
		</tr>

		<tr>
			<th>Total Amount</th>
			<th>R '.$totalAmount.'</th>			
		</tr>	

		<tr>
			<th>Discount</th>
			<th>R '.$discount.'</th>			
		</tr>

		<tr>
			<th>Grand Total</th>
			<th>R '.$grandTotal.'</th>			
		</tr>

		<tr>
			<th>Due Amount</th>
			<th>R '.$due.'</th>			
		</tr>
	</tbody>
</table>
 ';


$connect->close();

echo $table;