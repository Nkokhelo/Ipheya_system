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
    </div>
</body>