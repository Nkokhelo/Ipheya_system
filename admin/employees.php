<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/employee-controller.php');
        include('includes/employee-session.php');
        include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<div  class="container-fluid" style="margin:1%;">
  <!-- employees form -->
  <div id="employeeform" class="col-xs-8 col-xs-offset-2 b" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
    <h2><?=((isset($_GET['edit']))?'Edit':'Add');?> Employee</h2>
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
        <input type="text" name="name" id="name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="First Name">
      </div>
      <div class="form-group col-md-6">
        <label for="surname">Last name</label>
        <input type="text" name="surname" id="surname" class="form-control" value="<?=((isset($surname))?$surname:'');?>" placeholder="Last Name">
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
        <input type="text" name="number" id="number" class="form-control" value="<?=((isset($number))?$number:'');?>" placeholder="Phone-Number" maxlength="10">
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email address</label>
        <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="Email Address">
      </div>
      <div class="form-group col-md-6">
        <label for="date">Date of birth</label>
        <input type="text" name="date" class="form-control" id="date" value="<?=((isset($date))?$date:'');?>">
      </div>
      <div class="form-group col-md-6">
        <label for="identity">ID number</label>
        <input type="text" name="identity" class="form-control" id="identity" value="<?=((isset($identity))?$identity:'');?>" placeholder="ID number" maxlength="13">
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
  <!-- employees table -->
  <div id="employeetable" class="col-xs-8 col-xs-offset-2 b" >
   <h2>All Employees</h2>
   <hr class="bhr"/>
    <table class="table" id="table">
      <div class="" id="errors"><?=((isset($tbl_display))?$tbl_display:'');?></div>
      <thead>
        <th>Department</th>
        <th>Employee No</th>
        <th>Fullname</th>
        <th>Role(s)</th>
        <th>Options</th>
      </thead>
      <tbody>
        <?=$allEmployees;?>
      </tbody>
    </table>
    <hr class="bhr" style="width:100"/>
    <div class="col-xs-6 col-xs-offset-3 btn-group">
      <a style="width:50%"href="roles.php" class="btn btn-default" ><span class="glyphicon glyphicon-adjust"></span> Manage employee role  </a>
      <a style="width:50%" onclick='addEmployee()' class="btn btn-default" ><span class="glyphicon glyphicon-plus-sign"></span> Add employee  </a>
    </div>
      <br>
  </div>
</div>
<script>
   var date = new Date();
   
  	$("#date").datepicker(
							{
								dateFormat: 'yy/mm/dd',
                changeYear:true,
                changeMonth:true,
                yearRange: "-40:-18"
							}
						);
    $('#table').dataTable();
    // $('#employeetable').show();
    // $('#employeeform').hide();
    // function addEmployee(){
    //     $('#employeetable').hide();
    //     $('#employeeform').show();
    // }
    // function added()
    // {
    //    $('#employeetable').show();
    //     $('#employeeform').hide();
    // }

</script>
<?php include('includes/footer.php'); ?>
