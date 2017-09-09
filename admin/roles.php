<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/role-controller.php');
        // include('includes/navigation.php');
        include('includes/employee-session.php');
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
            <div class='col-xs-11 b'>
            <?php if(isset($_GET['edit']) || isset($_GET['add'])){ ?>
              <h2>Roles Management</h2>
              <hr class="bhr"/>
                <div class="col-xs-12">
                  <table class="table" style="padding:2%;">
                    <thead>
                      <th>Role_id</th><th>Role Name</th><th>Options</th>
                    </thead>
                    <tbody>
                      <?=$allCompanyRoles_tbl;?>
                    </tbody>
                  </table>
                </div>
              <hr class="bhr" style="width:100%"/>
              <div class="col-xs-12" style="padding-bottom:20px">
                <div class="col-xs-6 col-xs-offset-3">
                  <button data-toggle="modal" data-target="#add-role" class="btn btn-default form-control" >Add new role</button>
                </div>
              </div>
            <?php }else{ ?>
              <h2>Company Roles</h2>
              <hr class="bhr" style="width:100%; margin-top:20px"/>
              <?php include'includes/assign-role-modal.php';?>
              <table class="table" style="padding:2%;">
                <thead>
                  <th>Employee</th><th>email</th><th>role(s)</th><th>Options</th>
                </thead>
                <tbody>
                  <?=$allEmployees;?>
                </tbody>
              </table>
              <hr class="bhr" style="width:100%; margin-top:20px"/>
                <div class="col-sm-12 " style="margin-bottom:20px;">  
                    <div class="col-md-7 col-md-push-3">
                          <button class="btn btn-default" data-toggle="modal" data-target="#rolesAssign" id="assign"> Add role to employee</button>
                          <a href="roles.php?add=1" class="btn btn-default" id="add-btn">Manage company Roles</a>
                    </div>            
                </div>
              <?php } ?>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
