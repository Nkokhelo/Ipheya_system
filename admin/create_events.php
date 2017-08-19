<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/project-controller.php');
        // include('includes/navigation.php');
        
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
              <form class="form-horizontal" action="Events.php" method="POST">
                <fieldset>
                  <legend class="inlegend thelegend">
                Events
                  </legend>
                  <?=($feedback)?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":""?>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="event_name">Name :</label>
                        <div class="col-xs-4">
                            <input required placeholder="Create New Event Name" class="form-control" id='event_name' type="text" name ="name "/>
                        </div>
                       
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="description">Description :</label>
                        <div class="col-xs-10">
                            <textarea class="form-control" id='description' name ="description" rows="5" cols="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="department" class="control-label col-xs-2">Category :</label>
                        <div class="col-xs-4">
                            <select id="depart" class="form-control" name="category">
                                <option value=''><b>~~Select~~</b></option> 
                                <option>Innovation</option>   
                                <option>New Technologies</option>  
                                <option>Buisness empowerment</option>                            
                            </select>
                        </div>                     
                    </div>

                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="">Event date :</label>
                        <div class="col-xs-3  input-group input-append " id='dsdate'style='padding-left:15px; float: inherit;'>
                            <input required placeholder="2017-08-09" class="form-control " id='sdate' name ="date" rows="5" cols="10"></input>
                            <span class="input-group-addon" id=''><i class='glyphicon glyphicon-calendar'></i></span>
                        </div>
                        <label class="col-xs-3 control-label" for="">Duration :</label>
                        <div class="col-xs-3  input-group input-append " id='dsdate'style='padding-left:15px'>
                            <input required placeholder=" " placeholder='6' class="form-control"style="width:30%" id='duration' name ="duration" rows="5" cols="10"></input>
                            <select name="duration_type" class="form-control"style="width:70%;background:#eee">
                                <option value="1">Hour(s)</option>
                                <option value="1">Day(s)</option>
                                <option value="2">Week(s)</option>  
                                <option value="2">Month(s)</option> 
                            </select>
                        </div>
                    </div>  
                    
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                 Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
                </form>  

                </fieldset>
                <hr class="bhr"/>        
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-8" id='change'>
                            <input  type="submit" id='save' name="Create_Event" class="btn btn-block btn-success" value="create"/>
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