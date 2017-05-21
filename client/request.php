<?php
   require_once('../core/init.php');

   session_start();
   if(isset($_SESSION['Client']))
   {
      include('../core/logic.php');
      include('../includes/head.php');
      include('../includes/top-nav.php');
      include('../core/controllers/client-controller.php');
      include('../core/controllers/service-controller.php');
      include('../core/controllers/request-controller.php');
      $request_page = 'selected';
   }
   else
   {
     header('Location: ../login.php');
   }

 ?>
   <div class="row">
      <?php include('../includes/sidebar.php'); ?>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 b">
                <h4>Request</h4>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#SR"  data-toggle="tab">Service</a>
						</li>
						<li>
							<a href="#MR"  data-toggle="tab">Maintanance</a>
						</li>
						<li>
							<a href="#" data-toggle="tab">Repair</a>
						</li>
						<li>
							<a href="#"  data-toggle="tab">Survey</a>
						</li>
					</ul>
                <div class="tab-content">
                      <div id="SR" class="tab-pane fade in active">
                        <form class="form" method="post">
                        <br/>
                          <div class=""><?=((isset($gr_display))?$gr_display:'');?></div>
                            <div class="form-group">
                              <label for="service">Service type</label>
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
                      <div id="MR" class="tab-pane fade">
                            <form class="form" method="post">
                              <!--<legend class="text-center">Maintenance</legend>--><br/>
                                <div class="">
                                <?=((isset($mr_display))?$mr_display:''); ?></div>
                                <div class="form-group col-sm-6">
                                  <label for="maintenance">General services</label>
                                  <select class="form-control" id="maintenance" name="maintenance">
                                    <option value="">Select service</option>
                                    <?=$allServicesDDL;?>
                                    <<option value="0">Other</option>
                                  </select>
                                </div>
                                <div class="form-group col-sm-6">
                                  <label for="specify">If selected service is other</label>
                                  <input type="text" name="specify" class="form-control" id="specify" value="" placeholder="please specify"/>
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
                                    <option value="6">6 months</option>
                                    <option value="12">12 months</option>
                                    <option value="24">24 months</option>
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
      </div>
  </div>

  </body>
</html>
