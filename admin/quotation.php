<script type="text/javascript" src="../assets/jquery/jquery-1.10.2.js"></script>
<link type="text/css" rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css"/>
<style type="text/css">
	#items>tr>td>input
	{
		border-radius:0;
	}
</style>
<?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
	 include('../core/logic.php');
     require_once("../core/controllers/qoutation-controller.php");
	 if(isset($_GET['Type']))
	 {
		$serviceT =$_GET['Type'];
	 }

?>
 <div class="row">
         <div class="col-sm-8 b  col-sm-offset-2">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:15px;">
               <form method="POST" action="quotation.php">
			   			<div class="col-lg-12">
							<div class="col-md-push-8 col-md-8 btn-group">
								<input class="btn btn-xs btn-info" name="submit" type="submit" value="Save To Draft"/> 
								<input class="btn btn-xs btn-info" name="email"  type="submit" value="Send Email"/> 
								<input class="btn btn-xs btn-info" name="pdf_con"type="submit" value="Convert to PDF"/>
							</div>
						</div>
                <div class="col-lg-12">
				<hr class="bhr"/>
					<div class="col-md-12">
						<div class="col-md-12">
							    <div class="col-lg-6">
									<h1 style="color:#808080">Ipheya IT Solution</h1>
									<table class="">
										<tr><td>05 Wallnut Road</td></tr>
										<tr><td>Smartxchange</td></tr>
										<tr><td>Durban</td></tr>
										<tr><td>4001</td></tr>
										<tr><td>Office: 0318240515</td></tr>
										<tr><td>Phone :0832774984</td></tr>
									</table>
									<br/>
								</div>
								<div class="col-lg-6" style="float:right">
									<h1 style="float:right;color:#808080">Qoute</h1>
									<div class="col-sm-8 col-sm-offset-4">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
												<input name="qdate" class="form-control"style="width:100%" placeholder="Qoute Date" id="qdate" type="text" value="" required/>
											</div>
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
												<input name="title" class="form-control"  placeholder="Title" id="" type="text" value="" required/>
											</div>
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<select name="clientid"class="form-control"  href='quotation.php?cid=' id='clients'><option value='0'>Select a client</option><?=$options ?></select>
											</div>
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-warning-sign"></i></span>
												<input name="edate" class="form-control" style="width:95%" placeholder="End Date" id="" type="date" value="" required/>
											</div>
									</div>
								</div>
						</div>
					</div>
                <div class="col-lg-12 ">
					<hr class="bhr"/>
					<div class="col-md-12" style="margin-bottom:15px;">
						<div class="col-md-6">
							<h4>Customer Information</h4>
							<div id="result">
								<?=$client_information?>
							</div>
						</div>
						<div class="col-md-6">
							<h4>Qoutation Summary</h4>
							<textarea rows="4" class="form-control" name="summary" cols="50"></textarea>
						</div>
					</div>
					<hr class="bhr" style="width:100%;margin-top:15px; margin-bottom:15px"/>
                       <div class="col-md-12">
					   		<div class="col-md-12">
							    <div class="col-lg-8">
									<h4>Qoutation Items</h4>
								</div>
								<div class="btn-group btn-group-xs btn-group-justified col-lg-3" style="width:30%">
									<a class="btn btn-xs btn-default" onClick='addItem()' id='AddItem'>Add new Item</a>
									<a class="btn btn-xs btn-default" onClick='removeItem()' id='AddItem'>remove row</a>
								</div>
								<div class="col-lg-12" style="width:120%; margin-left:-60px;">
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
												<td><input type="text"class="form-control" name="IPQ[]"  id="txtPQ_0"value=""  style="width:100px" required/></td>
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
						<div class="col-lg-12">
							<hr/>
							Payment Method 
							<select name="paymentmethod">
								<option value="10">10 % deposit</option>
								<option value="15">15 % deposit</option>
								<option value="30">30 % deposit</option>
							</select>
							<br/>
							<input name="serviceType" type="hidden" value="<?=$serviceT?>"/>
							<br/>
						</div>
                    </div>

                </div>
			   </form>
            </div>
         </div>
</div>
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

							}
						);
				
	</script>
</body>