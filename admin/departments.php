<?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require_once('../core/controllers/department-controller.php');
?>
<div class="container-fluid" style="padding:1%;">
      <h2 class="text-center">Departments</h2><hr>
      <div class="">
        <form class="form-inline" action="departments.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post" novalidate>
          <div class="form-group">
            <input type="text" name="department" id="department" class="form-control" value="<?=((isset($department))?$department:'');?>" placeholder="department">
            <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="department email">
            <input type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" value="<?=((isset($_GET['edit']))?'Edit':'Add new');?> department" class="btn btn-success">
            <?=((isset($_GET['edit']))?'<a href="departments.php" class="btn btn-warning">Cancel</a>':'');?>
          </div>
        </form>
      </div><hr>
      <table class="table table-bordered table-striped " style="padding:2%;">
        <thead>
          <th>Department</th><th>Email</th><th>Options</th>
        </thead>
        <tbody>
          <?=$allDepartments;?>
        </tbody>
        <tfoot>

        </tfoot>
      </table>
</div>
<?php include('includes/footer.php'); ?>
