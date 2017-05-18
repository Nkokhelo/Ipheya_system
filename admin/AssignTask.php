<?php 
 	require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require('../core/controllers/taskController.php');
     include('includes/employee-session.php');
?>

<div class="col-sm-12">
    <form method="POST" action="AssignTask.php">
        <div class="col-sm-6 b" style="padding-bottom:15px;">
            <h2><?=$title?></h2>
                <hr class="bhr"/>
                <div class="col-sm-12" style="padding-bottom:15px;">
                        <div class="col-sm-12"><b>Task Date </b> <?=$date?> / <b>Task Duration </b> <?=$duration?><hr/></div>
                        <div class="col-sm-2" style="padding-bottom:12px"><b>Description </b></div>
                        <div class="col-sm-10" style="padding-bottom:12px">
                            <?=$description?>
                        </div>
                      <hr style="width:100%"/>
                      <div class="col-sm-12"></div>
                </div>
                <div id='dropemployee' class="col-sm-12" id="container" style="border: dashed 3px #eee; height:250px; padding-top:15px;">
                    <h4>Please drag and drop employee here to add to a task</h4>
                </div>
                <hr class="bhr" style="width:100%"/>
            <button type="submit" class="btn btn-default" name="saveassignment"><span class="glyphicon glyphicon-save"></span> Save</button>
        </div>
        <div class="col-sm-6 shift b">
            <h2>Free Employee</h2>
            <hr class="bhr"/>
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <div class="col-sm-4"><b>Employee Name</b></div> <div class="col-sm-4"><b>Email</b></div> <div class="col-sm-4"><b>Department</b></div>   
                    </div>
                </div>
                <div class="col-sm-12" id="allemp">
                    <?=$freeemployees;?>    
                </div>
            </div>
        </div>
    </form>
</div>
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