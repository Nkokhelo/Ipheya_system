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
                <div id='dropemployee'  class="col-sm-12" id="container" style="border: dashed 3px #eee; height:250px">
                    <h4>Please drag and drop employee here to add to a task</h4>
                    
                </div>
                <hr class="bhr" style="width:100%"/>
            <button type="submit" class="btn btn-default" name="assign"><span class="glyphicon glyphicon-save"></span> Save</button>
        </div>
        <div class="col-sm-6 shift b">
            <h2>Free Employee</h2>
            <hr class="bhr"/>
            <table class="table"  >
                <thead><th>Employee Name</th><th>Department Name</th></thead>
                <tbody id="nkokhelo">
                    <?=$freeemployees;?>
                </tbody>
            </table>
            <input type="text" id="dateTest"/>
        </div>
    </form>
</div>
<script>
   $(document).ready(function() 
   {
       $('#nkokhelo ').draggable({
            helper: employee,
            opacity: 1,
            cursor:'move'
       });
      $( "#dropemployee" ).droppable({
            drop: function(e, ui) 
            {
                // $(this).ui.draggable.remove();
                $('#container').append('<div class="btn btn-success">&times Employee</div><br/>');

                // $(this).append("<tr>"+ui.draggable.remove().html()+"</tr>");
            },cursor:'move'

      });

      function employee( event)
      {
        return '<div class="btn btn-success">Nkokhelo</div>'
      }
   });
</script>