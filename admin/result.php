<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('includes/head2.php');
  // include('../core/controllers/chat-controller.php');
  require_once '../core/logic.php';
  $log= new Logic();
  $method = $log->connect();
  $testid= $_GET['test'];
}
else
{
  header("Location:../login.php");
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
         <div class="col-xs-11 b">
           <div class="form-group">
                 <?php

                    $totalr = $log->connect()->query("select count(*) as total from question where test_id='$testid'");
                    $total = $totalr->fetch_assoc();
                    $score = $_SESSION['score'];
                    $total = $total['total'];
                    $test_score = ($score/$total)*100;
                if($test_score < 50)
                {?>
                <h3 class="text-center"><strong>You failed the test.</strong></h3><hr class="bhr"/>
                <?php } else {?>
                <h3 class="text-center"><strong>You passed.</strong></h3><hr class="bhr"/>
                <?php }?>
                <h4 class="text-center">Score : <?= number_format($test_score,0)?>%</h4>
                <hr class="bhr">
                <div class="col-xs-12">

                <div class="col-xs-4 col-xs-offset-4">
                 <a href="test.php" class="btn btn-block btn-primary pull-right">EXIT</a>
                </div>
                </div>
            </div>
         </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
