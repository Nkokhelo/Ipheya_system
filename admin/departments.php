<?php
    session_start();
    if(isset($_SESSION['Employee']))
    {
      require_once('../core/init.php');
      include('includes/head2.php');
      require_once('../core/controllers/department-controller.php');
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
          <div class="col-sm-offset-1 col-sm-10 b">
            <form class="form-inline" action="departments.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post" novalidate>
              <fieldset>
                <legend class='thelegend'>List of all department</legend>
                  <table class="table" style="padding:2%;" id="departments">
                    <thead>
<<<<<<< HEAD
                      <th>Department Name</th><th><span class="fa fa-users"></span>Department Email</th><th>Options</th>
=======
                      <th>Department Name</th><th></span>Department Email</th><th>Options</th>
>>>>>>> accbf54a17fe5b81da2a63dd12f77ac0fc3e6b1d
                    </thead>
                    <tbody>
                      <div  class="form-group col-xs-10 col-xs-offset-1">
                        <tr>
                          <td>
                            <input type="text" name="department" id="department" class="form-control" value="<?=((isset($department))?$department:'');?>" placeholder="Department Name">
                          </td>
                          <td>
                            <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="Department Email">
                          </td>
                          <td>
                            <button type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" class="btn btn-md btn-default"><?=((isset($_GET['edit']))?'<span class="glyphicon glyphicon-pencil"></span> Save':'<span class="glyphicon glyphicon-plus-sign"></span> Add');?></button>
                            <?=((isset($_GET['edit']))?'<a href="departments.php" class="btn btn-primary"><span class="ion ion-android-cancel"></span> Cancel</a>':'');?>
                          </td>
                        </tr>
                      <?=$allDepartments;?>
                      </div>
                    </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
              </fieldset>
            </form>
            <hr class="bhr"/>            
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
  $('#departments').dataTable();
</script>
