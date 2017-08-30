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
                      <input required type="text" name="service" id="service" class="form-control" value="<?=((isset($service_name))?$service_name:'');?>" placeholder="service name" <?=((isset($_GET['view']))?'readonly':'');?>>
                    </div>
                  
                    <div class="form-group col-md-3">
                    <label for="min-duration" class="text-center">Minimum Duration</label>
                      <input required type="number" class="form-control col-md-1" name="number" value="<?=((isset($num))?$num:'');?>" min="0" placeholder="duration" <?=((isset($_GET['view']))?'readonly':'');?>>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="min-duration" class="text-center">Duration Type</label>
                      <select class="form-control col-md-4" name="type" <?=((isset($_GET['view']))?'readonly':'');?>>
                        <option value="<?=((isset($type))?$type:'');?>"><?=((isset($type))?$type:'--Select--');?></option>

                        <?=((isset($_GET['view']))?'':'<option value="day(s)">day(s)</option>');?>
                        <?=((isset($_GET['view']))?'':'<option value="week(s)">week(s)</option>');?>
                        <?=((isset($_GET['view']))?'':'<option value="month(s)">month(s)</option>');?>
                      </select>
                    </div>
                  
                    <div class="form-group col-xs-6">
                      <label for="department">Select department</label>
                        <select class="form-control" name="department" id="department" <?=((isset($_GET['view']))?'readonly':'');?>>
                          <option value="<?=((isset($depart_id))?$depart_id:'');?>"><?=((isset($dep_name))?$dep_name:'--Select--');?></option>

                          <?=((isset($_GET['view']))?'':$allDepartments);?>
                        </select>
                    </div>
                    <div class="form-group col-xs-10">
                      <label for="description">Service description</label>
                      <textarea name="description" id="description" class="form-control" value="" rows="6" cols="100" <?=((isset($_GET['view']))?'readonly':'');?>><?=((isset($description))?$description:'');?></textarea>
                    </div>
                    <hr class="bhr"/>
                    <div class="col-xs-12">
                      <?php if(isset($_GET['edit'])) { ?>
                        <div class="col-xs-6 col-xs-offset-4">
                          <button class="btn btn-default" style="width:20%; display:inline; " name="Edit"><i class="fa fa-plus-square-o"></i> Update</button>
                          <a href="allservices.php" style="width:70%; display:inline; padding:2%" class="btn btn-danger"><span class="ion ion-android-cancel"></span> Cancel</a>
                        </div>
                        <?php } else{ ?>
                          <div class="col-xs-4 col-xs-offset-4">
                            <button class="btn btn-block btn-default" name="Add"><i class="fa fa-floppy-o"></i> Save</button>
                          </div>
                        <?php } ?>
                    </div>
                </fieldset>
              </form>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
