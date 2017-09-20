<?php 
  $logic = new Logic();

$sql = "SELECT * FROM product WHERE status = 1";
$query = $db->query($sql);
$countProduct = $query->num_rows;
if($countProduct==null)
{
 $countProduct =0;
}

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $db->query($orderSql);
$countOrder = $orderQuery->num_rows;
if($countOrder==null)
{
 $countOrder =0;
}

$totalRevenue = "";
while ($orderResult = $orderQuery->fetch_assoc()) 
{
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $db->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

if($countLowStock==null)
{
 $countLowStock =0;
}

?>