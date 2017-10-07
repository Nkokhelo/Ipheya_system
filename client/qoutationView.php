<?php
   session_start();
   if(isset($_SESSION['Client']))
   {
      require_once('../core/init.php');
      include('includes/head.php');
      include ('../core/logic.php');
      include '../core/controllers/qoutation-controller.php';
      include('../core/controllers/client-controller.php');
   }
   else 
   {
     header('Location: ../login.php');
   }
 ?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class="col-xs-11 b">
                <div class="col-sm-12">
                  <h1 class="text-center" style="color:#888">Qoutation</h1>
                  <hr class="bhr"/>
                  <div class="col-xs-6">
                    QOUTATION DETAILS<hr class="bhr">
                    <table>
                      <tr><th>Qoutation No</th><td> : <?=$_GET['viewQ']?></td></tr>
                      <tr><th>Title</th><td> : <?=$Title?></td></tr>
                      <tr><th>Qoute Issued</th><td> : <?=date("d F Y",time($QoutationDate))?></td></tr>
                      <tr><th>Exp-Date</th><td> : <?=date("d F Y",time($ExpiringDate))?></td></tr>
                    </table>
                  </div>
                  <div class="row">
                    <div class="col-xs-12"><hr style="width:100%"></div>
                    
                    <div class="col-xs-6 col-xs-offset-6">
                      CLIENT DETAILS<hr class="bhr">
                          <table>
                            <tr><th>Name</th><td>: </td></tr>
                            <tr><th>Cell</th><td>: </td></tr>
                            <tr><th>Postal Address</th><td>: </td></tr>
                            <tr><th>Physical Address</th><td>: </td></tr>
                          </table>
                    </div>
                  </div>
                  <div class="col-sm-12">
                      <hr style="width:100%"/>
                    <div class="col-xs-12">SUMMARY <hr class="bhr"> </div>
                    <div class="col-sm-12">
                      <textarea class="form-control" readonly rows="5"><?=$Summary?></textarea>
                    </div>
                    <hr style="width:100%"/>
                  </div>
                  <div class="col-sm-12">
                    <h5 class="text-center">ITEMS</h5>
                    <hr class="bhr">
                      <table class="table table-bordered">
                        <thead>
                              <th>NAME </th>
                              <th>DESCRIPTION</th>
                              <th align=center>UNIT PRICE</th>
                              <th align=right>QUANTITY</th>
                              <th align=right>AMOUNT</th>
                        </thead>
                        <tbody>
                            <?=$allQItems?>
                        </tbody>
                      </table>
                      <div class="col-xs-12">
                        TERMS AND CONDITIONS <hr class="bhr">
                        <div class="col-xs-12">
                          <i>We request <?=$PaymentMethord?>% deposit before a job begins<br/>Deposit of R<?=number_format($deposit,2,","," ")?> must be paid before <?=date("d F Y",time($ExpiringDate))?><br><br> Thank you for your bussiness..<br></i> 
                        </div>
                      </div>
                      <hr class="bhr"/>
                      <form method="POST">
                          <div class="col-sm-6 col-xs-offset-3">
                            <input type="hidden" name="qoutationId" value="<?=$_GET['viewQ']?>"/>
                            <button type="submit" name="accept" class="btn btn-success" style="width:49%" ><span class="glyphicon glyphicon-ok"></span> Accept</button>
                            <button type="button" name="decline" class="btn btn-warning" style="width:49%" ><span class="glyphicon glyphicon-ok"></span> Decline</button>
                            <input name="deposit" type="hidden" value="<?=$deposit?>"/>
                          </div>
                      </form>
                  </div>
              </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

