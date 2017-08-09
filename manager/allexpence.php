<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        // require_once('../core/controllers/cashflow-controller.php');
        // include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<body></body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <h1>Welcome to Ipheya IT Solutions</h1>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>