<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/supplier-controller.php');
        /*if(isset($_GET['view'])){include('../core/sub/ping.php');}
        else{
          $class_attr = '';
        }*/
        include('includes/employee-session.php');
        // include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php';?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-10 b'>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active" data-toggle="tab"><a href="#suppliers" data-toggle="tab">Supplier</a></li>
                    <li><a href="#purchases" data-toggle="tab">Purchases and Sales</a></li>
                    <li><a href="#contract" data-toggle="tab">Agreement</a></li>
                </ul>
                <div class="col-md-12" style="padding:2%;">
                <div class="tab-content" >
                        <div role="tabpanel" class="tab-pane fade in active" id="suppliers" style="font-size:12px">
                            <?php if(isset($_GET['edit']))  { ?>
                            <div class="col-xs-12" >
                                <form class="form" action="" method="post">
                                    <h4 style="color:#aaa">Edit supplier</h4>
                                    <hr class="bhr"/>
                                    <div class="col-xs-12 col-md-12">
                                        <input name="sup_no" type="hidden" value="<?=$_GET['edit']?>" />
                                        <p style="color:#0094ff; position:absolute; top:5px;">Supplier number : #<?= $_GET['edit'];?></p>
                                    <hr class="bhr"/>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="name">Supplier :</label>
                                            <input required type="text" name="name" id="name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Company Name">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="address">Address :</label>
                                            <input required type="text" name="address" id="address" class="form-control" value="<?=((isset($address))?$address:'');?>" placeholder="Address">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="line2">Line-2 :</label>
                                            <input required type="text" name="line2" id="line2" class="form-control" value="<?=((isset($line2))?$line2:'');?>" placeholder="Address 2">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="line3">Line-3 :</label>
                                            <input required type="text" name="line3" id="line2" class="form-control" value="<?=((isset($line3))?$line3:'');?>" placeholder="Address 3">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="line4">Line-4 :</label>
                                            <input required type="text" name="line4" id="line4" class="form-control" value="<?=((isset($line4))?$line4:'');?>" placeholder="Address 4">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-xs-5">
                                            <label for="postal">Postal :</label>
                                            <input required type="text" name="postal" id="postal" class="form-control" value="<?=((isset($postal))?$postal:'');?>" placeholder="Code">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="fullname">Contact :</label>
                                            <input required type="text" name="fullname" id="full_name" class="form-control" value="<?=((isset($fullname))?$fullname:'');?>" placeholder="Full name">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="telephone">Telephone :</label>
                                            <input required type="text" name="telephone" id="telephone" class="form-control" value="<?=((isset($telephone))?$telephone:'');?>" placeholder="Telephone">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="mobile">Mobile :</label>
                                            <input required type="text" name="mobile" id="mobile" class="form-control" value="<?=((isset($mobile))?$mobile:'');?>" placeholder="Mobile Number">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="fax">Fax :</label>
                                            <input required type="text" name="fax" id="fax" class="form-control" value="<?=((isset($fax))?$fax:'');?>" placeholder="Fax Number">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="email">Email :</label>
                                            <input required type="email" name="email" id="email" class="form-control" value="<?=((isset($email))?$email:'');?>" placeholder="Email Address">
                                        </div>
                                        </div>
                                        <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="web">Web :</label>
                                            <input required type="text" name="web" id="web" class="form-control" value="<?=((isset($web))?$web:'');?>" placeholder="e.g-www.ipheya.com">
                                        </div>
                                        </div>
                                    </div>
                                    <hr class="bhr" style="width:100%"/>
                                    <div class="form-group col-xs-4 col-xs-offset-4">
                                        <button type="submit" name="update" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> Update</button>
                                        <a href="viewsupplier?view=<?=$_GET['edit']?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-open-file"></span> View supplier</a>
                                    </div>
                                </form>
                            </div>
                            </div>
                            <?php }else { ?>
                            <div class="col-xs-12">
                                    <p style="color:#0094ff; position:absolute; top:5px;">Supplier number : #<?= $_GET['view'];?></p>
                                    <hr class="bhr"/>
                                    <div class="col-xs-6">
                                    <div class="col-xs-6" style="text-align:right">
                                            <p>Supplier name :</p>
                                            <p>Address :</p>
                                            <p>Line 2 :</p>
                                            <p>Line 3 :</p>
                                            <p>Line 4 :</p>
                                            <p>Postal Code :</p>
                                    </div>
                                    <div class="col-xs-6" style="text-align:left">
                                            <p><?=$name?></p>
                                            <p><?=$address?></p>
                                            <p><?=$line2?></p>
                                            <p><?=$line3?></p>
                                            <p><?=$line4?></p>
                                            <p><?=$postal?></p>
                                    </div>
                                    </div>
                                    <div class="col-xs-6">
                                    <div class="col-xs-6" style="text-align:right">
                                            <p>Contact Full names :</p>
                                            <p>telephone :</p>
                                            <p>mobile :</p>
                                            <p>Fax :</p>
                                            <p>Web :</p>
                                            <p>Email :</p>
                                    </div>
                                    <div class="col-xs-6" style="text-align:left">
                                            <p><?=$fullname?></p>
                                            <p><?=$telephone?></p>
                                            <p><?=$mobile?></p>
                                            <p><?=$fax?></p>
                                            <p class="<?=urlExists($web);?>"><?=$web?></p>
                                            <p><?=$email?></p>
                                    </div>
                                    </div>
                            </div>
                                <hr class="bhr" style="width:100%"/>
                                <div class="col-xs-5 col-xs-offset-5">
                                    <a href="viewsupplier?edit=<?=$_GET['view'];?>" class="btn btn-xs btn-primary"><p class="glyphicon glyphicon-edit"></p> edit...</a>
                                </div>
                            </div>
                            <?php } ?>
                        <div role="tabpanel" class="tab-pane fade" id="purchases">
                            <div class="col-xs-12">
                                <div class="alert alert-info">
                                        <p><span class="glyphicon glyphicon-info-sign"></span> No purchases have been made on this supplier</p>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="contract">
                          <div class="col-xs-12" >
                              <form class="form" action="" method="post">
                                  <h4 style="color:#aaa">Draft Agreement</h4>
                                  <hr class="bhr"/>
                                  <div class="col-xs-12 col-md-12">
                                      <input name="sup_no" type="hidden" value="<?=$_GET['view'];?>" />
                                      <p style="color:#0094ff; position:absolute; top:5px;">Supplier number : #<?= $_GET['view'];?></p>
                                  <hr class="bhr"/>
                                  </div>

                                  <div class="form-group col-md-6">
                                    <div class="col-xs-12">
                                      <div class="form-group col-md-12">
                                          <label for="name">Supplier :</label>
                                          <input required type="text" name="name" id="name" class="form-control" value="<?=((isset($name))?$name:'');?>" placeholder="Company Name">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <div class="form-group col-md-12">
                                          <label for="address">Deposit % :</label>
                                          <input required type="number" name="deposit" id="deposit" class="form-control" value="<?=((isset($agreementresult['deposit']))?$agreementresult['deposit']:'');?>" placeholder="%">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <div class="form-group col-md-12">
                                          <label for="address">warranty :</label>
                                          <div class="col-xs-12">
                                            <div class="col-xs-4">
                                              <input required type="number" name="warrantynum" id="warrantynum" class="form-control" value="<?=((isset($warrantyArr[0]))?$warrantyArr[0]:'');?>" placeholder="1...">
                                            </div>
                                            <div class="col-xs-8">
                                              <select required class="form-control" name="warrantytype" id="warrantytype">
                                                <option value="<?=((isset($warrantyArr[1]))?$warrantyArr[1]:'');?>"><?=((isset($warrantyArr[1]))?$warrantyArr[1]:'Warranty type');?></option>
                                                <option value="days">days</option>
                                                <option value="weeks">weeks</option>
                                                <option value="months">months</option>
                                              </select>
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                      <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="line2">Discount % :</label>
                                            <input required type="number" name="discount" id="discount" class="form-control" value="<?=((isset($agreementresult['discount']))?$agreementresult['discount']:'');?>" placeholder="%">
                                        </div>
                                      </div>
                                      <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="line3">Delivery Fee :</label>
                                            <input type="text" name="delivery" id="delivery" class="form-control" value="<?=((isset($agreementresult['delivery_fee']))?$agreementresult['delivery_fee']:'');?>" placeholder="R.00">
                                        </div>
                                      </div>
                                      <div class="col-xs-12">
                                        <div class="form-group col-md-12">
                                            <label for="address">Contract Duration :</label>
                                            <div class="col-xs-12">
                                              <div class="col-xs-6">
                                                <input required type="date" name="start_date" id="contract_start" class="form-control" value="<?=((isset($agreementresult['start_date']))?$agreementresult['start_date']:'');?>" placeholder="start...">
                                              </div>
                                              <div class="col-xs-6">
                                                <input required type="date" name="end_date" id="contract_end" class="form-control" value="<?=((isset($agreementresult['end_date']))?$agreementresult['end_date']:'');?>" placeholder="end...">
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="form-group col-md-12" align="center">
                                    <label for="clause">Liability Clause</label>
                                    <textarea required name="clause" class="form-control" rows="6" cols="60" placeholder="Liability agreement"><?=((isset($agreementresult['liability_clause']))?$agreementresult['liability_clause']:'');?></textarea>
                                  </div>
                                  <hr class="bhr" style="width:100%"/>
                                  <div class="form-group col-xs-6 col-xs-offset-3">
                                      <button type="submit" name="<?=((isset($agreementresult['deposit']))?'Update_Agreement':'Agreement');?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> <?=((isset($agreementresult['deposit']))?'Update Draft':'Save Draft');?></button>
                                      <a href="viewsupplier?view=<?=$_GET['view'];?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-open-file"></span> View supplier</a>
                                      <?=((isset($agreementresult['deposit']))?'<a href="print-agreement.php?agrid='.$sup_no.'" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-open-file"></span> Print Agreement</a>':'Agreement');?>
                                  </div>
                              </form>
                          </div>
                          <!--<div class="container-fluid" id="contract-wrap">
                            <div class="col-md-12" id="contract-header">
                              <div class="row">
                                <div class="col-sm-3">

                                </div>
                                <div class="">

                                </div>
                              </div>
                              <div class="row">
                                <div class="" id="contract-tile" title="">

                                </div>
                                <div class="col-md-12 text-center" id="contact">
                                  <p>Phone: (031) 609 2866</p> <p>Fax: (031) 902 4796</p> <p>Info@ipheya.com</p>
                                </div>
                              </div>
                            </div>
                          </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
