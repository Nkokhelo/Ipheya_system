<?php
   require_once('core/init.php');
   include('includes/head.php');

   session_start();
   if(isset($_SESSION['Client'])){

   }
   else {
     header('Location: login.php');
   }
   include('core/controllers/client-controller.php');
   include('core/controllers/service-controller.php');
   include('core/controllers/request-controller.php');
   $request_page = 'selected';
 ?>
  <body id="client-dashboard">
    <?php  include('includes/top-nav.php'); ?>
    <div class="container-fluid" style="padding:1%;">
        <?php include('includes/sidebar.php'); ?>
        <div class="col-lg-9">
          <div class="col-md-8">
            <div class="row">
              <div class="col-lg-12" id="main-content-header">
                <h4 class="text-center">Requests</h4>
              </div>
            </div>
            <div class="col-md-12" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;padding:2%;">
              <form class="form" method="post">
                <legend class="text-center">General services</legend>
                <div class=""><?=((isset($gr_display))?$gr_display:'');?></div>
                <div class="form-group">
                  <label for="service">General services</label>
                  <select class="form-control" id="service" name="service">
                    <option value="">Select service</option>
                    <?=$allServicesDDL;?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="description">Additional information</label>
                  <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <div class="form-group col-sm-6 text-center">
                    <input type="submit" class="btn btn-success form-control" name="Request-service" value="Send Request">
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-12" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;padding:2%;">
              <form class="form" method="post">
                <legend class="text-center">Maintenance</legend>
                <div class=""><?=((isset($mr_display))?$mr_display:'');?></div>
                <div class="form-group col-sm-6">
                  <label for="maintenance">General services</label>
                  <select class="form-control" id="maintenance" name="maintenance">
                    <option value="">Select service</option>
                    <?=$allServicesDDL;?>
                    <<option value="Other">Other</option>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label for="specify">If selected service is other</label>
                  <input type="text" name="specify" class="form-control" id="specify" value="" placeholder="please specify">
                </div>
                <div class="form-group col-sm-6">
                  <label for="frequency">How often do you want us to visit?</label>
                  <select class="form-control" name="frequency" id="frequency">
                    <option value="">Please select.</option>
                    <option value="weekly">weekly</option>
                    <option value="biweekly (every two weeks)">biweekly (every two weeks)</option>
                    <option value="monthly">monthly</option>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label for="period">How long should we support you?</label>
                  <select class="form-control" name="period" id="period">
                    <option value="">Please select.</option>
                    <option value="6 months">6 months</option>
                    <option value="12 months">12 months</option>
                    <option value="24 months">24 months</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="desc">Additional information</label>
                  <textarea name="desc" class="form-control" id="desc" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <div class="form-group col-sm-6 text-center">
                    <input type="submit" class="btn btn-success form-control" name="Request-maintenance" value="Send Request">
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
