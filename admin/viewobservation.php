<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
      require_once('../core/init.php');
      include('../core/logic.php');
      include('includes/head2.php');
      require_once('../core/controllers/observation-controller.php');
    }
    else
    {
      header("Location:../login.php");
    }
?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php';?>
      <div id='content'>
        <div class='row'>

          <div class='col-xs-12'>
            <ol class="breadcrumb">
             <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
             <li class="active"><i class="fa fa-eye"></i> View Obsevation</li>
            </ol>
          </div><!-- /col-xs-6-->

          <div class='col-xs-11 b'>
              <h2>Observation </h2><hr class="bhr"/>

              
              <div class="col-xs-6">
               <h4>Task Details</h4><hr class="bhr"/>
               <table>
                <tr><th>ID</th><td>: #<?= $observation['task_id'] ?></td></tr>
                <tr><th>Title</th><td>: <?= $observation['t_name'] ?></td></tr>
                <tr><th>Location</th><td>: <a href=""><?= $observation['location'] ?></a></td></tr>
                <tr><th>Start</th><td>: <?= date_format(date_create($observation['s_date']),"d-M-Y D") ?></td></tr>
                <tr><th>End</th><td>: <?= date_format(date_create($observation['e_date']),"d-M-Y D") ?></td></tr>
                <tr><th>Last Status</th><td>: <?= $observation['status'] ?></td></tr>
                <tr><th>Complete</th><td>: <?= $observation['complete'] ?>%</td></tr>
                <tr><th>Date Posted</th><td>: <?= date_format(date_create($observation['date_posted']),"d-M-Y H:sa")  ?></td></tr>
               </table>
               <hr>
               <?php $today = date("Y-m-d");
                if((strtotime($today) > strtotime($observation['e_date']))&&($observation['complete']<100))
                {?>
                 <tr><th>About this task</th><td>: This task is overdue </td></tr>
               <?php }
               if(isset($_GET['id']))
               {
                echo "<a href='/ipheya/admin/clientRequest.php'>Back</a>";
               }
               ?>

              </div>



              <div class="col-xs-6">
              <h4>Employee Details</h4><hr class="bhr"/>
               <table>
                <tr><th>ID</th><td>: #<?= $employee['emp_no'] ?></td></tr>
                <tr><th>Name</th><td>: <?= $employee['name']." ".$employee['surname'] ?></td></tr>
                <tr><th>Email</th><td>: <a href=""><?= $employee['email'] ?></a></td></tr>
                <tr><th>Cell</th><td>: <?= $employee['phone_number'] ?></td></tr>
               </table>
              </div>
          </div> <!--/row-->
          <?php include('includes/footer.php'); ?>
         </div>
      </div>
  </div>
</body>
<script src="../assets/fullcalendar/js/jquery-1.10.2.js"></script>
<script src="../assets/fullcalendar/js/bootstrap.min.js"></script>
<script src='../assets/fullcalendar/js/moment.min.js'></script>
<script src='../assets/fullcalendar/js/fullcalendar.js'></script>
<link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.css">


