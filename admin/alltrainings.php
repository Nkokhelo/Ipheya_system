<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('../core/logic.php');
  include('includes/head2.php');
  include('../core/controllers/training-controller.php');
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
            <div class='col-xs-12'>

                <div class='col-xs-6'>
                    <ol class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="allemployees.php"> <i class="fa fa-users"></i>  All Employees</a></li>
                    <li class="dropdown active">
                            <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                                Training<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="test.php">Create Test</a></li>
                            </ul>
                        </li>
                    </ol>
                </div><!-- /col-xs-6-->

              <div class="col-xs-11 b">
                <h2>Training</h2><hr class="bhr">
                <div class="col-xs-12">
                    <?=$feedback?>
                </div>
                <table class="table table-hover table-striped">
                   <thead>
                    <th>NAME</th>
                    <th>START DATE</th>
                    <th>END DATE</th>
                    <th>APPLICATIONS</th>
                       <th>ACTION</th>
                   </thead>
                   <tbody>
                       <?php
                           $logic = new Logic();
                           $trainings = $logic->connect()->query("select * from training");
                            foreach($trainings as $training)
                           {
                               $count = $logic->connect()->query("select count(*) as a from training_employee where training_id =".$training['trainingId'])->fetch_assoc();
                               ?> <tr>

                        <td><?php echo $training['tname']?></td>
                        <td><?php echo date_format(date_create($training['startdate']),"d-F-Y H:m-A")?></td>
                        <td><?php echo date_format(date_create($training['enddate']),"d-F-Y H:m-A")?></td>
                        <td><?=$count['a']?></td>
                        <td class="td-actions">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
                                </ul>
                            </div>
                        </td>
                       </tr>
                         <?php
                           }
                         ?>
                   </tbody>
               </table>
               <div class="col-xs-12">
                <div class="row">
                 <hr class="bhr">
                </div>
                <div class="col-xs-6 col-xs-offset-3">
                <button class="btn btn-info btn-block pull-right" data-target="#new-training" data-toggle="modal">Add New</button>
                </div>
               </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>

  <div class="modal fade" tabindex="-1" role="dialog" id="new-training">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Add Training</h4>
	      </div>
            <form method="post" action="">
              <div class="modal-body">
                      <div class="content">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="control-label col-xs-12">Training Name :</label>
                                          <div class="col-xs-12">
                                           <input required type="text" class="form-control" name="training_name" required/>
                                          </div>
                                      </div>
                                      </div>
                                      <div class="col-xs-6">
                                      <div class="form-group">
                                          <label class="control-label col-xs-12">Venue :</label>
                                          <div class="col-xs-12">
                                           <input required type="text" class="form-control" name="venue" required/>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="control-label col-xs-12">Description</label>
                                        <div class="col-xs-12">
                                            <textarea required name="description" id="#descript" rows="5" class="form-control"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                              <div class="row">
                                  <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label col-xs-6">Start Date :</label>
                                      <div class="col-xs-12">
                                       <input required type="text" class="form-control" name="start_date" id="s_date" required/>
                                      </div>
                                  </div>
                              </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-xs-6">End Date :</label>
                                        <div class="col-xs-12">
                                        <input required type="text" class="form-control" name="end_date" id="e_date" required/>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                        <label for="" class="control-label col-xs-6">Post To :</label>
                                        <div class="col-xs-12">
                                            <select class="form-control" syle="with:100%" name="department[]" multiple id="select">
                                                <?=$alld ?>
                                            </select>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                        <label for="" class="control-label col-xs-6">Trainer :</label>
                                        <div class="col-xs-12">
                                            <select class="form-control" syle="with:100%" name="trainerId" id="select">
                                                <?=$allt ?>
                                            </select>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info btn-fill pull-right" name="add_training">Save</button>
                        </div>
                </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" id="Applications">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Add Training</h4>
	      </div>
            <form method="post" action="">
                <div class="modal-body">
                <div class="content">
                    <div class="clearfix"></div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-fill pull-right" name="add_training">Save</button>
                </div>
            </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
    <link rel="stylesheet" href="../assets/plugins/datetimepicker/css/bootstrap-datetimepicker.css">
    <script type="text/javascript" src="../assets/plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>

<script>
        $(document).ready(function() {
        $('#assign-trainer').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget); // Button that triggered the modal
			  var training_id = button.attr("id"); // Extract info from data-* attributes
			   modal = $(this);
			   modal.find('.training-id').html = training_id;
		});
        var today = new Date();
        $('#s_date').datetimepicker({
                    minDate: today,
                    dateFormat: 'yy-mm-dd',
                    showMeridian: true,
                    });
        $('#e_date').datetimepicker({
                    minDate:0,
                    dateFormat: 'yy-mm-dd',
                    showMeridian:true
            }
			);
        });

        $('#select').select2();

    </script>
    <style>
    .select2-container
    {
        width : 100% !important;
    }
    </style>
