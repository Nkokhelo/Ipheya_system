<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/project-controller.php');
        // include('includes/navigation.php');
        //mfudo...
   }
    else
    {
      header("Location:../login.php");
    }       
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-10 b'>
              <form class="form-horizontal" action="bookings.php" method="POST">
                <fieldset>
                  <legend class="inlegend thelegend">
               Event Bookings
                  </legend>
                  <?=($feedback)?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":""?>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="Name">Name:</label>
                        <div class="col-xs-4">
                            <input required placeholder="Full Name" class="form-control" id='Name' type="text" name ="name "/>
                        </div>
                      
                    </div>
                    <div class="form-group col-xs-12">
                       <label class="col-xs-2 control-label" for="email_address">Email Adress:</label>
                        <div class="col-xs-4">
                            <input required placeholder="please enter your Email address" class="form-control" id='email_address' type="text" name ="email_address "/>
                        </div>
                      
                     </div>
                    <div class="form-group col-xs-12">
                     <label class="col-xs-3 control-label" for="remind ">Remind Me?</label>
                        <div class="col-xs-3">
                            <input type="checkbox" name="remind" value="remind"></input>
                        </div>
                    </div>
                     <label class="col-xs-2 control-label" for="cell_num ">Cell Number:</label>
                        <div class="col-xs-2">
                            <input required placeholder="Cell Number" class="form-control" id='cell_num' type="text" name ="cell_num"/> 
                        </div>                    
                </fieldset>
                <hr class="bhr"/>        
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-4" id='change'>
                            <input  type="submit" id='save' name="bookings" class="btn btn-block btn-success" value="Book"/>
                        </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script>
   $(document).ready(function(){

        $('#sdate').datepicker(
            {
            minDate:0,
            dateFormat: 'yy-mm-dd'
            }
        );


        $('#depart').change(function(){
            var department = $(this).val();
            $.ajax({
                    type:"get",
                    url:"includes/getservice.php",
                    data:"department="+department,
                    success:function(data)
                    {
                        $('#serv').empty();
                        $('#serv').append("<option value=''>~Select~</option>");
                        data=JSON.parse(data);
                        console.log(data);
                        if((data.service_id!=null))
                        {
                         $('#serv').append("<option value='"+data.service_id+"'>"+data.service+"</option>");
                        }                     
                    }
                    });

            $.ajax({
                    type:"get",
                    url:"includes/getprojectmanager.php",
                    data:"department="+department,
                    success:function(data)
                    {
                        $('#employees').empty();
                        $('#employees').append("<option value=''>~Select~</option>");
                        data=JSON.parse(data);
                        console.log(data);
                        if(data.employee_id!=null)
                        {
                            alert(data.emp_no);
                            $('#employees').append("<option value='"+data.emp_no+"'>"+data.name+"</option>");
                        }                        
                    }
                    });
            return false;
        });

   }); 
  </script>
</body>
