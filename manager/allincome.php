<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        // require_once('../core/controllers/incomes-controller.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>

<body>
<style>
  a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
    content: '';
  }
  a[aria-expanded="true"]::before {
    content: '';
}
</style>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-10 b'>
              <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" ><a href="#list"  aria-controls="home" role="tab" data-toggle="tab">All Incomes</a></li>
                  <li role="presentation" class="active"><a href="#newincome"  aria-controls="profile" role="tab" data-toggle="tab">New Income</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade" id="list">

                  </div>
                  <div role="tabpanel" class="tab-pane fade  in active" id="newincome">
                    <div class="col-xs-12">
                        <form class="form-horizontal" enctype="multipart/form-data" id='expenceForm' method="post" action='allexpence.php'>
                          <fieldset>
                            <!-- must have a feedback -->
                            <legend class="inlegend">Income Information</legend>
                              <div class="form-group col-xs-12">
                            <!-- Income type  -->
                                    <label class="col-xs-2 control-label" for="ei_type">Income type :</label>
                                    <div class="col-xs-3">
                                        <select class="selectpicker form-control" id='income_t' type="text" name ="ei_type">
                                            <option style="backgroud:#aaa" value="">--Select--</option>
                                            <option value="p">Payament</option>
                                            <option value="r">Refund</option>
                                        </select>
                                    </div>
                            <!--Supplier  -->
                                    <label class="col-xs-2 control-label supplier" id="supplier" for="supplier_no">Supplier:</label>
                                    <div id="supplier" class="col-xs-4 supplier">
                                        <input id="supplier" list="suppliers" class="form-control" name="supplier_no"></input>
                                        <datalist id="suppliers">
                                          <?=($suppliers_dd)?$suppliers_dd:""?>
                                        </datalist>
                                    </div> 
                            <!--client  -->
                                    <label id="client" class="col-xs-2 control-label client" for="client_no">Client:</label>
                                    <div id="client" class="col-xs-5 client">
                                        <input id="client" list="clients" class="form-control" name="client_no"></input>
                                        <datalist id="clients">
                                          <?=($clients_dd)?$clients_dd:""?>
                                        </datalist>
                                    </div>                             
                              </div>
                             <hr  style="width:100%"/>

                            <!--Income inforamtion  -->
                              <div class="form-group col-xs-12">
                                <!-- Income name  -->
                                <label class="col-xs-2 control-label" for="ei_name">Name :</label>
                                <div class="col-xs-4">
                                    <input required placeholder="A4 transpotation" class="form-control" id='income_name' type="text" name ="ei_name"/>
                                </div>

                                <!-- Reference  -->
                                <label class="col-xs-2 control-label" for="ref">Reference :</label>
                                <div class="col-xs-3">
                                    <input required placeholder="#0056" class="form-control" id='ref' type="text" name ="ref_id" row='15' col=''></input>
                                </div>  
                                
                              </div>
                            <!-- Transaction Description-->
                              <div class="form-group col-xs-12">
                                <label class="col-xs-2 control-label" for="details"> Description: </label>
                                <div class="col-xs-10">
                                    <textarea required placeholder="Mr John Sith- 50 A4 pack Deliviries" class="form-control" id='details' type="text" name ="details" rows="5" cols="10"></textarea>
                              </div>                              
                            </div>
                            <hr style="width:100%"/>
                            <div class="form-group col-xs-12">
                            <!-- Date  -->
                                <label class="col-xs-2 control-label" for="t_date">Date :</label>
                                <div class="col-xs-3">
                                    <input required placeholder="2017-05-09" class="form-control" id='t_date' type="text" name ="ei_date" row='15' col=''></input>
                                </div>  
                                     
                            <!-- Payment Type -->
                                <label class="col-xs-2 control-label col-xs-push-1" for="payment_type">Payment type:</label>
                                <div class="col-xs-3 col-xs-push-1">
                                <select class="selectpicker form-control" title="Please select" id='program_name' type="text" name ="ei_payment_type">       
                                    <option style="background:#aaa">--None--</option>
                                    <option value="cash">Cash Payment</option>
                                    <option value="card">Card Payement</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                            <!-- category  -->
                                <label class="col-xs-2 control-label" for="income_name">Category :</label>
                                <div class="col-xs-4">
                                    <select class="form-control" name="category_id">
                                        <option style="background:#aaa">--None--</option>
                                        <?=$categories_dd?>
                                    </select>
                                </div> 
                                <label class="col-xs-2 control-label" for="amount">Amount :</label>
                                <div class="col-xs-4">
                                   <input type="text" class="form-control" name="ei_amount" value="" id="amount">
                                </div> 
                              </div>
                                <hr style="width:100%"/>  
                              <div class="col-xs-12"> 
                            <!-- project  -->
                                <h5 class="col-xs-12" style="color:#999"> <b>Link this income to a project</b></h5><br/>
                                <label class="col-xs-2 control-label" for="income_name">Project:</label>
                                <div class="col-xs-4">
                                    <select class="form-control" name="project_no">
                                        <option style="background:#aaa">--None--</option>
                                        <?=$project_dd?>
                                    </select>
                                    <br/>
                                </div>
                              </div>
                              <hr style="width:100%"/>
                              <div class="col-xs-12">
                            <!-- fie decition  -->
                                <div class="form-group col-xs-12">
                                    <div class="col-xs-6">
                                      <label for="choose">Income Attachemnts?</label>
                                      <div class="col-xs-12" id="selection">
                                        <label class="radio-inline"><input id="yes" type="radio" name='choose' value="yas">Yes</label>
                                        <label class="radio-inline"><input id="no" type="radio" name='choose' value="no" selected='true'>No</label>
                                      </div>
                                    </div>
                                    <div class="col-xs-6" id="files">
                                      <label for="choose">Please choose a file pdf/png/jpg/</label>
                                      <div class="col-xs-12" >
                                        <input type="file" class="form-control-file" name="attachment[]" multiple/>
                                      </div>
                                    </div>
                                </div>  
                            </div>
                            <hr class="bhr" style="width:100%"/>
                            <div class="form-group col-xs-12">
                              <div class="col-xs-4 col-xs-offset-4">
                                <button class="btn btn-block btn-primary" name="save">Save</button>
                              </div>
                            </div>
                          </fieldset>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>

  <script>
    $(document).ready(function(){
        $('.supplier').hide();
        $('.client').hide();
        $('#files').hide();

        $('#t_date').datepicker(
          {
          maxDate:0,
           dateFormat: 'yy-mm-dd'
          }
        );
         $("#amount").keydown(function (e) {
              // Allow: backspace, delete, tab, escape, enter and .
              if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                  // Allow: Ctrl+A, Command+A
                  (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                  // Allow: home, end, left, right, down, up
                  (e.keyCode >= 35 && e.keyCode <= 40)) {
                      // let it happen, don't do anything
                      return;
              }
              // Ensure that it is a number and stop the keypress
              if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                  e.preventDefault();
              }
        });
        $('#yes').click(function(){
          $('#files').show();
        });
        $('#no').click(function(){
          $('#files').hide();
        });
          $('#income_t').change(function(){
            var p_type = $(this).val();
            if(p_type=='r')
            {
              $('.supplier').hide();
              $('.client').show();
            }
            else if(p_type=='p')
            {
              $('.supplier').show();
              $('.client').hide();
            }
            else
            {
              $('.supplier').hide();
              $('.client').hide();
            }
          });

          //form validator file 
          $('INPUT[type="file"]').change(function () {
            var ext = this.value.match(/\.(.+)$/)[1];
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'pdf':
                    $('#uploadButton').attr('disabled', false);
                    break;
                default:
                    alert('This is not an allowed file type.');
                    this.value = '';
              }
          });
    });
  </script>
</body>