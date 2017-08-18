<?php 
    session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        // include('includes/navigation.php');
        require('../core/controllers/taskController.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class="col-sm-10 b" style="padding-bottom:20px;">
                <h2>Assigned Task</h2><hr class="bhr"/>
                <table class="table">
                    <thead>
                        <th>Title</th> 
                        <th>Employees</th>
                        <th>Duration</th>
                        <th>Start Date-End Date</th>
                    </thead>
                    <tbody>
                        <?=$taskInfo?>
                    </tbody>
                </table>
                <hr class='bhr'/>
                <div class="col-sm-6 col-xs-offset-3" style="text-align:center;">
                    <button class="btn btn-default form-control" id="viewCalenda" ><span class="glyphicon glyphicon-calendar"></span> Calenda View</button>
                </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
    $('.table').dataTable();
</script>