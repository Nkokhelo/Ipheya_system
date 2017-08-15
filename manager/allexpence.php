<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
<<<<<<< HEAD
        require_once('../core/controllers/expenses-controller.php');
=======
        // require_once('../core/controllers/cashflow-controller.php');
        // include('includes/navigation.php'); thi is pull
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
   }
   else
   {
     header("Location:../login.php");
   }
?>

<body>
<<<<<<< HEAD
=======

>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
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
<<<<<<< HEAD
                  <li role="presentation" ><a href="#list"  aria-controls="home" role="tab" data-toggle="tab">All Expenses</a></li>
                  <li role="presentation" class="active"><a href="#newexpense"  aria-controls="profile" role="tab" data-toggle="tab">New Expense</a></li>
=======
                  <li role="presentation" ><a href="#list"  aria-controls="home" role="tab" data-toggle="tab">All Expences</a></li>
                  <li role="presentation" class="active"><a href="#newexpence"  aria-controls="profile" role="tab" data-toggle="tab">New Expence</a></li>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade" id="list">

                  </div>
<<<<<<< HEAD
                  <div role="tabpanel" class="tab-pane fade  in active" id="newexpense">
                    <div class="col-xs-12">
                        <form class="form-horizontal" enctype="multipart/form-data" id='expenceForm' methor="post" action=''>
=======
                  <div role="tabpanel" class="tab-pane fade  in active" id="newexpence">
                    <div class="col-xs-12">
                        <form class="form-horizontal" enctype="multipart/form-data" methor="post" action=''>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                          <fieldset>
                            <legend class="inlegend">Expense Information</legend>
                              <div class="form-group col-xs-12">
                            <!-- Expense type  -->
<<<<<<< HEAD
                                    <label class="col-xs-2 control-label" for="expense_type">Expense type :</label>
                                    <div class="col-xs-3">
                                        <select class="selectpicker form-control" id='expense_t' type="text" name ="expense_type">
                                            <option style="backgroud:#aaa" value="">--Select--</option>
=======
                                    <label class="col-xs-2 control-label" for="expense_name">Expense type :</label>
                                    <div class="col-xs-3">
                                        <select class="selectpicker form-control" id='expence_t' type="text" name ="expence_type">
                                            <option value="">~Select~</option>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                            <option value="p">Payament</option>
                                            <option value="r">Refund</option>
                                        </select>
                                    </div>
                            <!--Supplier  -->
                                    <label class="col-xs-2 control-label supplier" id="supplier" for="supplier">Supplier:</label>
                                    <div id="supplier" class="col-xs-4 supplier">
<<<<<<< HEAD
                                        <select id="supplier" class="form-control" name="supplier">
                                            <option style="backgroud:#aaa">--None Selected--</option>
=======
                                        <select id="supplier" class="form-control">
                                            <option>~Select Supplier~ (not required)</option>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                        </select>
                                    </div> 
                            <!--client  -->
                                    <label id="client" class="col-xs-2 control-label client" for="client">Client:</label>
                                    <div id="client" class="col-xs-5 client">
<<<<<<< HEAD
                                        <select id="client" class="form-control" name="client">
                                            <option style="backgroud:#aaa">--None Selected--</option>
=======
                                        <select id="client" class="form-control">
                                            <option>~Select Client~ (not required)</option>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                        </select>
                                    </div>                             
                              </div>
                             <hr  style="width:100%"/>

                            <!--Expense inforamtion  -->
                              <div class="form-group col-xs-12">
                                <!-- Expense name  -->
                                <label class="col-xs-2 control-label" for="expense_name">Name :</label>
                                <div class="col-xs-4">
                                    <input required placeholder="A4 transpotation" class="form-control" id='expense_name' type="text" name ="expense_name"/>
                                </div>

                                <!-- Reference  -->
<<<<<<< HEAD
                                <label class="col-xs-2 control-label" for="ref">Reference :</label>
=======
                                <label class="col-xs-2 control-label" for="expense_name">Reference :</label>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                <div class="col-xs-3">
                                    <input required placeholder="#0056" class="form-control" id='ref' type="text" name ="ref" row='15' col=''></input>
                                </div>  
                                
                              </div>
                            <!-- Transaction Description-->
                              <div class="form-group col-xs-12">
<<<<<<< HEAD
                                <label class="col-xs-2 control-label" for="details"> Description: </label>
                                <div class="col-xs-10">
                                    <textarea required placeholder="Mr John Sith- 50 A4 pack Deliviries" class="form-control" id='details' type="text" name ="details" rows="5" cols="10"></textarea>
