<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/expenses-controller.php');
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
              <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#list"  aria-controls="home" role="tab" data-toggle="tab">All Incomes</a></li>
                  <li role="presentation" ><a href="#newincome"  aria-controls="profile" role="tab" data-toggle="tab">New Income</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="list">
                    <div class="row">
                      <div class="col-xs-12">
                        <?php if($i_trans==''){?>
                          <?=$ifeedback?>
                        <?php } else{ ?>
                          <?=$ifeedback?>
                          <h3 class="text-center" style="color:#888">All Incomes</h3><hr class="bhr"/>
                          <table class="table table-bordered table-hover" id="incomeTable">
                            <thead>
                              <td><th>Ref</th><th>Name</th><thstyle="width:300px">Description</th><th>Price</th></td>
                            </thead>
                            <tbody>
                              <?=$i_trans?>
                            </tbody>
                            <tfoot>
                              
                            </tfoot>
                        </table>
                        <?php }?>
                      </div> 
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="newincome">
                    <div class="col-xs-12">
                        <form class="form-horizontal" enctype="multipart/form-data" id='incomeForm' method="post" action='allincome.php'>
                          <fieldset>
                            <?=($ifeedback)?$ifeedback:""?>
                            <legend class="inlegend">Income Information</legend>
                              <div class="form-group col-xs-12">
                            <!-- Income type  -->
                                    <label class="col-xs-2 control-label" for="ei_type">Income type :</label>
                                    <div class="col-xs-3">
                                        <select class="selectpicker form-control" id='income_t' type="text" name ="ei_type">
                                            <option style="backgroud:#aaa" value="">--Select--</option>
                                            <option value="p">Payment</option>
                                            <option value="r">Refund</option>
                                        </select>
                                    </div>

                                    <div class="col-xs-6 push-1" id="osupplier">
                                        <label class="radio-inline"><input id="s_supplier" type="radio" name='s_choose' value="yas">Suppler</label>
                                        <label class="radio-inline"><input id="s_other" type="radio" name='s_choose' value="no" selected='true'>Other</label>
                                    </div>
                                    
                                    <div class="col-xs-6 push-1" id="oclient">
                                        <label class="radio-inline"><input id="c_client" type="radio" name='c_choose' value="yas">Client</label>
                                        <label class="radio-inline"><input id="c_other" type="radio" name='c_choose' value="no" selected='true'>Other</label>
                                    </div>

                            <!--Supplier  -->
                                    <label class="col-xs-2 control-label supplier" id="supplier_lbl" for="supplier_no">Supplier:</label>
                                    <div id="" class="col-xs-4 supplier">
                                        <input id="supplier" list="suppliers" class="form-control" name="supplier_no"></input>
                                        <datalist id="suppliers">
                                          <?=($suppliers_dd)?$suppliers_dd:""?>
                                        </datalist>
                                    </div> 
                            <!--other  -->
                                    <label class="col-xs-2 control-label other" id="other_lbl" for="other">Specify:</label>
                                    <div id="" class="col-xs-4 other">
                                        <input id="other" list="other" class="form-control" name="other"></input>
                                    </div> 
                            <!--client  -->
                                    <label id="client_lbl" class="col-xs-2 control-label client" for="client_no">Client:</label>
                                    <div id="" class="col-xs-5 client">
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
                                    <input required placeholder="#0056" class="form-control" id='ref' type="text" name ="ref_no" row='15' col=''></input>
                                </div>  
                                
                              </div>
                            <!-- Transaction Description-->
                              <div class="form-group col-xs-12">
                                <label class="col-xs-2 control-label" for="details"> Description: </label>
                                <div class="col-xs-10">
                                    <textarea required placeholder="Mr John Sith- 50 A4 pack Deliviries" class="form-control" id='details' type="text" name ="ei_description" rows="5" cols="10"></textarea>
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
                                        <?=$i_categories_dd?>
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
                                        <input type="file" class="form-control-file" name="attachment" multiple/>
                                      </div>
                                    </div>
                                </div>  
                            </div>
                            <hr class="bhr" style="width:100%"/>
                            <div class="form-group col-xs-12">
                              <div class="col-xs-4 col-xs-offset-4">
                                <button class="btn btn-block btn-primary" name="save_income">Save</button>
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
        $('.other').hide();
        $('#files').hide();
        $('#osupplier').hide();
      $('#oclient').hide();
      $('#incomeTable').dataTable();



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

        // Chaning the client or supplier selection
        $('#income_t').change(function(){
          var p_type = $(this).val();
          if(p_type=='r')
          {
            $('#osupplier').show();
            $('#oclient').hide();
            $('.client').hide();
            $('.other').hide();
            $('.supplier').hide();
          }
          else if(p_type=='p')
          {
            $('#osupplier').hide();
            $('#oclient').show();
            $('.client').hide();
            $('.other').hide();
            $('.supplier').hide();
          }
          else
          {
            $('#osupplier').hide();
            $('#oclient').hide();
            $('.client').hide();
            $('.other').hide();
            $('.supplier').hide();
          }
         $('#s_supplier').attr('checked', false);
         $('#s_other').attr('checked', false);
         $('#c_client').attr('checked', false);
         $('#c_other').attr('checked', false);

        });
        
        //cheking if the client is cliecked
        $('#s_supplier').click(function(){
          $('.supplier').show();
          $('.client').hide();
          $('.other').hide();
          $('#osupplier').hide();
          $('#oclient').hide();

          $('#other').attr('required', false);
          $('#client').attr('required', false);
          $('#supplier').attr('required', true);

        });
        $('#s_other').click(function(){
          $('.supplier').hide();
          $('.client').hide();
          $('.other').show();
          $('#osupplier').hide();
          $('#oclient').hide();
          
          $('#other').attr('required', true);
          $('#client').attr('required', false);
          $('#supplier').attr('required', false);
        });
        $('#c_client').click(function(){
          $('.supplier').hide();
          $('.client').show();
          $('.other').hide();
          $('#osupplier').hide();
          $('#oclient').hide();

          $('#other').attr('required', false);
          $('#client').attr('required', true);
          $('#supplier').attr('required', false);
        });
        $('#c_other').click(function(){
          $('.supplier').hide();
          $('.client').hide();
          $('.other').show();
          $('#osupplier').hide();
          $('#oclient').hide();

          $('#other').attr('required', true);
          $('#client').attr('required', false);
          $('#supplier').attr('required', false);
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