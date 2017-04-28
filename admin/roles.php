<?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require_once('../core/controllers/role-controller.php');
     include('includes/employee-session.php');
?>
<div class="container-fluid" style="padding:1%;">
      <h2 class="text-center">roles</h2><hr>
        <?php if(isset($_GET['edit']) || isset($_GET['add'])){ ?>
        <div class="">
            <form class="form-inline" action="roles.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
              <div class="form-group">
                <input type="text" name="company-role" id="company-role" class="form-control" value="<?=((isset($_GET['edit']))?$role_val:'');?>" placeholder="Role">
                <?= ((isset($_GET['add']))?'<input type="submit" class="btn btn-success" name="Add" value="Add role">':'<input type="submit" name="Edit" value="Edit Role" class="btn btn-success">');?>
                <a href="roles.php<?=((isset($_GET['edit']))?'?add=1':'');?>" class="btn btn-warning">Cancel</a>
              </div>
            </form>
       </div><hr>
       <table class="table table-bordered table-striped " style="padding:2%;">
         <thead>
           <th>Role_id</th><th>Role</th><th>Options</th>
         </thead>
         <tbody>
           <?=$allCompanyRoles_tbl;?>
         </tbody>
       </table>
        <?php }else{ ?>
          <div class="">
              <a href="roles.php?add=1" class="btn btn-primary pull-right" id="add-btn">Role Management</a><div class="clearfix"></div>
              <form class="form-inline" action="roles.php<?=((isset($_GET['remove']))?'?remove='.$remove_id:'');?>" method="post">
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="employee email">
                  <select class="form-control" name="role" id="role">
                    <?=((isset($allEmployeeRoles))?$allEmployeeRoles:$allCompanyRoles);?>
                  </select>
                  <?= ((isset($_GET['remove']))?'<input type="submit" class="btn btn-danger" name="Remove" value="Remove role">':'<input type="submit" name="Assign" value="Assign role" class="btn btn-success">');?>
                  <?=((isset($_GET['edit']) || isset($_GET['remove']))?'<a href="roles.php" class="btn btn-warning">Cancel</a>':'');?>
                </div>
              </form>
          </div><hr>
          <table class="table table-bordered table-striped " style="padding:2%;">
            <thead>
              <th>Employee</th><th>role(s)</th><th>Options</th>
            </thead>
            <tbody>
              <?=$allEmployees;?>
            </tbody>
          </table>
        <?php } ?>
</div>
<?php include('includes/footer.php'); ?>
