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

                <div class='col-xs-12'>
                    <ol class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="allemployees.php"> <i class="fa fa-users"></i> All EMployees</a></li>
                    <li><a href="alltrainings.php"> <i class="fa fa-laptop"></i> Trainings</a></li>
                    <li class="dropdown active">
                      <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                      Create Test<b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="addquestion.php">Add Questions</a></li>
                      </ul>
                  </li>
                    </ol>
                </div><!-- /col-xs-6-->

              <div class="col-xs-11 b">
                <h2>Add Test Question</h2><hr class="bhr">
                <div class="col-md-12">
                    <div class="card">
                    <div class="header">
                        <button class="btn btn-info btn-fill pull-right" data-target="#new-training" data-toggle="modal">Add New</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <?= $feedback ?>
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Test Name</th>
                                <th>Training</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                    $testlist = $method->query("select t.test_id, t.test_name as testname,tr.tname from test t, training tr where t.training_id=tr.trainingId");
                                    while($test = $testlist->fetch_assoc())
                                    {?> <tr>
                                            <td><?php echo $test['testname']?></td>
                                            <td><?php echo $test['tname']?></td>
                                            <td class="td-actions">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a type="button" href="/ipheya/admin/question.php?test=<?php echo $test['test_id']?>"> <i class="glyphicon glyphicon-edit"></i> write test</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            </td>
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
      </div>
  </div>
  <?php include('includes/footer.php'); ?>

<div class="modal fade" tabindex="-1" role="dialog" id="new-training">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Test</h4>
            </div>
            <form method="post">
            <div class="modal-body">

            <div class="content">
                    
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Test Name</label>
                            <input type="text" class="form-control" name="test-name" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Test Date</label>
                            <input type="date" class="form-control" name="test-date" required/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Training</label>
                            <select class="form-control" name="training-id">
                            <?php
                                $trainings = $method->query("select trainingId,tname from training");

                                while($training = $trainings->fetch_assoc())
                                {?>
                                    <option value="<?php echo $training['trainingId']; ?>"><?php echo $training['tname']; ?></option>
                            <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                </div>

                        
                <div class="clearfix"></div>
                    
                
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-fill pull-right" name="add-test">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="assign-trainer">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Assign A Trainer</h4>
            </div>
                <form method="post">
                <div class="modal-body">

                <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select A Trainer</label>
                                    <select class="form-control" name="trainer-id">
                                        <?php
                                        $trainers = $method->query("select * from trainer");
                                        while($trainer =$trainers->fetch_assoc())
                                            {?>
                                            <option value="<?php echo $trainer['id']?>"><?php echo $trainer['name']?> - <?php echo $trainer['qualification']?> - <?php echo $trainer['type']?></option>
                                            <?php }
                                            ?>
                                    </select>
                                    <p type="hidden" class="training-id" name="training-id"></p>
                                </div>
                            </div>
                        </div>                                    
                        <div class="clearfix"></div>
                    
                
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-info btn-fill pull-right" name="add-test">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="assign-department">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Assign A Department</h4>
            </div>
                <form method="post">
                <div class="modal-body">

                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select A Department</label>
                                    <select class="form-control" name="trainer-id">
                                        <?php
                                            $response = $method->query("select * from department");
                                            while($department = $response->fetch_assoc())
                                                {?>
                                                <option value="<?php echo $trainer['department_id']?>"><?php echo $trainer['department']?></option>
                                                <?php }
                                                ?>
                                    </select>
                                    <p type="hidden" class="department-id" name="department-id"></p>
                                </div>
                            </div>
                        </div>                                    
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-fill pull-right" name="add-trainer">Save</button>
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
    $(".table").dataTable();
    </style>