<?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
    //  session_start();
    //  $_SESSION['Employee'];
     require_once('../core/controllers/department-controller.php');
?>
<div class="container-fluid" style="padding:1%;">
      <div class="col-sm-offset-2 col-sm-8 b">
        <h2 class="text-center">List of all departments</h2><hr class="bhr">
      <div class="col-sm-12">
        <form class="form-inline" action="departments.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post" novalidate>
          <div class="form-group col-xs-10 col-xs-offset-1">
            <input type="text" name="department" id="department" class="form-control" value="<?=((isset($department))?$department:'');?>" placeholder="Department Name">
            <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="Department Email">
            <button type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" class="btn btn-primary"><?=((isset($_GET['edit']))?'<span class="glyphicon glyphicon-pencil"></span> Edit':'<span class="glyphicon glyphicon-plus-sign"></span> Add new');?></button>
            <?=((isset($_GET['edit']))?'<a href="departments.php" class="btn btn-primary"><span class="ion ion-android-cancel"></span> Cancel</a>':'');?>
          </div>
        </form>
      </div>
      <br/>
      <hr class="bhr" style="width:100%">
      <table class="table" style="padding:2%;" id="departments">
        <thead>
          <th>Department Name</th><th>Department Email</th><th>Options</th>
        </thead>
        <tbody>
          <?=$allDepartments;?>
        </tbody>
        <tfoot>

        </tfoot>
      </table>
            <hr class="bhr"/>
            <br/>
      </div>
</div>
<script>
  $('#departments').dataTable();
</script>
<?php include('includes/footer.php'); ?>
