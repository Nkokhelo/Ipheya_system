<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        include('../core/controllers/programs-controller.php');
<<<<<<< HEAD
        include('includes/navigation.php');
=======
        // include('includes/navigation.php');
>>>>>>> accbf54a17fe5b81da2a63dd12f77ac0fc3e6b1d
   }
   else
   {
     header("Location:../login.php");
   }
?>
<<<<<<< HEAD

<div class="col-xs-12" style='padding-bottom:50px;'>
  <div class="col-xs-8 col-xs-offset-2 b">
      <h2><?=$viewproject['project_name']?></h2>
      <hr class='bhr'/>
      <div class='col-xs-12'>
        <div class='col-xs-8'>
          <h3>Project Details</h3>
          <hr class='bhr'>
          <div class='row'>
            <label class='col-xs-3' style='text-align:right'>Project Name : </label>
            <div class=' col-xs-9 '><?=$viewproject['project_name']?></div>
          </div>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Description : </label>
            <div class=' col-xs-9' style='min-height:40px'><?=$viewproject['description']?></div>
          </div>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Start Date : </label>
            <div class=' col-xs-9 '><?= date("d F Y", time($viewproject['start_date']))?></div>
          </div>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>End Date : </label>
            <div class=' col-xs-9 '><?= date("d F Y",time($viewproject['end_date']))?></div>
          </div>
          <h3>Project Manager Details  </h3>
          <hr class='bhr'>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Manager : </label>
            <div class=' col-xs-9 '><?=$employee['title']." ".substr($employee['name'],0,1).".".$employee['surname']?></div>
          </div>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Number : </label>
            <div class=' col-xs-9 '><?=$employee['phone_number']?></div>
          </div>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Department : </label>
            <div class=' col-xs-9 '><?=$logic->getDepartmentNameByID($employee['department'])?> Department</div>
          </div>
            <h3>Client Details  </h3>
          <hr class='bhr'>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Client : </label>
            <div class=' col-xs-9 '><?=$client['name']?> <?=$client['surname']?></div>
          </div>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Number : </label>
            <div class=' col-xs-9 '><?=$client['contact_number']?></div>
          </div>
          <div class='row'>
            <label class=' col-xs-3' style='text-align:right'>Email : </label>
            <div class=' col-xs-9 '><?=$client['email']?></div>
          </div>
      </div>
      </div>
      <hr class='bhr' style="width:100%"/>
        <div class='col-xs-6 col-xs-offset-3' style='padding-bottom:50px;'>
            <?php if(isset($_GET['prog'])){?>
                
                <a class=" col-xs-6 btn btn-default"><span class="glyphicon glyphicon-pencil"></span> edit</a>
                <a href='viewprogram?view=<?=$_GET["prog"]?>' class=" col-xs-6 btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span> back</a>
            <?php } else{?>
            <button class="col-xs-6 btn btn-default btn-block" ><span class="glyphicon glyphicon-pencil"></span> edit</button>
            <?php }?>
        </div>
  </div>
</div>
=======
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
          <div class="col-xs-10 b">
              <h2><?=$viewproject['project_name']?></h2>
              <hr class='bhr'/>
              <div class='col-xs-12'>
                <div class='col-xs-8'>
                  <h3>Project Details</h3>
                  <hr class='bhr'>
                  <div class='row'>
                    <label class='col-xs-3' style='text-align:right'>Project Name : </label>
                    <div class=' col-xs-9 '><?=$viewproject['project_name']?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Description : </label>
                    <div class=' col-xs-9' style='min-height:40px'><?=$viewproject['description']?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Start Date : </label>
                    <div class=' col-xs-9 '><?= date("d F Y", time($viewproject['start_date']))?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>End Date : </label>
                    <div class=' col-xs-9 '><?= date("d F Y",time($viewproject['end_date']))?></div>
                  </div>
                  <h3>Project Manager Details  </h3>
                  <hr class='bhr'>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Manager : </label>
                    <div class=' col-xs-9 '><?=$employee['title']." ".substr($employee['name'],0,1).".".$employee['surname']?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Number : </label>
                    <div class=' col-xs-9 '><?=$employee['phone_number']?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Department : </label>
                    <div class=' col-xs-9 '><?=$logic->getDepartmentNameByID($employee['department'])?> Department</div>
                  </div>
                    <h3>Client Details  </h3>
                  <hr class='bhr'>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Client : </label>
                    <div class=' col-xs-9 '><?=$client['name']?> <?=$client['surname']?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Number : </label>
                    <div class=' col-xs-9 '><?=$client['contact_number']?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>Email : </label>
                    <div class=' col-xs-9 '><?=$client['email']?></div>
                  </div>
              </div>
              </div>
              <hr class='bhr' style="width:100%"/>
                <div class='col-xs-6 col-xs-offset-3' style='padding-bottom:50px;'>
                    <?php if(isset($_GET['prog'])){?>
                        
                        <a class=" col-xs-6 btn btn-default"><span class="glyphicon glyphicon-pencil"></span> edit</a>
                        <a href='viewprogram?view=<?=$_GET["prog"]?>' class=" col-xs-6 btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span> back</a>
                    <?php } else{?>
                    <button class="col-xs-6 btn btn-default btn-block" ><span class="glyphicon glyphicon-pencil"></span> edit</button>
                    <?php }?>
                </div>
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
>>>>>>> accbf54a17fe5b81da2a63dd12f77ac0fc3e6b1d
