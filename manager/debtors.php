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
            <div class='col-xs-11 b'>
              <div>
  
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#list"  aria-controls="home" role="tab" data-toggle="tab">List of All Debtors</a></li>
                  <li role="presentation" ><a href="#newexpense"  aria-controls="profile" role="tab" data-toggle="tab">Notify/Remind Debtors</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="list">
                    <div class="row">
                      <div class="col-xs-12">
                        <?php if($e_trans==''){?>
                          <?=$efeedback?>
                        <?php } else{ ?>
                          <h3 class="text-center" style="color:#888">All Unpaid Debts</h3><hr class="bhr"/>
                          <table class="table table-bordered table-hover" id="expensetable">
                            <thead>
                              <tr><th style="50px">ClientID</th><th style="100px">Client Name</th><th style="width:520px">Description</th><th style="150px"> Amount Due</th></tr>
                            </thead>
                            <tbody>
                              <?=$e_trans?>
                            </tbody>
                            <tfoot>
                              <tr><td colspan="3" align="right"><b>Total Debts</b></td><td align="right">R <?= number_format($tot_exp,2,","," ")?></td></tr>
                            </tfoot>
                        </table>
                        <?php }?>
                      </div> 
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="newexpense">
                    <div class="col-xs-12">
                      <form class="form-horizontal" enctype="multipart/form-data" id='expenceForm' method="post" action='allexpence.php'>
                        <fieldset>
                          <?=($efeedback)?$efeedback:""?>
                          <legend class="inlegend">Reminder Details</legend>
                          <div class="form-group col-xs-12">
                          <!-- Expense type  -->
                            <label class="col-xs-2 control-label" for="ei_type">Debt type :</label>
                            <div class="col-xs-3">
                              <select class="selectpicker form-control" id='expense_t' type="text" name ="ei_type">
                                  <option style="backgroud:#aaa" value="">--Select--</option>
                                  <option value="p">Revolving Debt</option>
                                  <option value="r">Non-Revolving Debt</option>
                              </select>
                            </div>

                          <!--Expense inforamtion  -->
                            <div class="form-group col-xs-12">
                              <!-- Expense name  -->
                              <label class="col-xs-2 control-label" for="ei_name">Name :</label>
                              <div class="col-xs-4">
                                <input required placeholder="A4 transpotation" class="form-control" id='expense_name' type="text" name ="ei_name"/>
                              </div>

                              <!-- Reference  -->
                              <label class="col-xs-2 control-label" for="ref">Reference :</label>
                              <div class="col-xs-3">
                                <input required placeholder="#0056" class="form-control" id='ref' type="text" name ="ref_no" row='15' col=''></input>
                              </div>  
                            </div>
                          <!-- Transaction Description-->
                            <div class="form-group col-xs-12">
                              <label class="col-xs-2 control-label" for="details"> Service Details: </label>
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
                            <label class="col-xs-2 control-label col-xs-push-1" for="payment_type">Remider type:</label>
                            <div class="col-xs-3 col-xs-push-1">
                            <select class="selectpicker form-control" title="Please select" id='program_name' type="text" name ="ei_payment_type">       
                              <option style="background:#aaa" value="">--None--</option>
                              <option value="cash">Overdue Payment</option>
                              <option value="card">Letter Of Demand</option>
                            </select>
                            </div>
                          </div>
                          <div class="form-group col-xs-12">
                             
                            <!-- Amount -->
                            <label class="col-xs-2 control-label" for="amount">Amount Due:</label>
                            <div class="col-xs-4">
                              <input type="text" class="form-control" name="ei_amount" value="" id="amount" required>
                            </div> 
                          </div>
                          <hr style="width:100%"/>  
                          <div class="col-xs-12"> 
                          
                          <!-- fie decition  -->
                            <div class="form-group col-xs-12">
                              <div class="col-xs-6">
                                <label for="choose">Attach Letter of Demand?</label>
                                <div class="col-xs-12" id="selection">
                                  <label class="radio-inline"><input id="yes" type="radio" name='choose' value="yas">Yes</label>
                                  <label class="radio-inline"><input id="no" type="radio" name='choose' value="no" selected='true'>No</label>
                                </div>
                              </div>
                              <div class="col-xs-6" id="files">
                                <label for="choose">Please choose a file pdf/png/jpg/</label>
                                <div class="col-xs-12" >
                                  <input type="file" class="form-control-file" name="attachment" required/>
                                </div>
                              </div>
                            </div>  
                        </div>
                        <hr class="bhr" style="width:100%"/>
                        <div class="form-group col-xs-12">
                          <div class="col-xs-4 col-xs-offset-4">
                            <button type="submit" class="btn btn-block btn-primary"id="save_expense" name="save_expense">Send Reminder</button>
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
      <?php include('includes/footer.php'); ?>
    </div>
  </div>
<script>
  $(document).ready(function(){
    $('.supplier').hide();
    $('.client').hide();
    $('.other').hide();
    $('#files').hide();
    $('#osupplier').hide();
    $('#oclient').hide();
    $('#expensetable').dataTable();

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
    $('#expense_t').change(function(){
      var p_type = $(this).val();
      if(p_type=='r')
      {
        $('#osupplier').hide();
        $('#oclient').show();
        $('.client').hide();
        $('.other').hide();
        $('.supplier').hide();
      }
      else if(p_type=='p')
      {
        $('#osupplier').show();
        $('#oclient').hide();
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
    $('#save_expense').bind("click",function() 
    { 
        var imgVal = $('INPUT[type="file"]').val(); 
        if(imgVal==''&& $('#yes').is(':checked')) 
        { 
            alert("select an attachemt for this expense"); 
            return false; 
        } 


    });
  });
  </script>
</body>