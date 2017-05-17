<?php
     require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require_once('../core/controllers/employee-controller.php');
     include('includes/employee-session.php');
     
?>

<div class="container-fluid" style="margin:1%;">
  <!-- service form -->
  <div class="col-md-6 b" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
    <h2><?=((isset($_GET['edit']))?'Edit':'Add a new');?> employee</h2>
    <hr class="bhr">
    <form class="form" action="employees.php<?=((isset($_GET['edit']))?'?edit='.$_GET['edit']:'');?>" method="post">
      <div class="" id="errors"><?=((isset($display))?$display:'');?></div>
      <div class="form-group">
        <label for="department">Department</label>
          <select class="form-control" name="department" id="department">
            <option value="<?=((isset($depart_id))?$depart_id:'');?>"><?=((isset($depart_name))?$depart_name:'select department');?></option>
            <?=$allDepartments;?>
          </select>
      </div>
      <div class="form-group col-md-6">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="name">
      </div>
      <div class="form-group col-md-6">
        <label for="surname">Last name</label>
        <input type="text" name="surname" id="surname" class="form-control" value="<?=((isset($surname))?$surname:'');?>" placeholder="last name">
      </div>
      <div class="form-group col-md-6">
        <label for="title">Title</label>
        <select name="title" id="title" class="form-control">
          <option value="<?=((isset($title))?$title:'');?>"><?=((isset($title))?$title:'select title');?></option>
          <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <option value="Ms.">Ms.</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="gender">Gender</label>
        <select name="gender" class="form-control" id="gender">
          <option value="<?=((isset($gender))?$gender:'');?>"><?=((isset($gender))?$gender:'select gender');?></option>
          <option value="Female">Female</option>
          <option value="Male">Male</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="number">Contact number</label>
        <input type="text" name="number" id="number" class="form-control" value="<?=((isset($number))?$number:'');?>" placeholder="number" maxlength="10">
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email address</label>
        <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="email address">
      </div>
      <div class="form-group col-md-6">
        <label for="date">Date of birth</label>
        <input type="date" name="date" class="form-control" id="date" value="<?=((isset($date))?$date:'');?>">
      </div>
      <div class="form-group col-md-6">
        <label for="identity">Id number</label>
        <input type="text" name="identity" class="form-control" id="identity" value="<?=((isset($identity))?$identity:'');?>" placeholder="Identity number" maxlength="13">
      </div>
      <div class="form-group col-md-6">
        <label for="residential">Residential address preview</label>
        <input type="text" name="residential" data-toggle="modal" data-target="#addresses" id="residential" class="form-control" value="<?=((isset($residential))?$residential:'');?>" placeholder="enter residential addres" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="postal">Postal address preview</label>
        <input type="text" name="postal" data-toggle="modal" data-target="#addresses" id="postal" class="form-control" value="<?=((isset($postal))?$postal:'');?>" placeholder="anter postal address" readonly>
      </div>
      <hr class="bhr" style="width:100%"/>
      <div class="form-group">
        <button type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span> <?=((isset($_GET['edit']))?'Save Changes':'Add Employee');?></button>
        <?=((isset($_GET['edit']))?'<a href="employees.php" class="btn btn-default"><span class="ion ion-android-cancel"></span> Cancel</a>':'');?>
      </div><div class="clear-fix"></div>
    </form>
    <?php include('includes/address-modal.php'); ?>
  </div>
  <!-- services table -->
  <div class="col-md-6 shift b" style="margin-left:10px; padding-bottom:15px; width:49%">
  <h2>All Employees</h2>
   <hr class="bhr"/>
    <table class="table">
      <div class="" id="errors"><?=((isset($tbl_display))?$tbl_display:'');?></div>
      <thead>
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
    <a class="btn btn-default" href="CreateTask.php">Task management</a>
  </div>
</div>
<?php include('includes/footer.php'); ?>
