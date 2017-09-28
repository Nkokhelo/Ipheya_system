<?php
   session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        include('includes/employee-session.php');
        require('../core/controllers/taskController.php');
        // include('includes/navigation.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>
<body>
  <div class="wrapper">
      <?php include('includes/sidebar.php');?>
      <div id='content'>
        <div class='row'>
            <div class="col-xs-11 b">
                <fieldset>
                    <legend class="thelegend">Assign Employee</legend>
                    <form method="POST" action="AssignTask.php">
                    <div class="col-xs-6">
                            <fieldset>
                                <legend class="inlegend">Task Information</legend>
                                <div class="form-group col-xs-6">
                                    <label clas="control-label col-xs-6">Title :</labe>
                                    <?=$title?>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label clas="control-label col-xs-6">Duration :</labe>
                                    <?=$duration?>(s)
                                </div>
                                <div class="form-group col-xs-12">
                                    <label clas="control-label col-xs-12">Description :</labe>
                                    <textarea class='form-control col-xs-12' style="heigh:90px; width:420px" row='30' col="30" readonly><?=$description?></textarea>
                                </div>
                                <div id='dropemployee' class="col-sm-12" id="container" style="border: dashed 3px #eee; height:250px; padding-top:15px;">
                                <?= ((isset($error))? $error: "<h4>Please drag and drop employee here to add to a task</h4>");?>
                                </div>
                            </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend class='inlegend'>Employees</legend>
                        </fieldset>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="col-sm-4"><b> Name</b></div> <div class="col-sm-4"><b>Email</b></div> <div class="col-sm-4"><b>Department</b></div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="allemp">
                                <?=$freeemployees;?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <hr style="width:100%"/>
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="submit" class="btn btn-default form-control" name="saveassignment"><span class="glyphicon glyphicon-save"></span> Save Task</button>
                            </div>
                        </div>
                </form>
                </fieldset>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
   $(document).ready(function()
   {
       var id, empname, email, department, task="";

       $('#allemp .col-sm-12').draggable({
            helper: employee,
            opacity: 1,
            cursor:'move',
             stop: function()
             {
                dragCheck = false;
            }

       });
      $( "#dropemployee" ).droppable({
            drop: function(e, ui)
            {
                var employee =ui.draggable.attr('id').split("_");
                id=employee[0];
                empname=employee[1];
                email=employee[2];
                department=employee[3];
                task =employee[4];
                $('#dropemployee').append('<div id="emplist" class="alert alert-success alert-dismissable" style="opacity:1;">  <a href="AssignTask?assign='+task+'&remove='+id+'" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'+empname+' </b> from '+ department+' department is assigned !<input type="hidden" name="EmpId[]" value="'+id+'"/><input type="hidden" name="Task" value="'+task+'"/></div>');
                ui.draggable.remove().html();
                $('#dropemployee h4').remove();

            },cursor:'move'

      });
      function employee(event,ui)
      {
        return '<div class="alert alert-info">Employee is dragged !</div>';
      }
      $("#dropemployee div").dblclick(function()
      {
          alert("The paragraph was double-clicked");
      });

   });
</script>
