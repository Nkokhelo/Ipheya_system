<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
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
              <form class="form-horizontal" action="programs.php" method="POST">
                <fieldset>
                  <legend class="inlegend thelegend">
                    Project Information
                  </legend>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="project_name">Name :</label>
                        <div class="col-xs-4">
                            <input required placeholder="Wifi Project" class="form-control" id='project_name' type="text" name ="project_name"/>
                        </div>
                        <!---->
                        <label class="col-xs-2 control-label" for="project_name">Program:</label>
                        <div class="col-xs-4">
                        <select class="selectpicker form-control" title="Please select" id='program_name' type="text" name ="project_name">       
                            <option>~Select~</option>
                             <?=($allprogram)?$allprogram:""?>
                        </select>
                        </div>

                    </div>

                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="description">Description :</label>
                        <div class="col-xs-10">
                            <textarea class="form-control" id='description' name ="description" rows="5" cols="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="department" class="control-label col-xs-2">Department :</label>
                        <div class="col-xs-4">
                            <select id="depart" class="form-control" name="department">
                                <option value=''><b>~~Select~~</b></option>
                                <?=($department)?$department:""?>
                            </select>
                        </div>
                        
                        <label for="service" class="control-label col-xs-2">Service :</label>
                        <div class="col-xs-4">
                            <select id="serv"  class="form-control" name="service">
                                <option name="department">~Select~</option>
                                 <?=( $allServicesDDL)?$allServicesDDL:""?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="">Start date :</label>
                        <div class="col-xs-3  input-group input-append " id='dsdate'style='padding-left:15px; float: inherit;'>
                            <input required placeholder="2017-08-09" class="form-control " id='sdate' name ="sdate" rows="5" cols="10"></input>
                            <span class="input-group-addon" id=''><i class='glyphicon glyphicon-calendar'></i></span>
                        </div>
                        <label class="col-xs-3 control-label" for="">Duration :</label>
                        <div class="col-xs-3  input-group input-append " id='dsdate'style='padding-left:15px'>
                            <input required placeholder=" " placeholder='6' class="form-control"style="width:30%" id='duration' name ="duration" rows="5" cols="10"></input>
                            <select name="duration_type" class="form-control"style="width:70%;background:#eee">
                                <option value="1">Day(s)</option>
                                <option value="2">Week(s)</option>
                                <option value="3">Month(s)</option>
                                <option value="4">Year(s)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="project_qoute">Project Qoute :</label>
                        <div class="col-xs-3 input-group " style='padding-left:15px; float: inherit;'>
                            <input class="form-control" list="browsers" name="browser">
                            <datalist id="browsers">
                                  <?=($allquote )?$allquote :""?>
                            </datalist>
                            </div>
                        <label class="col-xs-3 control-label" for="client_no">Project Manager :</label>
                        <div class="col-xs-3 input-group " style='padding-left:15px'>
                                <select id="employees" class="form-control">
                                    <option value="">~Select~</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="patner">Patner :</label>
                        <div class="col-xs-4  input-group input-append " id='dsdate'style='padding-left:15px; float: inherit;'>
                            <input required placeholder="Ukhamba Ltd" class="form-control " id='patner' name ="patner"></input>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="budget">Budget :</label>
                        <div class="col-xs-2  input-group input-append "style='padding-left:15px; float: inherit;'>
                            <input required placeholder="R 10 000,00" class="form-control " id='budget' name ="budget"></input>
                        </div>
                        <label class="col-xs-4 control-label" for="budget">No of Employees Involved :</label>
                        <div class="col-xs-2  input-group input-append " style='padding-left:15px; float: inherit;'>
                            <input required type="number" placeholder="15" class="form-control " id='emp_no' name ="emp_no"></input>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for='charge'>Charge :</label>
                        <div class="col-xs-6">
                            <input required placeholder="R 1000,00" class="form-control col-xs-3" id='charge' name ="charge"></input>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for='charge'>daily-hour:</label>
                        <div class="col-xs-6">
                            <input required placeholder="8.00" class="form-control col-xs-3" id='hours' name ="hours"></input>
                        </div>
                    </div>
                     </div>
                        <label class="col-xs-4 control-label" for="budget"></label>
                        <div class="col-xs-2  input-group input-append " style='padding-left:15px; float: inherit;'>
                            <input required type="number" placeholder="per-hour" class="form-control " id='hourly' name ="hourly"></input>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="col-xs-2 control-label" for="budget">Visibility :</label>
                        <div class="col-xs-9  input-group input-append "style='padding-left:15px; float: inherit;'>
                            <label class="radio-inline"><input type="radio" name="security"> Private <i class="fa fa-lock" style="color:#0094ff"></i></label>
                            <label class="radio-inline"><input type="radio" name="security"> Team <i class="fa fa-group" style="color:#0094ff"></i></label>
                            <label class="radio-inline"><input type="radio" name="security"> Team & Client <i class="fa fa-globe" style="color:#0094ff"></i></label>
                       </div>
                    </div>

                </fieldset>
                    <hr class="bhr"/>        
                  <div class="col-xs-12">
                        <div class="form-group">
                          <div class="col-xs-offset-2 col-xs-8" id='change'>
                              <input required placeholder=" " type="submit"id='save' name="save_project" class="btn btn-block btn-success" value="create"/>
                              <!--<input required placeholder=" " type="submit"id='edit' name="update_program" class="btn btn-block btn-primary" value="update"/>-->
                              <!--<input required placeholder=" " type="submit"id='delete' name="delete_program" class="btn btn-block btn-danger" value="archive"/>-->
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
        $('#edate').datepicker({
            minDate:0,
            dateFormat: 'yy-mm-dd'
        }
        );
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
                            $('#employees').append("<option value='"+data.employeee_id+"'>"+data.name+"</option>");

                        }                        
                    }
                    });
            return false;
        });

   }); 
  </script>
</body>