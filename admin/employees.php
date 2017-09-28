<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/employee-controller.php');
        include('includes/employee-session.php');
        // include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<style>
#profileImage
{
    cursor: pointer;
}

#profile-container {
    width: 100%;
    height: 100%;
    padding:0 !important;
    overflow: hidden;
}
#image-preview
{
  padding:0;
}
#profile-container img {
    width: 100%;
    height: 100%;
}
</style>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-11 b'>
                  <form class="form" action="employees.php<?=((isset($_GET['edit']))?'?edit='.$_GET['edit']:'');?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                      <legend class="thelegend inlegend"><?=((isset($_GET['edit']))?'Edit':'Add');?> Employee</legend>
                        <div class="" id="errors"><?=((isset($display))?$display:'');?></div>
                        <?=($feedback)?$feedback:''?>
                        <div class="form-group col-md-4" id="image-preview">
                          <div id="profile-container">
                            <image id="profileImage" />
                          </div>
                          <input type="file" name="profile_pic" id="profile_pic" placeholder="Photo"  capture/>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="title">Title</label>
                          <select name="title" id="title" class="form-control">
                            <option value="<?=((isset($title))?$title:'');?>"><?=((isset($title))?$title:'--Select--');?></option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Ms.">Ms.</option>
                          </select>
                        </div>
                        <div class="form-group col-md-5">
                          <label for="name">Name</label>
                          <input type="text" name="name" id="name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="First Name">
                        </div>

                        <div class="form-group col-md-4">
                          <label for="surname">Last name</label>
                          <input type="text" name="surname" id="surname" class="form-control" value="<?=((isset($surname))?$surname:'');?>" placeholder="Last Name">
                        </div>

                        <div class="form-group col-md-3">
                          <label for="gender">Gender</label>
                          <select name="gender" class="form-control" id="gender">

                            <option value="<?=((isset($gender))?$gender:'');?>"><?=((isset($gender))?$gender:'--Select--');?></option>

                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="date">Birth Date</label>
                          <input type="text"placeholder="- - - - / - - /- -" name="date" class="form-control" id="date" value="<?=((isset($date))?$date:'');?>">
                        </div>

                        <div class="form-group col-md-4">
                          <label for="identity">ID number</label>
                          <input type="text" name="identity" class="form-control" id="identity" value="<?=((isset($identity))?$identity:'');?>" placeholder="ID number" maxlength="13">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="number">Contact number</label>
                          <input type="text" name="number" id="number" class="form-control" value="<?=((isset($number))?$number:'');?>" placeholder="Phone-Number" maxlength="10">
                        </div>
                        <div class="form-group col-xs-4">
                          <label for="department">Department</label>
                            <select class="form-control" name="department" id="department">
                              <option>--Select Department--</option>
                              <?=$allDepartments;?>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                          <label for="email">Email address</label>
                          <input type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="abcdefg@email.com">
                        </div>

                        <div class="form-group col-md-8">
                          <label for="residential">Residential address preview</label>
                          <textarea type="text" name="residential" data-toggle="modal" data-target="#addresses" id="residential" class="form-control" value="<?=((isset($residential))?$residential:'');?>" placeholder="enter residential addres" readonly></textarea>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="postal">Postal address preview</label>
                          <textarea type="text" name="postal" data-toggle="modal" data-target="#addresses" id="postal" class="form-control" value="<?=((isset($postal))?$postal:'');?>" placeholder="anter postal address" readonly></textarea>
                        </div>

                        <hr class="bhr" style="width:100%"/>
                        <div class="form-group col-xs-3 col-xs-offset-3">
                          <button type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" class="btn btn-default btn-block"><span class="glyphicon glyphicon-floppy-save"></span> <?=((isset($_GET['edit']))?'Save Changes':'Add Employee');?></button>
                        </div>
                        <div class="form-group col-xs-3">
                          <a href='allemployees.php' class="btn btn-default btn-block"><span class="glyphicon glyphicon-list-alt"></span><i class="fa fa-check-square"></i> Employee List</a>
                        </div>
                    </fieldset>
                  </form>
                  <?php include('includes/address-modal.php'); ?>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

<script>
   var date = new Date();
  	$("#date").datepicker(
							{
								dateFormat: 'yy/mm/dd',
                changeYear:true,
                changeMonth:true,
                yearRange: "-40:-18"
							}
						);
    $('#table').dataTable();
    $('INPUT[type="file"]').change(function () {
      var ext = this.value.match(/\.(.+)$/)[1];
      switch (ext) {
          case 'jpg':
          case 'jpeg':
          case 'png':
          case 'gif':
              $('#uploadButton').attr('disabled', false);
              $('#profile_label').hide();
              break;
          default:
              alert('This is not an allowed file type.');
              this.value = '';
          }
      });
                        // Default: false
  <?php if($image !=null) {
    echo "$('#profileImage').attr('src', 'data:image; base64,".$image."');";
  }
  else
  {
    echo "$('#profileImage').attr('src', '/ipheya/assets/images/profile.jpg');";
  } ?>

  $("#profileImage").click(function(e) {
    $("#profile_pic").click();
  });

  function fasterPreview( uploader ) {
      if ( uploader.files && uploader.files[0] ){
            $('#profileImage').attr('src',window.URL.createObjectURL(uploader.files[0]) );
      }
  }

  $('INPUT[type="file"]').change(function(){
      fasterPreview( this );
  });

</script>
