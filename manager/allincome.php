<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/cashflow-controller.php');
        // include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<<<<<<< HEAD

<body>

=======
<body>
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
<<<<<<< HEAD
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
=======
            <div class="col-xs-10 b">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" ><a href="#list"  aria-controls="home" role="tab" data-toggle="tab">All Income</a></li>
                  <li role="presentation" class="active"><a href="#newincome"  aria-controls="profile" role="tab" data-toggle="tab">New Income</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade" id="list">
                    <h2>Income</h2>
                    <hr class="bhr"/>
                    <div class="col-xs-12">
                    </div>
                    <div class="col-xs-12">
                        <table class="table">
                          <thead align="center">

                          </thead>
                          <tbody>
                            <tr>
                              <td> Date </td><td> Reason </td><td> Amount</td><td align='center'>Money In/Out</td>
                            </tr>
                            <?=$transactions?>
                          </tbody>
                          <tfoot>

                          </tfoot>
                        </table>
                    </div>
                    <hr class="bhr"/>
                    <div class="col-xs-12">
                      <div class="col-xs-4 col-xs-offset-4">
                        <a class="btn btn-block btn-primary">View Finacial Report</a><br/>
                      </div>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade  in active" id="newincome">
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                        <form class="form-horizontal" enctype="multipart/form-data" methor="post" action=''>
                          <fieldset>
                            <legend class="inlegend">Income Information</legend>
                              <div class="form-group col-xs-12">
<<<<<<< HEAD
                            <!-- Income type  -->
                                    <label class="col-xs-2 control-label" for="income_type">Income type :</label>
                                    <div class="col-xs-3">
                                        <select class="selectpicker form-control" id='income_t' type="text" name ="income_type">
                                            <option value="">--Select--</option>
                                            <option value="p">Payament</option>
                                            <option value="r">Refund</option>
                                        </select>
                                    </div>
                            <!--Supplier  -->
                                    <label class="col-xs-2 control-label supplier" id="supplier" for="supplier">Supplier:</label>
                                    <div id="supplier" class="col-xs-4 supplier">
                                        <select id="supplier" class="form-control" name="supplier">
                                            <option>--None Selected--</option>
                                        </select>
                                    </div> 
                            <!--client  -->
                                    <label id="client" class="col-xs-2 control-label client" for="client">Client:</label>
                                    <div id="client" class="col-xs-5 client">
                                        <select id="client" class="form-control" name="client">
                                            <option>--None Selected--</option>
                                        </select>
                                    </div>                             
                              </div>
                             <hr  style="width:100%"/>

                            <!--Income inforamtion  -->
                              <div class="form-group col-xs-12">
                                <!-- Income name  -->
                                <label class="col-xs-2 control-label" for="Income_name">Name :</label>
                                <div class="col-xs-4">
                                    <input required placeholder="A4 transpotation" class="form-control" id='Income_name' type="text" name ="Income_name"/>
                                </div>

                                <!-- Reference  -->
                                <label class="col-xs-2 control-label" for="ref">Reference :</label>
=======
                                <!-- income name  -->
                                <label class="col-xs-2 control-label" for="income_name">Name :</label>
                                <div class="col-xs-5">
                                    <input required placeholder="A4 transpotation" class="form-control" id='income_name' type="text" name ="income_name"/>
                                </div>

                                <!-- Reference  -->
                                <label class="col-xs-2 control-label" for="income_name">Reference :</label>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                <div class="col-xs-3">
                                    <input required placeholder="#0056" class="form-control" id='ref' type="text" name ="ref" row='15' col=''></input>
                                </div>  
                                
<<<<<<< HEAD
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
                                    <input required placeholder="2017-05-09" class="form-control" id='t_date' type="text" name ="t_date" row='15' col=''></input>
                                </div>  
                                     
                            <!-- Payment Type -->
                                <label class="col-xs-2 control-label col-xs-push-1" for="payment_type">Payment type:</label>
                                <div class="col-xs-3 col-xs-push-1">
                                <select class="selectpicker form-control" title="Please select" id='program_name' type="text" name ="payment_type">       
                                    <option value="">--None--</option>
