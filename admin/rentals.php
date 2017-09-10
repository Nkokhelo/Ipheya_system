<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/rentals-controller.php');
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
            <div class='col-xs-11 b'>
              <form class="form-horizontal"enctype="multipart/form-data" method="POST">
                <fieldset>
                  <legend class="inlegend thelegend">
                    <?php if(isset($_GET['prog'])) { ?>
                    Add project to <?php echo($logic->getProgramByNo($_GET['prog'])['program_name']) ?> projects
                    <?php } else { ?>  
                        Add Rental assets
                    <?php } ?>
                  </legend>
                  <?=($feedback)?"<div class='".$feedback['alert']."'>".$feedback['message']."</div>":""?>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-11">
                        <label class="col-xs-2 control-label" for="project_name">Asset Code :</label>
                        <div class="col-xs-4">
                            <input required placeholder="#27845567" class="form-control" id='asset_code' type="text" name ="asset_code"/>
                        </div>
                        <!---->
                        <input type="hidden" name="catergory" value="" />
                        <label class="col-xs-2 control-label" for="catergory">Catergory:</label>
                        <div class="col-xs-4">
                        <select class="selectpicker form-control" title="Please select" id='catergory' type="text" name ="catergory">       
                            <option value="">~Select~</option>
                            <option value="1">printer</option>
                        </select>
                        </div>
                    </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-10">
                        <label class="col-xs-2 control-label" for="project_name">Name :</label>
                        <div class="col-xs-4">
                            <input required placeholder="Wifi Project" class="form-control" id='name' type="text" name ="name"/>
                        </div>
                    </div>
                 </div>
                    <div class="form-group col-xs-11">
                        <label class="col-xs-2 control-label" for="description">Description :</label>
                        <div class="col-xs-10">
                            <textarea class="form-control" id='description' name ="description" rows="5" cols="10"></textarea>
                        </div>
                    </div>
                 </div>
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="">Puchse date :</label>
                        <div class="col-xs-3  input-group input-append " id='dsdate'style='padding-left:15px; float: inherit;'>
                            <input required placeholder="2017-08-09" class="form-control " id='sdate' name ="purchase_date" rows="5" cols="10"></input>
                            <span class="input-group-addon" id=''><i class='glyphicon glyphicon-calendar'></i></span>
                        </div>
                                 <label class="col-xs-2 control-label" for="charge">Charge :</label>
                        <div class="col-xs-2  input-group input-append " style='padding-left:15px; float: inherit;'>
                            <input required placeholder="18,00" class="form-control " id='charge' name ="charge"></input>
                        </div>   
                        <label class="col-xs-2 control-label col-xs-pull-1" for="charge">Per/day</label>
                   </div>
                    <div class="form-group col-xs-3">
                       <label  for="">Select image to upload:</label>
                            <input type="file" name="rentalimage" id="rentalimage"/>
                        </div>
                     
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="visibility">Visibility :</label>
                        <div class="col-xs-9  input-group input-append "style='padding-left:15px; float: inherit;'>
                            <label class="radio-inline"><input type="radio" name="visibility" value=1> All <i class="fa fa-group" style="color:#0094ff"></i></label>
                            <label class="radio-inline"><input type="radio" name="visibility" value=2> Client <i class="fa fa-globe" style="color:#0094ff"></i></label>
                       </div>
                    </div>
                </fieldset>
                <hr class="bhr"/>        
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-8" id='change'>
                            <input  type="submit" id='save' name="save_rentals" class="btn btn-block btn-success" value="Add New"/>
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