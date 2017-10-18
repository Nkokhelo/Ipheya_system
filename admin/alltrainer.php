<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('../core/logic.php');    
  include('includes/head2.php');
  include('../core/controllers/trainer-controller.php');
}
else
{
  header("Location:../login.php");
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>

            <div class="col-xs-6">
              <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>		  
                <li class="active"> <i class="fa fa-yelp"></i> Trainers</li>		  
              </ol>
            </div><!-- /col-xs-6-->


              <div class="col-xs-11 b">
                <h2>All Trainers</h2><hr class="bhr">
                <div class="col-xs-12"><?=$feedback?></div>
                <div class="col-md-12">
                            <div class="header">
                                <button type="submit" class="btn btn-info btn-fill pull-right" data-target="#new-trainer" data-toggle="modal">Add New</button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    	<th>Full Name</th>
                                    	<th>Address</th>
                                    	<th>Cell Number</th>
                                    	<th>Type</th>
                                        <th>Number of Trainings</th>
                                       
                                    </thead>
                                    <tbody>
                                        <?php
                                            $trainers = $method->query("select t.*,(select count(*) from trainer_training where trainerid=t.trainerId) as count from trainer t");
                                             foreach($trainers as $trainer)
                                            {?> 
                                            <tr>
                                              <td><?php echo $trainer['trainername']?></td>
                                              <td><?php echo $trainer['address']?></td>
                                              <td><?php echo $trainer['contact']?></td>
                                              <td><?php echo $trainer['trainertype']?></td>
                                              <td><?php echo $trainer['count']?></td>
                                            </tr>
                                          <?php
                                            }
                                          ?>
                                    </tbody>
                                </table>

                            </div>
                            
                    </div>


              </div>
        </div>
      </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="new-trainer">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Add Trainer</h4>
	      </div>
            <form method="post" action="">
	      <div class="modal-body">
           
                            <div class="content">
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Trainer Name</label>
                                                <input type="text" class="form-control" name="trainer-name" required/>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Qualification</label>
                                                <input type="text" class="form-control" name="qualification" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="trainer-address" required/>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Cell Number</label>
                                                <input type="text" class="form-control" pattern="[0]{1}[6-8]{1}[1-4,6,8,9]{1}[0-9]{7}" name="cell-number" required/>
                                            </div>
                                        </div>
                                       
                                    </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" name="type">
                                                <option>Select Trainer Type</option>
                                                    <option>Internal</option>
                                                     <option>Outsource</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                
                           
                        </div></div>
	      <div class="modal-footer">
              <button type="submit" class="btn btn-info btn-fill pull-right" name="add-trainer">Save</button>
	      </div>
                </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
  <?php include('includes/footer.php'); ?>
</body>
