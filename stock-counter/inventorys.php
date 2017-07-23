<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
		 require_once('../core/init.php');
		 include('includes/head.php');
		 include('../core/logic.php');
		 require_once('../core/controllers/inventory-controller.php');
		 include('includes/navigation.php');
    }
    else
    {
      header("Location:../login.php");
    }
     
?>
<div class="container-fluid" style="padding:1%;">
      <div class="col-sm-offset-2 col-sm-8 b">
        <h2 class="text-center">Inventory</h2><hr class="bhr">
        <div class="col-xs-12">
            <table class="table table-bordered table-hover" id="items">
                <thead>
                    <th>Item No</th>
                    <th>Name</th>
                    <th>Supplier</th>
                    <th>Purchase Date</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </thead>
                <tbody>
                <?=$allItems?>
                <?=$feedback['error']?>
                </tbody>
                <tfoot style="font-weight:800; ">
                    <tr>
                        <td align='right' colspan=4>
                            <i>TOTAL PRICE :</i>
                        </td>
                        <td align='right'>
                            <i><?=$sumQ?></i>
                        </td>
                        <td align='right'>
                            <i><?=number_format($sumUP,2,","," ") ?></i>
                        </td>
                        <td align='right'>
                            <i><?=number_format($sumTP,2,","," ")?></i>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <hr class="bhr" style="width:100%">
        <div class="col-xs-12">
                    <a href="additem.php?purchase" class="btn btn-block btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Purchase</a>
                    <br>
        </div>
      </div>
</div>
<script>
  $('#items').dataTable();
</script>
<?php include('includes/footer.php'); ?>
