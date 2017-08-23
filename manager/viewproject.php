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
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
          <div class="col-xs-10 b">
              <h2><?=$viewproject['project_name']?></h2>
              <hr class='bhr'/>
              <div class='col-xs-12'>
                <div class='col-xs-7'>
                  <h4 style="color:#888">Project Details</h4 style="color:#888">
                  <hr>
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
                    <div class=' col-xs-9 '><?= date_format(date_create($viewproject['start_date']),'d F Y')?></div>
                  </div>
                  <div class='row'>
                    <label class=' col-xs-3' style='text-align:right'>End Date : </label>
                    <div class=' col-xs-9 '><?= date_format(date_create($viewproject['end_date']),'d F Y')?></div>
                  </div>
                  <h4 style="color:#888">Project Manager Details  </h4 style="color:#888">
                  <hr />
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
                    <h4 style="color:#888">Client Details  </h4 style="color:#888">
                  <hr/>
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
                <div class="col-xs-4">
                <div class="col-xs-12">
                  <h4 style="color:#888">Status...</h4 style="color:#888">
                  <ul>
                  <?php echo "<b>";
                      if($viewproject['status']=='complete')
                      {
                        echo '<p class="text-success"><i class="glyphicon glyphicon-ok-circle"></i> '.$viewproject['status'].'</p>';
                      }
                      if($viewproject['status']=='inprogress')
                      {
                        echo '<p class="text-info"><i class="glyphicon glyphicon-refresh"></i> '.$viewproject['status'].'</p>';
                      }
                      if($viewproject['status']=='not stated')
                      {
                        echo '<p class=""><i class="glyphicon glyphicon-thumbs-down"></i> '.$viewproject['status'].'</p>';                        
                      }
                      if($viewproject['status']=='overdue')
                      {
                        echo '<p class="text-warning"><i class="glyphicon glyphicon-warning-sign"></i> '.$viewproject['status'].'</p>';                        
                      }
                      if($viewproject['status']=='canceled')
                      {
                        echo '<p class="text-danger"><i class="glyphicon glyphicon-alert"></i> '.$viewproject['status'].'</p>';                        
                      }
                      echo "</b>";
                    ?>
                    </ul>
                  </div>
                  <div class="col-xs-12">
                    <h4 style="color:#888">Related Projects...</h4 style="color:#888">
                    <ul>
                      <?=(isset($proj))?$proj:''?>
                    </ul>
                  </div>               
                  <div class="col-xs-12">
                    <h4 style="color:#888">Tasks</h4 style="color:#888">
                    <?php 
                      if($viewproject['status']=='complete')
                      {
                        echo '5';
                      }
                      if($viewproject['status']=='inprogress')
                      {
                        echo '3';
                      }
                      if($viewproject['status']=='not stated')
                      {
                        echo '0';
                      }
                      if($viewproject['status']=='overdue')
                      {
                        echo '3';
                      }
                      if($viewproject['status']=='canceled')
                      {
                        echo '1';
                      }
                    ?>
                  </div>
                </div>
              </div>
              <hr class='bhr' style="width:100%"/>
                <div class='col-xs-6 col-xs-offset-3' style='padding-bottom:20px;'>
                    <?php if(isset($_GET['prog'])){?>
                        <a class=" col-xs-6 btn btn-default"><span class="glyphicon glyphicon-pencil"></span> edit</a>
                        <a href='viewprogram?view=<?=$_GET["prog"]?>' class=" col-xs-6 btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span> back</a>
                    <?php } else{?>
                    <button class="col-xs-6 btn btn-default btn-block" ><span class="glyphicon glyphicon-pencil"></span> edit</button>
                    <?php }?>
                </div>
          </div>
        </div>
        <?php include('includes/footer.php'); ?>
      </div>
    </div>
</body>

