<?php
   require_once('core/init.php');
   include('includes/head.php');

   session_start();
   if(isset($_SESSION['Client'])){

   }
   else {
     header('Location: login.php');
   }
   include('core/controllers/client-controller.php');
   $home_page = 'selected'
 ?>
  <body id="client-dashboard">
    <?php  include('includes/top-nav.php'); ?>
    <div class="container-fluid" style="padding:1%;">
        <?php include('includes/sidebar.php'); ?>
        <div class="col-lg-9">

        </div>
    </div>
  </body>
</html>
