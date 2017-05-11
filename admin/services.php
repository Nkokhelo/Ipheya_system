<?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
     include('../core/logic.php');
     require_once('../core/controllers/service-controller.php');
     include('includes/employee-session.php');
?>
<h2 class="text-center">Services</h2>
<div class="container-fluid" style="margin:1%;">
  <!-- service form -->
  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
    <form class="form" action="services.php<?=((isset($_GET['edit']))?'?edit='.$_GET['edit']:'');?>" method="post">
      <legend class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add a new');?> service</legend>
      <div class="" id="errors"><?=((isset($display))?$display:'');?></div>
      <div class="form-group">
        <label for="department">Select department</label>
          <select class="form-control" name="department" id="department" <?=((isset($_GET['view']))?'readonly':'');?>>
            <option value="<?=((isset($depart_id))?$depart_id:'');?>"><?=((isset($dep_name))?$dep_name:'no department selected');?></option>
            <?=((isset($_GET['view']))?'':$allDepartments);?>
          </select>
      </div>
      <div class="form-group">
        <label for="service">Service</label>
        <input type="text" name="service" id="service" class="form-control" value="<?=((isset($service_name))?$service_name:'');?>" placeholder="service" <?=((isset($_GET['view']))?'readonly':'');?>>
      </div>
      <label for="min-duration" class="text-center">Minimum Duration</label>
      <div class="col-md-12" id="min-duration">
        <div class="form-group col-md-4">
            <input type="number" class="form-control col-md-2" name="number" value="<?=((isset($num))?$num:'');?>" min="0" placeholder="number of" <?=((isset($_GET['view']))?'readonly':'');?>>
        </div>
        <div class="form-group col-md-8">
          <select class="form-control col-md-4" name="type" <?=((isset($_GET['view']))?'readonly':'');?>>
            <option value="<?=((isset($type))?$type:'');?>"><?=((isset($type))?$type:'Select duration type');?></option>
            <?=((isset($_GET['view']))?'':'<option value="day(s)">day(s)</option>');?>
            <?=((isset($_GET['view']))?'':'<option value="week(s)">week(s)</option>');?>
            <?=((isset($_GET['view']))?'':'<option value="month(s)">month(s)</option>');?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="description">Service description</label>
        <textarea name="description" id="description" class="form-control" value="" rows="8" cols="100" <?=((isset($_GET['view']))?'readonly':'');?>><?=((isset($description))?$description:'');?></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" class="btn btn-success" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> service">
        <?=((isset($_GET['edit']))?'<a href="services.php" class="btn btn-warning">Cancel</a>':'');?>
      </div>
    </form>
  </div>
  <!-- services table -->
  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
    <table class="table table-bordered">
      <thead>
        <th>Name</th>
        <th>Type</th>
        <th>Options</th>
      </thead>
      <tbody>
        <?=$allServices;?>
      </tbody>
    </table>
  </div>
</div>
<?php include('includes/footer.php'); ?>
