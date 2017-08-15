<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/supplier-controller.php');
        include('includes/employee-session.php');
        // include('includes/navigation.php');
<<<<<<< HEAD
=======
        
>>>>>>> accbf54a17fe5b81da2a63dd12f77ac0fc3e6b1d
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
            <div class="col-sm-10 col-sm-offset-1 b" >
            <form class="form" action="addsupplier.php" method="post">
              <fieldset>
                <legend class='thelegend'>Supplier</legend>
                <div class="" id="errors"><?=((isset($display))?$display:'');?></div>
                <!--Company -->
                <div class="col-xs-6">
                  <fieldset>
                    <!-- <legend class="inlegend">Company </legend> -->
                    <div class="form-group col-md-8">
                      <label for="name">Supplier </label>
                      <input required type="text" name="name" id="name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Company Name">
                    </div>
                    <div class="form-group col-md-12">
                      <label for="address">Address :</label>
                      <textarea required  name="address" id="address" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address" ></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="line2">Line-2 :</label>
                      <textarea required name="line2" id="line2" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address 2"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="line3">Line-3 :</label>
                      <textarea required type="text" name="line3" id="line2" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address 3"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="line4">Line-4 :</label>
                      <textarea required type="text" name="line4" id="line4" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Address 4"></textarea>
                    </div>
                    
                  </fieldset>
                </div>

                <!--Contact -->
                <div class="col-xs-6">
                  <fieldset>
                     <!-- <legend class="inlegend">Contact </legend>  -->
                    <div class="form-group col-xs-11">
                      <label for="fullname">Contact :</label>
                      <input required type="text" name="fullname" id="full_name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Full name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="telephone">Telephone :</label>
                      <input required type="text" name="telephone" id="telephone" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Telephone">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="mobile">Mobile :</label>
                      <input required type="text" name="mobile" id="mobile" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Mobile Number">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="fax">Fax :</label>
                      <input required type="text" name="fax" id="fax" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Fax Number">
                    </div>
                    <div class="form-group col-md-12">
                      <label for="email">Email :</label>
                      <input required type="email" name="email" id="email" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Email Address">
                    </div>
                    <div class="form-group col-md-12">
                      <label for="web">Web :</label>
                      <input required type="text" name="web" id="web" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="e.g-www.ipheya.com">
                    </div>
                    <div class="form-group col-xs-5">
                      <label for="postal">Postal Code:</label>
                      <input required type="text" name="postal" id="postal" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Code">
                    </div>
                  </fieldset>
                </div>
              
              <hr class="bhr" style="width:100%"/>
              <div class="form-group col-xs-12">
                <div class="col-xs-3 col-xs-offset-3">
                  <a name="savesupplier" href='allsuppliers.php'  class="btn btn-default form-control"><span class="glyphicon glyphicon-list-alt"></span> All supliers</a>
                </div>
                <div class="col-xs-3">
                  <button type="submit" name="savesupplier"  class="btn  btn-default form-control"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                </div>
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
</script>

