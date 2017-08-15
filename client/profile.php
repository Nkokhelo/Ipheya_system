<?php
   session_start();
   if(isset($_SESSION['Client']))
   {
      require_once('../core/init.php');
      include('includes/head.php');
      include ('../core/logic.php');
      include('../core/controllers/client-controller.php');
   }
   else
   {
     header('Location: ../login.php');
   }
   $profile_page = 'selected';
?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-10 col-xs-offset-1 cb'>
              <form class="form" method="post">
                <fieldset>
                  <legend class='thelegend'> Personal Information</legend>
                    <div class="form-group col-sm-7">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" id="name" value="<?=((isset($a_name))?$a_name:'');?>" placeholder="First name">
                      </div>
                      <div class="form-group col-sm-5">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" name="surname" id="surname" value="<?=((isset($a_surname))?$a_surname:'');?>" placeholder="Last name">
                      </div>
                      <div class="form-group col-sm-5">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email" id="email" value="<?=((isset($a_email))?$a_email:'');?>" placeholder="Email address" readonly>
                      </div>
                      <div class="form-group col-sm-7">
                        <label for="postal">Postal address</label>
                        <input type="text" class="form-control" name="postal" id="postal" value="<?=((isset($a_postal))?$a_postal:'');?>" placeholder="Postal address">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="number">Contact Number</label>
                        <input type="text" class="form-control" name="number" id="number" value="<?=((isset($a_number))?$a_number:'');?>" placeholder="Contact number">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="province">Province</label>
                        <select class="form-control" name="province" id="province">
                          <option value="<?=((isset($a_province)&&$a_province!='default')?$a_province:'');?>"><?=((isset($a_province))?$a_province:'Select province');?></option>
                          <option value="Eastern Cape.">Eastern Cape.</option>
                          <option value="Free State.">Free State.</option>
                          <option value="Gauteng.">Gauteng.</option>
                          <option value="KwaZulu-Natal.">KwaZulu-Natal.</option>
                          <option value="Limpopo.">Limpopo.</option>
                          <option value="Mpumalanga.">Mpumalanga.</option>
                          <option value="Northern Cape.">Northern Cape.</option>
                          <option value="North West.">North West.</option>
                          <option value="Westen Cape.">Westen Cape.</option>
                        </select>
                      </div>
                      <hr style='width:100%'/>
                      <div class="form-group col-xs-12" >
                        <div class="col-sm-6">
                          <input type="submit" name="Update" class="btn btn-success form-control" value="Update">
                        </div>
                      </div>
                    </fieldset>
              </form>
            </div>
            <div class='col-xs-8 col-xs-offset-1 cb'>
              <form class="form" method="post">
                <fieldset>
                  <legend class='thelegend'>Reset password ?</legend>
                  <div class="form-group col-sm-6">
                    <label for="new-password">New password</label>
                    <input type="text" class="form-control" name="new-password" id="new-password" value="" placeholder="New password">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="confirm-password">Confirm password</label>
                    <input type="text" class="form-control" name="confirm-password" id="confirm-password" value="" placeholder="Confirm password">
                  </div>
                  <hr/ style='width:100%'>
                    <div class="form-group col-sm-6">
                      <input type="submit" class="form-control btn btn-warning" name="Change-password" value="Change password">
                    </div>
                    <div class="col-sm-6">
                      <?=isset($error)?$error:''?>
                  </div>
                </fieldset>
              </form>
            </div>
        </div>
      </div>
  </div>
</body>
