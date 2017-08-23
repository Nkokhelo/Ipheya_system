<?php
    session_start();
    if($_SESSION['Client'])
    {
        include'../core/init.php';
        include('../core/logic.php');
        include('../includes/head.php');
        include('../includes/top-nav.php');
        include('../includes/sidebar.php');
        require_once('../core/controllers/ticket-controller.php');
    }
    else
    {
        header('Location:../login.php');
    }

?>
<div class="container-fluid col-lg-9">
   <div class="col-lg-12">
       <div class="col-md-6" style="margin:2%;background-color:#fff;">
        <table class="table table-striped">
           <thead>
              <th></th><th>Subject</th><th>Status</th>
           </thead>
           <tbody>
               <?=$existingtickets;?>
           </tbody>
        </table>
        </div>
        <div class="col-md-4" style="margin:2%;background-color:#fff;">
        <table class="table table-striped">
           <thead>
              <th></th><th>Request type</th>
           </thead>
           <tbody>
               <?=$existingrequests;?>
           </tbody>
         </table>
        </div>
    </div>
</div>
