<script type="text/javascript" src="../assets/jquery/jquery-1.10.2.js"></script>
<link type="text/css" rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css"/>
<style type="text/css">
	#ItemTable
	{
			font-size:13px;
	}
	#ItemTable>thead
	{
		font-style: italic;
		font-size:13px;
		color:#33b5e5;
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
         <div class="col-lg-9 col-md-9  col-sm-9 col-xs-9  ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <form method="POST" action="quotation.php">
			   			<div class="col-lg-12">
							<div class="col-md-push-8 col-md-8 btn-group">
								<input class="btn btn-xs btn-info" name="submit" type="submit" value="Save To Draft"/> 
								<input class="btn btn-xs btn-info" name="email"  type="submit" value="Send Email"/> 
								<input class="btn btn-xs btn-info" name="pdf_con"type="submit" value="Convert to PDF"/>
							</div>
						</div>
						<hr/>
                <div class="col-lg-12">
					<div class="col-md-12">
						<div class="col-md-12">
							    <div class="col-lg-6">
									<h1>Ipheya IT Solution</h1>
									<table>
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
									<h1 style="float:right">Qoute</h1>
									<table style="width:100%" align="right">
										<tr><td>Date </td><td><input name="qdate" id="" type="date" value="" required/></td></tr>
										<tr><td>Title</td><td> <input name="title" id="" value="" required/></td></tr>
										<tr><td>Customer </td><td><select name="clientid" href='quotation.php?cid=' id='clients'><option name="clientid" value='0'>Select a client</option><?=$options ?></select></td></tr>
										<tr><td>Valid Until</td><td> <input name="edate" id="" type="date" value="" required/></td></tr>
										<tr><td>.</td><td> </td></tr>
										<tr><td>.</td><td></td></tr>
									</table>
								</div>
						</div>
					</div>
                <div class="col-lg-12 ">
					<hr/>
					<div class="col-md-12">
						<div class="col-md-6">
							<h3>Customer Information</h3>
							<div id="result">
								<?=$client_information?>
							</div>
						</div>
						<div class="col-md-6">
							Summary<br/>
							<textarea rows="4" name="summary" cols="50"></textarea>
						</div>
					</div>
					<br/>
					<hr style="width:100%;padding-top:15px;"/>
                       <div class="col-md-12">
					   		<div class="col-md-12">
							    <div class="col-lg-8">
									<h5>Items to be purchased</h5>
								</div>
								<div class="col-lg-3">
									<a class="btn btn-xs btn-default" onClick='addItem()' id='AddItem'>Add new Item</a>
									<a class="btn btn-xs btn-default" onClick='removeItem()' id='AddItem'>remove row</a>
								</div>
								<div class="col-lg-12" style="border:1px #000 solid;">
									<div class="table-responsive">
										<table id="ItemTable">
										<thead>
											<th>Name</th>
											<th>Description</th>
											<th>Quantity</th>
											<th>UnitPrice</th>
											<th>Price x Quan</th>
										</thead> 
										<tbody id="items">
											<tr>
												<td><input type="text" name="IName[]"  id="txtN_0" value="" placeholder="Item Name" required/></td>
												<td><input type="text" name="IDescription[]"  id="txtD_0" value="" style="width:350px" placeholder="Description" required/></td>
												<td><input type="text" name="IQuantiy[]"  id="txtQ_0" value="" style="width:100px" onkeyup="generateTotals(this)" placeholder="No.of Items" required/></td>
												<td><input type="text" name="IUnitPrice[]"  id="txtUP_0"value=""  style="width:80px" onkeyup="generateTotals(this)"  placeholder="Unit Price" required/></td>
												<td><input type="text" name="IPQ[]"  id="txtPQ_0"value=""  style="width:100px" required/></td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4"><b style="float:right"><i>TOTAL PRICE : </i></b></td>
												<td><input type="text" name="TotalPrice" id="TotalPrice" value="" style="width:100px" required/></td>
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
							newInput.id="txtN_"+arraycount;
						}
						else if(x ==1)
						{
							newInput.name='IDescription[]';
							newInput.placeholder ="Description";
							newInput.setAttribute('style','width:350px');
							newInput.id="txtD_"+arraycount;
							newInput.setAttribute('required','required');

						}
						else if(x ==2)
						{
							newInput.name='IQuantiy[]';
							newInput.placeholder="No.of Items";
							newInput.setAttribute('style','width:100px');
							newInput.setAttribute('onkeyup','generateTotals(this)');
							newInput.setAttribute('required','required');
							newInput.id="txtQ_"+arraycount;
						}
						else if(x==3)
						{
							newInput.name='IUnitPrice[]';
							newInput.placeholder="Unit price";
							newInput.setAttribute('style','width:80');
							newInput.setAttribute('onkeyup','generateTotals(this)');
							newInput.setAttribute('required','required');
							newInput.id="txtUP_"+arraycount;
						}
						else 
						{
							newInput.name='IPQ[]';
							newInput.setAttribute('style','width:100');
							newInput.setAttribute('required','required');
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
				
	</script>
</body>