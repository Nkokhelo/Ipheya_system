<script type="text/javascript" src="../assets/jquery/jquery-1.10.2.js"></script>
<!-- <link type="text/css" rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css"/> -->
<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
     require_once('../core/init.php');
     include('includes/head2.php');
	 include('../core/logic.php');
     require_once("../core/controllers/qoutation-controller.php");
    //  include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
	 if(isset($_GET['Type']))
	 {
		$serviceT =$_GET['Type'];
		$req_id=$_GET['id'];
	 }
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
          <div class="col-xs-10 b">
            <div class="col-xs-12">
              <form method="POST" class='form' action="quotation.php">
			   			<div class="col-xs-12">
									<div class="col-xs-push-8 col-xs-8 btn-group form-group">
										<button class="btn btn-sm btn-info" name="submit" type="submit" ><span class="glyphicon glyphicon-save-file"></span> Save as draft</button>  
										<button class="btn btn-sm btn-info" name="email"  type="submit" ><span class="glyphicon glyphicon-send"></span> Email</button> 
										<button class="btn btn-sm btn-info" name="pdf_con"type="submit" ><span class="glyphicon glyphicon-print"></span> Print</button>
									</div>
								</div>
								<div class="col-xs-12">
									<hr class="bhr"/>
										<div class="col-xs-12">
											<div class="col-xs-12">
														<div class="col-xs-6">
														<h3 style="color:#808080">Ipheya IT Solution</h3>
														<div class="col-xs-12">
															<address>
																05 Wallnut Road<br/>
																Smartxchange<br/>
																Durban
																4001<br/>
																Office : 031-824-0515<br/>
																Phone : 083-277-4384
															</address>
														</div>
														<br/>
													</div>
													<div class="col-xs-6" style="float:right">
														<h3 style="float:right;color:#808080">Qoute</h3>
														<div class="col-xs-8 col-xs-offset-4">
																<div class="input-group">
																	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
																	<input name="qdate" class="form-control"style="width:100%" placeholder="Qoute date" id="qdate" type="text" value="" required/>
																</div>
																<div class="input-group">
																	<span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
																	<input name="title" class="form-control"  placeholder="Title" id="" type="text" value="" required/>
																</div>
																<div class="input-group">
																	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
																	<input name="clientid"class="form-control"  id="clients" value="<?=$client_no?>" disabled/>
																</div>
																<div class="input-group">
																	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
																	<input name="edate" class="form-control" style="width:100%" placeholder="Valid until" id="enddate" type="text" value="" required/>
																</div>
														</div>
													</div>
											</div>
										</div>
													<div class="col-xs-12 ">
										<hr class="bhr"/>
										<div class="col-xs-12" style="margin-bottom:15px;">
											<div class="col-xs-6">
												<h4 style="color:#808080"><u>Customer Information</u></h4>
												<div id="result">
													<?=$client_information?> 
												</div>
											</div>
											<div class="col-xs-6">
												<h4 style="color:#808080"><u>Qoutation Summary</u></h4>
												<textarea rows="4" class="form-control" name="summary" cols="50"></textarea>
											</div>
										</div>
										<hr class="bhr" style="width:100%;margin-top:15px; margin-bottom:15px"/>
																<div class="col-xs-12">
													<div class="col-xs-12">
														<div class="col-xs-8">
														<h4>Qoutation Items</h4>
													</div>
													<div class="btn-group btn-group-xs btn-group-justified col-xs-3" style="width:30%">
														<a class="btn btn-xs btn-default" onClick='addItem()' id='AddItem'>Add new Item</a>
														<a class="btn btn-xs btn-default" onClick='removeItem()' id='AddItem'>remove row</a>
													</div>
													<div class="col-xs-12" style="width:120%; margin-left:-60px;">
														<div class="table-responsive">
															<table id="ItemTable">
															<thead>
																<th>Name</th>
																<th>Description</th>
																<th>Quantity</th>
																<th>UnitPrice</th>
																<th>Price x Quan</th>
															</thead> 
															<tbody class="form-group" id="items">
																<tr>
																	<td><input type="text"class="form-control" name="IName[]"  id="txtN_0" value="" placeholder="Item Name" required/></td>
																	<td><input type="text"class="form-control" name="IDescription[]"  id="txtD_0" value="" style="width:350px" placeholder="Description" required/></td>
																	<td><input type="text"class="form-control" name="IQuantiy[]"  id="txtQ_0" value="" style="width:100px" onkeyup="generateTotals(this)" placeholder="No.of Items" required/></td>
																	<td><input type="text"class="form-control" name="IUnitPrice[]"  id="txtUP_0"value=""  style="width:80px" onkeyup="generateTotals(this)"  placeholder="Unit Price" required/></td>
																	<td><input type="text"class="form-control" name="IPQ[]"  id="txtPQ_0"value=""  style="width:100px" required readonly/></td>
																</tr>
															</tbody>
															<tfoot>
																<tr>
																	<td colspan="4"><b style="float:right"><i>TOTAL PRICE : </i></b></td>
																	<td><input type="text" class="form-control" name="TotalPrice" id="TotalPrice" value="" style="width:100px;border-radius:0;" required/></td>
																</tr>
															</tfoot>
														</table>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-6">
												<hr/>
												Payment Method 
												<select class='form-control' name="paymentmethod">
													<option value="10">10 % deposit</option>
													<option value="15">15 % deposit</option>
													<option value="30">30 % deposit</option>
												</select>
												<br/>
												<input name="serviceType" type="hidden" value="<?=$serviceT?>"/>
												<input name="Req_id" type="hidden" value="<?=$req_id?>"/>
												<br/>
											</div>
									</div>
                </div>
			   			</form>
            </div>
         </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
	<script type="text/javascript"> 
				var fieldCount = 1;
				var arraycount =0;

				function addItem() 
				{
					fieldCount++;
					arraycount++;
					var newRow = document.createElement('tr');
					var newColoum = document.createElement('td');
					var newInput = document.createElement('input');

					for(x=0; x<5; x++)
					{
						var newColoum = document.createElement('td');
						var newInput = document.createElement('input');
						newInput.type ='text';
						if(x ==0)
						{
							newInput.name='IName[]';
							newInput.placeholder="Item Name";
							newInput.setAttribute('required','required');
							newInput.setAttribute('class','form-control');
							newInput.id="txtN_"+arraycount;
						}
						else if(x ==1)
						{
							newInput.name='IDescription[]';
							newInput.placeholder ="Description";
							newInput.setAttribute('style','width:350px');
							newInput.setAttribute('required','required');
							newInput.id="txtD_"+arraycount;
							newInput.setAttribute('class','form-control');

						}
						else if(x ==2)
						{
							newInput.name='IQuantiy[]';
							newInput.placeholder="No.of Items";
							newInput.setAttribute('style','width:100px');
							newInput.setAttribute('onkeyup','generateTotals(this)');
							newInput.setAttribute('required','required');
							newInput.setAttribute('class','form-control');
							newInput.id="txtQ_"+arraycount;
						}
						else if(x==3)
						{
							newInput.name='IUnitPrice[]';
							newInput.placeholder="Unit price";
							newInput.setAttribute('style','width:80');
							newInput.setAttribute('onkeyup','generateTotals(this)');
							newInput.setAttribute('required','required');
							newInput.setAttribute('class','form-control');
							newInput.id="txtUP_"+arraycount;
						}
						else 
						{
							newInput.name='IPQ[]';
							newInput.setAttribute('style','width:100');
							newInput.setAttribute('required','required');
							newInput.setAttribute('readonly','readonly');
							newInput.setAttribute('class','form-control');
							newInput.id="txtPQ_"+arraycount;
						}
						newColoum.appendChild(newInput);
						newRow.appendChild(newColoum);
					}
					document.getElementById('items').appendChild(newRow);
				}
				function removeItem()
				{
					if(fieldCount>1)
						{
								var lastRow=document.getElementsByTagName('tr')
								fieldCount--;
								arraycount--;
								document.getElementById('items').lastChild.remove();
						}
						getSum();
				}

				function generateTotals(x)
				{
					var mytxt = $(x).attr('id');
					var idval = mytxt.split("_");
					var i =idval[1]
						var quant =$('#txtQ_'+i).val();
						var unitP =$('#txtUP_'+i).val();
						if(isNaN(quant)||isNaN(unitP))
						{
							$(x).val(' ');
							$('#txtPQ_'+i).val(0);
						}
						else
						{
							$('#txtPQ_'+i).val(unitP*quant);
							getSum();

						}
				}

				function getSum()
				{
					var totP = 0;
					for(var v=0; v<fieldCount; v++)
					{
							totP += Number($('#txtPQ_'+v).val());
					}
					$('#TotalPrice').val(totP);
					
				}
				$("#TotalPrice").attr('readonly','readonly');

				
				$('#clients').change(function()
				{
					var id = $(this).val();
					$.ajax({
								type:"get",
								url:"includes/getclient.php",
								data:"cid="+id,
							success:function(data){
								$("#result").html(data);
							}
						});
					return false;
				});

				$("#qdate").datepicker(
					{
						minDate:0,
						dateFormat: 'yy-mm-dd'
					}
				);
				$("#enddate").datepicker(
					{
						minDate:+20,
						dateFormat: 'yy-mm-dd'
					}
				);
	</script>
</body>