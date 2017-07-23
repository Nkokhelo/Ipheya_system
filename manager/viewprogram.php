<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        include('../core/controllers/programs-controller.php');
        include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>

<div class="col-xs-12">
  <div class="col-xs-8 col-xs-offset-2 b">
      <h2><?=$program['program_name']?></h2>
      <hr class='bhr'/>
      <div class='col-xs-7 col-xs-offset-1'>
          <div class='row'>
            <h4 class=' col-xs-12 '>Description </h4>
            <div class=' col-xs-11 '><?=$program['description']?></div>
          </div>
          <hr/>
          <div class='row'>
            <h4 class='col-xs-12 '>Project </h4>
            <div class='col-xs-11 '>
                <?= (isset($feedback))?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":'no data ' ?>
            </div>
          </div>
      </div>
  </div>
  <?php include'includes/project-modal.php' ?>
</div>