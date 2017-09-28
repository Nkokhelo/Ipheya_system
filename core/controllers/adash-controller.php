<?php 
  $logic = new Logic();
  include("../core/sub/php_action/core.php");
$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;
if($countProduct==null)
{
 $countProduct =0;
}

$orderSql = "SELECT * FROM sales_orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
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

$lowStockSql = "SELECT * FROM product WHERE reorder <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

if($countLowStock==null)
{
 $countLowStock =0;
}

?>