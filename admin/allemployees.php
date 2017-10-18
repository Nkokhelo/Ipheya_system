 <?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/employee-controller.php');
        include('includes/employee-session.php');
        // include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<body>
  <div class="wrapper">
      <?php include ('includes/sidebar.php');?>
      <div id='content'>
        <div class='row'>

        <div class='col-xs-6'>
            <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="dropdown active">
            <i class="fa fa-users"></i> <a href="#hr" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                        Employees<b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="alltrainings.php">Training</a></li>
                      </ul>
                  </li>
            </ol>
          </div><!-- /col-xs-6-->

            <div class='col-xs-11 col-xs-offset-1 b'>
            <h2>All Employees</h2>
            <hr class="bhr"/>
            <div class="" id="errors"><?=((isset($tbl_display))?$tbl_display:'');?></div>
              <table class="table  table-bordered" id="employeeTable">
                <thead>
                  <th>Employee no#</th>
                  <th>Department</th>
                  <th>Fullname</th>
                  <th>Role(s)</th>
                  <th>Options</th>
                </thead>
                <tbody>
                  <?=$allEmployees;?>
                </tbody>
              </table>
              <hr class="bhr" style="width:100"/>
              <div class="form-group col-xs-12">
                <div class="col-xs-3 col-xs-offset-3">
                  <a href="roles.php" class="btn btn-default form-control" ><span class="glyphicon glyphicon-adjust"></span> Manage employee role  </a>
                </div>
                <div class='col-xs-3'>
                    <a  href='employees.php' class="btn btn-default form-control" ><span class="glyphicon glyphicon-plus-sign"></span> Add employee  </a>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</body>
<script>

  $(document).ready(function() {
    $('#employeeTable').dataTable();
  });
</script>
