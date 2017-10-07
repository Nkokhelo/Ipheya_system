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
<body style="font-size:12px;">
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>

          <div class="col-xs-11 b">
											<h2>Create Qoute</h2>
											<hr class="bhr"/>
											<div class="col-xs-12"><?=$feedback?></div>
            <div class="col-xs-12">

              <form method="POST" class='form' action="quotation.php">
										<div class="col-xs-12">
													<div class="col-xs-12">
														<div class="row">
															<div class="col-xs-6">
																IPHEYA IT SOLUTIONS <hr class="bhr">
																<div class="col-xs-12">
																	<table style="font-size : 13px;">
																		<tr><td>05 Wallnut Road</td></tr>
																		<tr><td>Smartxchange</td></tr>
																		<tr><td>Durban</td></tr>
																		<tr><td>4001</td></tr>
																		<tr><td>Office : 031-824-0515</td></tr>
																		<tr><td>Phone : 083-277-4384</td></tr>
																	</table>
																</div>
															<br/>
														</div><!--col-xs-6-->

															<div class="col-xs-6" style="float:right">
																QOUTATION DETAILS <hr class="bhr">
																<div class="col-xs-12 ">

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
																			<input name="clientid"class="form-control"  id="clients" value="<?=$client_no?>" readonly/>
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
												<br class="bhr"/>
												<div class="row" style="margin-bottom:15px;">
													<div class="col-xs-6">
														CUSTOMER INFORMATION : <hr class="bhr">
														<div id="result" style="font-size:11px">
															<?=$client_information?> <br>
														</div>
													</div>
												<div class="row">
													<hr class="bhr">
													<div class="col-xs-12">
													<div class="col-xs-12">
														SUMMARY :
														<textarea rows="4" class="form-control" name="summary" cols="50"></textarea>
													</div>
													</div>
												</div>
									<div class="row">
										<hr class="bhr" style="width:100%;margin-top:15px; margin-bottom:15px"/>
										</div> 
												</div>
															<div class="row">
																<div class="row">
																	<div class="col-xs-8">
																		ITEMS
																	</div>

																	<div class="btn-group btn-group-xs btn-group-justified col-xs-3" style="width:30%">
																		<a class="btn btn-xs btn-default" onClick='addItem()' id='AddItem'>add new row</a>
																		<a class="btn btn-xs btn-default" onClick='removeItem()' id='AddItem'>delete last row</a>
																	</div> <!--btn-group-->

																	<div class="col-xs-12">
																		<hr class="bhr">
																	</div>

																		<div class="col-xs-12">
																			<div class="table-responsive">
																				<table class="table" id="ItemTable" style="font-size:12px;">

																				<thead>
																					<th>NAME</th>
																					<th>DESCRIPTION</th>
																					<th>QUANTITY</th>
																					<th>UNITPRICE</th>
																					<th>AMOUNT</th>
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
																						<th colspan="4">TOTAL VAT </th>
																						<td>
																							<input type="text" class="form-control" name="vat" id="vat" value="" style="width:100px;border-radius:0;" readonly required/></td>
																						</tr>
																					<tr>
																						<th colspan="4">TOTAL PRICE </th>
																						<td>
																							<input type="text" class="form-control" name="TotalPrice" id="TotalPrice" value="" style="width:100px;border-radius:0;" readonly required/></td>
																						</tr>
																				</tfoot>

																			</table>

																			</div> <!--table responcive-->
																		</div> <!--col-xs-12-->
																		
																	</div>
																</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
														<hr style="width:100%"/>
														<div class="form-group">
															<label for="paymentmethod" class="control-label col-xs-12">Deposit :</label>
															<div class="col-xs-12">
																<select class='form-control' style="width:20%;  display:inline;" name="paymentmethod">
																	<option value="10">10 %</option>
																	<option value="15">15 %</option>
																	<option value="30">30 %</option>
																</select>
															</div>
														</div>
														<input name="serviceType" type="hidden" value="<?=$serviceT?>"/>
														<input name="Req_id" type="hidden" value="<?=$req_id?>"/>
														<br/>
													</div>
										</div>
										<hr class="bhr"/>
											<div class="col-xs-12">
											<div class="col-xs-8 col-xs-offset-2">
												<div class="col-xs-4">
												<button class="btn btn-block btn-info" name="submit" type="submit" ><span class="glyphicon glyphicon-save-file"></span> Save as draft</button> 
												</div>
												<div class="col-xs-4">
												<button class="btn btn-block btn-info" name="send"  type="submit" ><span class="glyphicon glyphicon-send"></span> Send </button> 
												</div>
												<div class="col-xs-4">
												<button class="btn btn-block btn-info" name="pdf_con" type="submit" ><span class="glyphicon glyphicon-print"></span> Print</button>
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
							vat(totP);
						}
						function vat(tot)
						{
							$('#vat').val(tot*14/100);
						}
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
						var today = new Date();
						$("#qdate").datepicker(
							{
								setDate: today,
								minDate:0,
								dateFormat: 'yy-mm-dd',
								onSelect: function (date) {
																	var date2 = $('#qdate').datepicker('getDate');
																	date2.setDate(date2.getDate() + 7);
																	$('#enddate').datepicker('setDate', date2);
																	$('#enddate').datepicker('option', 'minDate', date2);
													}
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