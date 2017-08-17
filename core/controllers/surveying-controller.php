<?php
  $logic = new Logic();
  $qresult = $logic->getallClients();
  $clientOptions ='';
  while($clients = mysqli_fetch_assoc($qresult))
  {
    $clientID = $clients['client_id'];
    $clientOptions .="<option value='$clientID'>".$clients['name']."</option>";
  }


  	$name="";$name_err=0;
			$cat="";$cat_err=0;
			$dis="";$dis_err=0;
			$date=date("Y-m-d");
			$status="";$status_err=0;
			$type="";$type_err=0;
			$class="";$class_err=0;
			$quantity="";$quantity_err=0;
			
			if(isset($_POST["submit"]))
			{	
				if($_POST["name"]==null)
					$name_err=1;
				else 
					$name=$_POST["name"];
				if($_POST["cat"]==null)
					$cat_err=1;
				else 
					$cat=$_POST["cat"];
					
				if($_POST["discr"]==null)
					$dis_err=1;
				else 
					$dis=$_POST["discr"];
					
				if($_POST["status"]==null)
					$status_err=1;
				else 
					$status=$_POST["status"];
					
				if(isset($_POST["company"]))
					$type=$_POST["company"];
				else 
					$type_err=1;
					
				if($_POST["class"]==null)
					$class_err=1;
				else 
					$class=$_POST["class"];

				if($_POST["quantity"]==null)
					$quantity_err=1;
				else
					$quantity=$_POST["quantity"];
				
			}

  
?>