=======
                                <label class="col-xs-2 control-label" for="expense_name"> Description: </label>
                                <div class="col-xs-7">
                                    <textarea required placeholder="Mr John Sith- 50 A4 pack Deliviries" class="form-control" id='details' type="text" name ="details" row='15' col=''></textarea>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                              </div>                              
                            </div>
                            <hr style="width:100%"/>
                            <div class="form-group col-xs-12">
                            <!-- Date  -->
<<<<<<< HEAD
                                <label class="col-xs-2 control-label" for="t_date">Date :</label>
=======
                                <label class="col-xs-2 control-label" for="expense_name">Date :</label>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                <div class="col-xs-3">
                                    <input required placeholder="2017-05-09" class="form-control" id='t_date' type="text" name ="t_date" row='15' col=''></input>
                                </div>  
                                     
                            <!-- Payment Type -->
<<<<<<< HEAD
                                <label class="col-xs-2 control-label col-xs-push-1" for="payment_type">Payment type:</label>
                                <div class="col-xs-3 col-xs-push-1">
                                <select class="selectpicker form-control" title="Please select" id='program_name' type="text" name ="payment_type">       
                                    <option style="background:#aaa">--None--</option>
=======
                                <label class="col-xs-2 control-label col-xs-push-1" for="project_name">Payment type:</label>
                                <div class="col-xs-3 col-xs-push-1">
                                <select class="selectpicker form-control" title="Please select" id='program_name' type="text" name ="payment_type">       
                                    <option value="">~Select~</option>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                    <option value="chsh">Cash Payment</option>
                                    <option value="card">Card Payement</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                            <!-- category  -->
                                <label class="col-xs-2 control-label" for="expense_name">Category :</label>
                                <div class="col-xs-4">
                                    <select class="form-control">
<<<<<<< HEAD
                                        <option style="background:#aaa">--None--</option>
                                        <?=$categories_dd?>
                                    </select>
                                </div> 
                              </div>
                                <hr style="width:100%"/>
                              <div class="col-xs-12"> 
                            <!-- project  -->
                                <h5 class="col-xs-12" style="color:#999"> <b> Is this a project expense?</b></h5><br/>
                                <label class="col-xs-2 control-label" for="expense_name">Proejct:</label>
                                <div class="col-xs-4">
                                    <select class="form-control">
                                        <option style="background:#aaa">--None--</option>
                                        <?=$project_dd?>
                                    </select>
                                    <br/>
                                </div>
                              </div>
=======
                                        <option>~Pick a category~</option>
                                    </select>
                                </div>  
                            <!-- project  -->
                                <label class="col-xs-2 control-label" for="expense_name">Proejct:</label>
                                <div class="col-xs-4">
                                    <select class="form-control">
                                        <option>~Pick a Project~ (not required)</option>
                                    </select>
                                </div>
                            </div>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                              <hr style="width:100%"/>
                              <div class="col-xs-12">
                            <!-- fie decition  -->
                                <div class="form-group col-xs-12">
                                    <div class="col-xs-6">
<<<<<<< HEAD
                                      <label for="choose">Expense Attachemnts?</label>
=======
                                      <label for="">Attachemnts?</label>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                      <div class="col-xs-12" id="selection">
                                        <label class="radio-inline"><input id="yes" type="radio" name='choose' value="yas">Yes</label>
                                        <label class="radio-inline"><input id="no" type="radio" name='choose' value="no" selected='true'>No</label>
                                      </div>
                                    </div>
<<<<<<< HEAD
                                    <div class="col-xs-6" id="files">
                                      <label for="choose">Please choose a file pdf/doc/png/jpg</label>
                                      <div class="col-xs-12" >
                                        <input type="file" class="form-control-file" name="attachment[]" multiple/>
=======
                                    <div class="col-xs-6">
                                      <div class="col-xs-12" id="files">
                                        <input type="file" name="attachment[]" multiple/>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                      </div>
                                    </div>
                                </div>  
                            </div>
<<<<<<< HEAD
=======
                            
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
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
<<<<<<< HEAD

=======
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
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
        $('#yes').click(function(){
          $('#files').show();
        });
        $('#no').click(function(){
          $('#files').hide();
        });
<<<<<<< HEAD
          $('#expense_t').change(function(){
=======
          $('#expence_t').change(function(){
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
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
<<<<<<< HEAD

          $('form').submit(function(evt){
            alert('stop');
            evt.preventDefault();// to stop form submitting
          });\
          //form validator file 
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
    });
  </script>
</body>
=======
    });
  </script>
</body>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
