<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        // require_once('../core/controllers/supplier-controller.php');
        include('includes/navigation.php');
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
          <!-- service form -->
          <div class="col-sm-10 b" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
            <h2>Add Supplier Information</h2>
            <hr class="bhr">
            <form class="form" action="addsupplier.php" method="post">
              <div class=" alert-danger" id="errors"><?=((isset($display))?$display:'');?></div>
              <div class="form-group col-md-6">
                <h4 style="color:#aaa">Company information</h4>
                <hr class="bhr"/>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="name">Supplier :</label>
                    <input required type="text" name="name" id="name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Company Name">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="address">Address :</label>
                    <input required type="text" name="address" id="address" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="line2">Line-2 :</label>
                    <input required type="text" name="line2" id="line2" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address 2">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="line3">Line-3 :</label>
                    <input required type="text" name="line3" id="line2" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address 3">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="line4">Line-4 :</label>
                    <input required type="text" name="line4" id="line4" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address 4">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-xs-5">
                    <label for="postal">Postal :</label>
                    <input required type="text" name="postal" id="postal" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Code">
                  </div>
                </div>
              </div>



              <div class="form-group col-md-6">
                <h4 style="color:#aaa">Contact Information</h4>
                <hr class="bhr"/>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="fullname">Contact :</label>
                    <input required type="text" name="fullname" id="full_name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Full name">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="telephone">Telephone :</label>
                    <input required type="text" name="telephone" id="telephone" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Telephone">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="mobile">Mobile :</label>
                    <input required type="text" name="mobile" id="mobile" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Mobile Number">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="fax">Fax :</label>
                    <input required type="text" name="fax" id="fax" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Fax Number">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="email">Email :</label>
                    <input required type="email" name="email" id="email" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Email Address">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group col-md-12">
                    <label for="web">Web :</label>
                    <input required type="text" name="web" id="web" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="e.g-www.ipheya.com">
                  </div>
                </div>
              </div>
            
              <hr class="bhr" style="width:100%"/>
              <div class="form-group col-xs-6 col-xs-offset-3 btn-group">
                <a name="savesupplier" href='allsuppliers.php' style="width:50%" class="btn  btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Back to list</a>
                <button type="submit" name="savesupplier" style="width:50%" class="btn  btn-default"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
              </div><div class="clear-fix"></div>
            </form>
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>


<div class="container-fluid" style="margin:1%;">

</div>
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
</script>
<?php include('includes/footer.php'); ?>
