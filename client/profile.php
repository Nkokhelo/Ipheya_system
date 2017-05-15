<?php
   require_once('../core/init.php');
   include('../includes/head.php');
   include ('../core/logic.php');
   session_start();
   if(isset($_SESSION['Client']))
   {

   }
   else 
   {
     header('Location: ../login.php');
   }
   include('../core/controllers/client-controller.php');
   $profile_page = 'selected';
 ?>
  <body id="client-dashboard">
    <?php  include('../includes/top-nav.php'); ?>
    <div class="container-fluid" style="padding:1%;">
        <?php include('../includes/sidebar.php'); ?>
        <div class="col-lg-9">
          <div class="col-md-8">
            <div class="row">
              <div class="col-lg-12" id="main-content-header">
                <h4 class="text-center">Account information</h4>
              </div>
            </div>
            <div class="col-md-12" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;padding-bottom:3%;">
              <form class="form" method="post">
                <div class="form-group col-sm-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?=((isset($a_name))?$a_name:'');?>" placeholder="First name">
                </div>
                <div class="form-group col-sm-6">
                  <label for="surname">Surname</label>
                  <input type="text" class="form-control" name="surname" id="surname" value="<?=((isset($a_surname))?$a_surname:'');?>" placeholder="Last name">
                </div>
                <div class="form-group col-sm-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?=((isset($a_email))?$a_email:'');?>" placeholder="Email address" readonly>
                </div>
                <div class="form-group col-sm-6">
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
                <div class="form-group" >
                  <div class="col-sm-6">
                    <input type="submit" name="Update" class="btn btn-success form-control" value="Update">
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-12" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;padding:2% 0;">
              <form class="form" method="post">
                <div class="form-group col-sm-6">
                  <label for="new-password">New password</label>
                  <input type="text" class="form-control" name="new-password" id="new-password" value="" placeholder="New password">
                </div>
                <div class="form-group col-sm-6">
                  <label for="confirm-password">Confirm password</label>
                  <input type="text" class="form-control" name="confirm-password" id="confirm-password" value="" placeholder="Confirm password">
                </div>
                <div class="col-md-12">
                   <div class="form-group col-sm-6">
                    <input type="submit" class="form-control btn btn-warning" name="Change-password" value="Change password">
                  </div>
                  <div class="col-sm-6">
                    <?=isset($error)?$error:''?>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">

          </div>
        </div>
    </div>
  </body>
</html>
