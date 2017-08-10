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
                        <form class="form-horizontal" enctype="multipart/form-data" methor="post" action=''>
                          <fieldset>
                            <legend class="inlegend">Income Information</legend>
                              <div class="form-group col-xs-12">
                                <!-- income name  -->
                                <label class="col-xs-2 control-label" for="income_name">Name :</label>
                                <div class="col-xs-5">
                                    <input required placeholder="A4 transpotation" class="form-control" id='income_name' type="text" name ="income_name"/>
                                </div>

                                <!-- Reference  -->
                                <label class="col-xs-2 control-label" for="income_name">Reference :</label>
                                <div class="col-xs-3">
                                    <input required placeholder="#0056" class="form-control" id='ref' type="text" name ="ref" row='15' col=''></input>
                                </div>  
                                
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
                                    <option value="chsh">Cash Payment</option>
                                    <option value="card">Card Payement</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
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
                                      <div class="col-xs-12" id="selection">
                                        <label class="radio-inline"><input id="yes" type="radio" name='choose' value="yas">Yes</label>
                                        <label class="radio-inline"><input id="no" type="radio" name='choose' value="no" selected='true'>No</label>
                                      </div>
                                    </div>
                                    <div class="col-xs-6">
                                      <div class="col-xs-12" id="files">
                                        <input type="file" name="attachment[]" multiple/>
                                      </div>
                                    </div>
                                </div>  
                            </div>
                              <hr style="width:100%"/>
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
  <?php include('includes/footer.php'); ?>
</body>


