<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/event-controller.php');
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

        <div class='col-xs-12'>
            <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Events </li>
            </ol>
          </div><!-- /col-xs-6-->

            <div class='col-md-11 b'>
              <form class="form" action="" enctype="multipart/form-data" class="form" method="POST">
                <fieldset>
                  <legend class="inlegend thelegend">
                Events
                  </legend>
                  <?=($feedback)? $feedback:""?>
  
                        <div class="form-group col-md-5">
                            <label for="event_name">Name :</label>
                            <input required placeholder="Event Name" class="form-control" id='event_name' type="text" name ="name"/>
                        </div>
 
                        <div class="form-group col-md-8">
                            <label for="description">Description :</label>
                            <textarea class="form-control" placeholder="Event Name" id='description' name ="description" rows="5" cols="10"></textarea>
                        </div>
 
                        <div class="form-group col-md-4">
                            <label for="">Start  :</label>
                            <input required placeholder="----/--/--" class="form-control " id='sdate' name ="sdate" rows="5" cols="10"></input>
                        </div>
 
                        <div class="form-group col-md-4">
                            <label for="">End date :</label>
                            <input required placeholder="----/--/--" class="form-control " id='edate' name ="edate" rows="5" cols="10"></input>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="category" >Category :</label>
                            <select id="depart" class="form-control" name="category">
                                <option value=''><b>~~Select~~</b></option> 
                                <option>Innovation & new technology</option>   
                                <option>New System Updates</option>  
                                <option>Customer Empowerment</option>                            
                            </select>
                        </div>
 
                        <div class="form-group col-md-11">
                            <label  for="">Select image to upload:</label>
                            <input type="file" name="eventimage" id="eventimage"/>
                        </div>
    
                </fieldset>
                <hr class="bhr"/>        
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6" id='change'>
                            <input  type="submit" id='save' name="Add" class="btn btn-block btn-success" value="Add"/>
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
        $('INPUT[type="file"]').change(function () {
        var ext = this.value.match(/\.(.+)$/)[1];
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                $('#uploadButton').attr('disabled', false);
                break;
            default:
                alert('This is not an allowed file type.');
                this.value = '';
            }
        });
        $('#sdate').datepicker(
            {
            minDate:0,
            dateFormat: 'yy-mm-dd'
            }
        );
        $('#edate').datepicker(
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