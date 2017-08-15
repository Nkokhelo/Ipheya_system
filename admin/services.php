<?php
    session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('includes/head2.php');
        include('../core/logic.php');
        require_once('../core/controllers/service-controller.php');
        // include('includes/navigation.php');
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
            <div class='col-xs-10 b'>
              <form class="form" action="services.php<?=((isset($_GET['edit']))?'?edit='.$_GET['edit']:'');?>" method="post">
                <fieldset>
                  <legend class="thelegend inlegend">Add new service</legend>
                    <div class="" id="errors"><?=((isset($display))?$display:'');?></div>
                    <div class="form-group col-xs-6">
                      <label for="service">Service</label>
                      <input type="text" name="service" id="service" class="form-control" value="<?=((isset($service_name))?$service_name:'');?>" placeholder="service name" <?=((isset($_GET['view']))?'readonly':'');?>>
                    </div>
                  
                    <div class="form-group col-md-3">
                    <label for="min-duration" class="text-center">Minimum Duration</label>
                      <input type="number" class="form-control col-md-1" name="number" value="<?=((isset($num))?$num:'');?>" min="0" placeholder="duration" <?=((isset($_GET['view']))?'readonly':'');?>>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="min-duration" class="text-center">Duration Type</label>
                      <select class="form-control col-md-4" name="type" <?=((isset($_GET['view']))?'readonly':'');?>>
<<<<<<< HEAD
                        <option value="<?=((isset($type))?$type:'');?>"><?=((isset($type))?$type:'--Select--');?></option>
=======
                        <option value="<?=((isset($type))?$type:'');?>"><?=((isset($type))?$type:'~Select~');?></option>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                        <?=((isset($_GET['view']))?'':'<option value="day(s)">day(s)</option>');?>
                        <?=((isset($_GET['view']))?'':'<option value="week(s)">week(s)</option>');?>
                        <?=((isset($_GET['view']))?'':'<option value="month(s)">month(s)</option>');?>
                      </select>
                    </div>
                  
                    <div class="form-group col-xs-6">
                      <label for="department">Select department</label>
                        <select class="form-control" name="department" id="department" <?=((isset($_GET['view']))?'readonly':'');?>>
<<<<<<< HEAD
                          <option value="<?=((isset($depart_id))?$depart_id:'');?>"><?=((isset($dep_name))?$dep_name:'--Select--');?></option>
=======
                          <option value="<?=((isset($depart_id))?$depart_id:'');?>"><?=((isset($dep_name))?$dep_name:'~Select~');?></option>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                          <?=((isset($_GET['view']))?'':$allDepartments);?>
                        </select>
                    </div>
                    <div class="form-group col-xs-10">
                      <label for="description">Service description</label>
                      <textarea name="description" id="description" class="form-control" value="" rows="6" cols="100" <?=((isset($_GET['view']))?'readonly':'');?>><?=((isset($description))?$description:'');?></textarea>
                    </div>
                    <hr class="bhr"/>
                    <div class="form-group col-xs-6 col-xs-offset-3">
                      <button type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" class="btn btn-default form-control" ><?=((isset($_GET['edit']))?'<span class="glyphicon glyphicon-pencil"></span> Edit':' <span class="glyphicon glyphicon-plus"></span> Add new');?> Service</button>
                      <?=((isset($_GET['edit']))?'<a href="services.php" class="btn btn-default"><span class="ion ion-android-cancel"></span> Cancel</a>':'');?>
                    </div>
                </fieldset>
              </form>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
