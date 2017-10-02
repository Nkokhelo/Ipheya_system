<?php
 $log = new Logic();
 $connect = $log->connect();
 $query ="SELECT * FROM suppliers";
 $result =$connect->query($query);
 $option ='';
 while($suppliers = $result->fetch_assoc())
 {
  $option .="<option value='".$suppliers['supplier_id']."'>".$suppliers['company_name']."</option>";
 }

 //purchase orders
 $purchase_orders ='';
 $sql = "SELECT i.product_id as p_id ,po.order_id as o_id, po.supplier_id as s_id,po.order_date as od, po.expected_date as ed, i.quantity as q, i.unit_price as up, i.inventry_id as i_id FROM inventories AS i JOIN purchase_orders AS po ON po.order_id = i.order_id WHERE is_on_hand = 0 ";
 $result = $connect->query($sql);
 while($order = $result->fetch_assoc())
 {
  $button ='<div class="btn-group">
  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-caret-down"></i>
  </button>
  <ul class="dropdown-menu">
    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="addInventory('.$order["i_id"].')"> <i class="glyphicon glyphicon-edit"></i> Add to inventory</a></li>
    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$order["i_id"].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
  </ul>
</div>';
  $purchase_orders .="<tr>
  <td>".$log->getSupplierName($order['s_id'])."</td>
  <td>".$log->getProduct($order['p_id'])['product_name']."</td>
  <td>".date_format(date_create($order['ed']),"d-M-y")."</td>
  <td align='right'>".number_format($order['up'],0,","," ")."</td>
  <td align='right'>R".number_format($order['q'],2,","," ")."</td>
  <td align='right'>R".number_format(($order['q']*$order['up'])*14/100,2,","," ")."</td>
  <td align='right'>R".number_format(($order['q']*$order['up'])-(($order['q']*$order['up'])*14/100),2,","," ")."</td>
  <td align='right'>$button</td>
  </tr>";
 }
?>

