<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        include('../core/controllers/programs-controller.php');
        // include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<<<<<<< HEAD

<div class="col-xs-12">
  <div class="col-xs-8 col-xs-offset-2 b">
      <h2><?=$program['program_name']?></h2>
      <hr class='bhr'/>
      <div class='col-xs-12'>
        <div class='col-xs-8 col-xs-offset-1'>
          <div class='row'>
            <h4 class=' col-xs-12 '>Description </h4>
            <div class=' col-xs-9 '><?=$program['description']?></div>
          </div>
          <hr/>
          <div class='row'>
            <h4 class='col-xs-12 '><?=($pi>0)? $pi." Projects": "No Projects" ?></h4>
            <div class='col-xs-11 '>
                    <label style='font-style: italic'><?= $get_project ?></label>
                    <?=(isset($feedback))?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":'no data '?>
            </div>
=======
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
          <div class="col-xs-10 b">
              <h2><?=$program['program_name']?></h2>
              <hr class='bhr'/>
              <div class='col-xs-12'>
                <div class='col-xs-8 col-xs-offset-1'>
                  <div class='row'>
                    <h4 class=' col-xs-12 '>Description </h4>
                    <div class=' col-xs-9 '><?=$program['description']?></div>
                  </div>
                  <hr/>
                  <div class='row'>
                    <h4 class='col-xs-12 '><?=($pi>0)? $pi." Projects": "No Projects" ?></h4>
                    <div class='col-xs-11 '>
                            <label style='font-style: italic'><?= $get_project ?></label>
                            <?=(isset($feedback))?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":'no data '?>
                    </div>
                  </div>
              </div>
              </div>
              <hr class='bhr' style="width:100%"/>
              <div class='col-xs-6 col-xs-offset-3' style='margin-bottom:30px;'>
                <button data-toggle="modal" data-target="#addproject" class='btn btn-default btn-block'>add project</button>
              </div>
>>>>>>> accbf54a17fe5b81da2a63dd12f77ac0fc3e6b1d
          </div>
        </div>
      </div>
      </div>
      <hr class='bhr' style="width:100%"/>
      <div class='col-xs-6 col-xs-offset-3' style='margin-bottom:30px;'>
        <button data-toggle="modal" data-target="#addproject" class='btn btn-default btn-block'>add project</button>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <?php include'includes/project-modal.php' ?>
</body>


