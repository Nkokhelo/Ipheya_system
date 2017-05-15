<?php
   require_once('../core/init.php');
   include('../includes/head.php');
   include('../core/logic.php');

   session_start();
   if(isset($_SESSION['Client'])==null)
   {
     header('Location: ../login.php');
   }
   else
   {
     if(isset($_SESSION['message']))
     {
        $message =$_SESSION['message'];
     }
     else
     {
       $message="Hy... You must be new here";
     }
   }
   include('../core/controllers/client-controller.php');
   $home_page = 'selected'
 ?>
  <body id="client-dashboard">
    <?php  include('../includes/top-nav.php'); ?>
    <div class="container-fluid" style="padding:1%;">
        <?php include('../includes/sidebar.php'); ?>
        <div class="col-lg-9">
            <h1><?= $message?></h1>
        </div>
    </div>
  </body>
</html>