=======
                            </div>
                            
                            <!-- Transaction Description-->
                            <div class="form-group col-xs-12">
                                <label class="col-xs-2 control-label" for="income_name"> Description: </label>
                                <div class="col-xs-7">
                                    <textarea required placeholder="Mr John Sith- 50 A4 pack Deliviries" class="form-control" id='details' type="text" name ="details" row='15' col=''></textarea>
                              </div>                              
                            </div>

                            <div class="form-group col-xs-12">
                            <!-- Date  -->
                                <label class="col-xs-2 control-label" for="income_name">Date :</label>
                                <div class="col-xs-4">
                                    <input required placeholder="2017-05-09" class="form-control" id='t_date' type="text" name ="t_date" row='15' col=''></input>
                                </div>  
                                     
                                     <!-- Payment Type -->
                                <label class="col-xs-2 control-label" for="project_name">Payment type:</label>
                                <div class="col-xs-4">
                                <select class="selectpicker form-control" title="Please select" id='program_name' type="text" name ="payment_type">       
                                    <option value="">~Select~</option>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                    <option value="chsh">Cash Payment</option>
                                    <option value="card">Card Payement</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
<<<<<<< HEAD
                            <!-- category  -->
                                <label class="col-xs-2 control-label" for="Income_name">Category :</label>
                                <div class="col-xs-4">
                                    <select class="form-control">
                                        <option>--None--</option>
                                    </select>
                                </div>  
                            <!-- project  -->
                                <label class="col-xs-2 control-label" for="Income_name">Proejct:</label>
                                <div class="col-xs-4">
                                    <select class="form-control">
                                        <option>--None-- (not required)</option>
                                    </select>
                                </div>
                            </div>
                              <hr style="width:100%"/>
                              <div class="col-xs-12">
                            <!-- fie decition  -->
                                <div class="form-group col-xs-12">
                                    <div class="col-xs-6">
                                      <label for="choose">Income Attachemnts?</label>
=======
                            <!-- Date  -->
                                <label class="col-xs-2 control-label" for="income_name">Category :</label>
                                <div class="col-xs-4">
                                    <select class="form-control">
                                        <option>~Pick a category~</option>
                                    </select>
                                </div>  
                            </div>
                            <hr style="width:100%"/> 
                            <div class="form-group col-xs-12">
                            <!-- Date  -->
                                <label class="col-xs-2 control-label" for="income_name">Proejct:</label>
                                <div class="col-xs-4">
                                    <select class="form-control">
                                        <option>~Pick a Project~</option>
                                    </select>
                                </div>  
                              </div>
                              <hr style="width:100%"/>
                              <div class="col-xs-12">
                            <!-- Date  -->
                                <div class="col-xs-12">
                                    <div class="col-xs-6">
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
=======
                                    <div class="col-xs-6">
                                      <div class="col-xs-12" id="files">
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                                        <input type="file" name="attachment[]" multiple/>
                                      </div>
                                    </div>
                                </div>  
                            </div>
<<<<<<< HEAD
                            
=======
                              <hr style="width:100%"/>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
                            <hr class="bhr" style="width:100%"/>
                            <div class="form-group col-xs-12">
                              <div class="col-xs-4 col-xs-offset-4">
                                <button class="btn btn-block btn-primary" name="save">Save</button>
                              </div>
                            </div>
                          </fieldset>
<<<<<<< HEAD
                        </form>
                    </div>
                  </div>
                </div>
              </div>
=======

                        </form>
                  </div>
                </div>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
<<<<<<< HEAD
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
          $('#income_t').change(function(){
            var p_type = $(this).val();
            if(p_type=='r')
            {
              $('.client').hide();
              $('.supplier').show();
            }
            else if(p_type=='p')
            {
              $('.client').show();
              $('.supplier').hide();
            }
            else
            {
              $('.supplier').hide();
              $('.client').hide();
            }
          });
    });
  </script>
</body>
=======
</body>


>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
