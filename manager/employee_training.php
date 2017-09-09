<?php
   session_start();
   if(isset($_SESSION['Manager']))
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
            <div class='col-xs-11 b'>
              <form class="form-horizontal" action="employee_training.php" method="POST">
                <fieldset>
                  <legend class="inlegend thelegend">
                Trainings
                  </legend>
                  <?=($feedback)? $feedback:""?>
                  <div class="col-xs-9 col-xs-offset-1">
                      <div class="row">
                        <div class="form-group col-xs-7">
                            <label for="email_address">TO :</label>
                            <input required placeholder="makhandaemfene123@gmail.com" class="form-control" id='email_address' type="text" name ="email_address"/>
                        </div>
                       </div>
                        <div class="row">
                            <div class="form-group col-xs-9">
                                <label for="description">Descreption :</label>
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
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <label  for="">Select image to upload:</label>
                                <input type="file" name="eventimage" id="eventimage"/>
                            </div>
                        </div>
                  </div>
                </fieldset>
                <hr class="bhr"/>        
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-8" id='change'>
                            <input  type="submit" id='save' name="send" class="btn btn-block btn-success" value="send"/>
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
            return false;
        });
  </script>
</body>