<?php
   session_start();
   if(isset($_SESSION['Client']))
   {
      require_once('../core/init.php');
      include('../includes/head.php');
      include ('../core/logic.php');
      include '../core/controllers/qoutation-controller.php';
   }
   else 
   {
     header('Location: ../login.php');
   }
   include('../core/controllers/client-controller.php');
   $profile_page = 'selected';
 ?>
  <body id="client-dashboard">
    <?php  include('../includes/top-nav.php'); ?>
    <div class="container-fluid" style="padding:1%;">
        <?php include('../includes/sidebar.php'); ?>
        <div class="col-sm-8 b">
            <h2>Qoute</h2>
            <hr class="bhr"/>
            <div class="col-sm-6">
              <table class="table">
                  <tr><td>Title</td><td><?=$Title?></td></tr>
                  <tr><td>Qoute Date</td><td><?=$QoutationDate?><td></td></tr>
                  <tr><td>Exp-Date</td><td><?=$ExpiringDate?></td></tr>

              </table>
            </div>
            <div class="col-sm-6">
              <b>Summary</b> 
              <div class="col-sm-12">
                plase
              </div>
            </div>
            <div class="col-sm-12">
                <h4>Items</h4>
                <table class="table">
                  <thead>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Qouant</th>
                        <th>Tot-Price</th>
                  </thead>
                  <tbody>
                      <?=$allQItems?>
                  </tbody>
                </table>
                <hr class="bhr"/>
                <form method="POST">
                    <div class="col-sm-12">
                      <button type="hidden" class="btn btn-success"  ><span class="glyphicon glyphicon-ok"></span> Accept</button>
                      <input name="deposit" type="hidden" value="<?=$deposit?>"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>