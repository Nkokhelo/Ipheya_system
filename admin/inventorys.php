<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
		 require_once('../core/init.php');
		 include('includes/head2.php');
		 include('../core/logic.php');
		 require_once('../core/controllers/inventory-controller.php');
    }
    else
    {
      header("Location:../login.php");
    }
     
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class="col-sm-10 b">
                <h2 class="text-center">Inventory</h2><hr class="bhr">
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover" id="items">
                        <thead>
                            <th>Item No</th>
                            <th>Name</th>
                            <th>Supplier</th>
                            <th>Expected Date</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
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
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
  $('#items').dataTable();
</script>
