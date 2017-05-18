<?php
     require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require_once('../core/controllers/role-controller.php');
     include('includes/employee-session.php');
?>
<div class="container-fluid" style="padding:1%;">
        <?php if(isset($_GET['edit']) || isset($_GET['add'])){ ?>
        <div class="col-sm-12">
        <?php include'includes/roles-modal.php';?>
          <div class="col-xs-8 col-xs-offset-2 b" style="padding-bottom:15px;">
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
                <div class="col-xs-8 col-xs-offset-4" style="align:center">
                  <button data-toggle="modal" data-target="#add-role" class="btn btn-default" >Add new role</button>
                </div>
          </div>
        </div>
        <?php }else{ ?>
         <div class="col-sm-12 col-md-offset-1 col-md-9 b">
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
                <div class="col-md-7 col-md-push-4">
                       <button class="btn btn-default" data-toggle="modal" data-target="#rolesAssign" id="assign"> Add role to employee</button>
                       <a href="roles.php?add=1" class="btn btn-default" id="add-btn">Manage company Roles</a>
                </div>            
            </div>
        <?php } ?>
</div>
<?php include('includes/footer.php'); ?>
