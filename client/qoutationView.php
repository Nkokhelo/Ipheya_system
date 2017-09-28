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
                  <h1 class="text-center" style="color:#888">Qoute</h1>
                  <hr class="bhr"/>
                  <div class="col-sm-6">
                    <div class="row"><div class="col-xs-6"><b>Title</b></div><div class="col-xs-6"><b>:</b><?=$Title?></div></div>
                    <div class="row"><div class="col-xs-6"><b>Date Issued</b></div><div class="col-xs-6"><b>:</b><?=$QoutationDate?></div></div>
                    <div class="row"><div class="col-xs-6"><b>Exp-Date</b></div><div class="col-xs-6"><b>:</b><?=$ExpiringDate?></div></div>
                  </div>
                  <div class="col-sm-12">
                      <hr style="width:100%"/>
                    <b>Summary</b> 
                    <div class="col-sm-12">
                      <textarea class="form-control" readonly rows="5"><?=$Summary?></textarea>
                    </div>
                    <hr style="width:100%"/>
                  </div>
                  <div class="col-sm-12">
                      <table class="table">
                        <thead>
                              <th>item </th>
                              <th>description</th>
                              <th>unit price</th>
                              <th>quantity</th>
                              <th>amount</th>
                        </thead>
                        <tbody>
                            <?=$allQItems?>
                        </tbody>
                      </table>
                      <div class="col-xs-12">
                        <p><b>Qoutation T & C</b></p>
                      </div>
                      <hr class="bhr"/>
                      <form method="POST">
                          <div class="col-sm-6 col-xs-offset-3">
                            <button type="submit" class="btn btn-success" style="width:49%" ><span class="glyphicon glyphicon-ok"></span> Accept</button>
                            <button type="button" class="btn btn-warning" style="width:49%" ><span class="glyphicon glyphicon-ok"></span> Decline</button>
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

