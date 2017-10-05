<?php
   $logic =new Logic();
   $feedback="";
   $sql =  mysqli_query($db, "SELECT p.product_image, p.product_description, p.product_name, r.product_deposit, r.quantity FROM rentals as r JOIN inventories i ON i.inventry_id = r.inventory_id JOIN product as p ON p.product_id = i.product_id;");
   if(!$sql)
   {
     die("Error");
   }
   $inventories = '';
   while($prod = mysqli_fetch_assoc($sql)):
     $inventories .= '	<div class="col-xs-3" id="event" style="border:1px #999 solid; max-height:400px; margin:1%; box-shadow:6px 6px 6px #eee;">
                 <div style="width:95%;  margin-left:-15px; height:150px;">
                     <img src="data:image/*;base64,'.$prod['product_image'].'" style="display:block; padding-left:-6px;" width="120%" height="100%"/>
                 </div>
                 <div style="padding-bottom:3px; min-heigh:150px;">
                     <h3 style="display: -webkit-box; overflow : hidden; text-overflow: ellipsis; -webkit-line-clamp: 1;-webkit-box-orient: vertical; ">'.$prod['product_name'].'</h3>
                     <p style="display: -webkit-box;
                     overflow : hidden;
                     text-overflow: ellipsis;
                     -webkit-line-clamp: 3;
                     -webkit-box-orient: vertical; ">'.$prod['product_description'].'</p>
                     <p style="font-size:11px">Available: '.$prod['quantity'].'| Deposit: R '.number_format($prod['product_deposit'],2,","," ").'</p>
                     <p class="text-right"><a data-toggle="modal" class="btn btn-primary btn-sm" data-target="#rentalModal">Rent</a> </p>
                 </div>
             </div>';
   endwhile;
   #add Timelines
   if(isset($_POST['Submit']))
   {
   $pickup_date=$_POST['pickup_date'];
   $return_date=$_POST['return_date'];   
   $quantity=$_POST['quantity'];   
   $total_charge=$_POST['total_charge'];
   $total_deposit=$_POST['total_deposit'];
   $total_amount=$_POST['total_amount'];
   $query="INSERT INTO client_rentals(client_rental,client_id,pickup_date,return_date,quantity,total_charge,total_deposit,total_amount,payed_amount,is_payed) VALUES (NULL,Null,'$pickup_date','$return_date','$quantity','$total_charge',' $total_deposit','$total_amount',Null,Null);";
   $result = mysqli_query($db,$query);
   if(!$result)
   {
           $feedback =$logic->display_error("Error!".mysqli_error($db).$query);
   }
   else
   {
         $feedback =$logic->display_success("Sucess! your is Bookings saved");
   }
   
   }
   
   $query_result = $logic->getAllRental();
   $rental_list ='';
   $error='';
   $status ='';
   while($rent = mysqli_fetch_assoc($query_result))
 
   {
     $rental_list.="<tr><td>".date_format(date_create($rent['pickup_date']),'d F Y')."</td><td>".date_format(date_create($rent['return_date']),'d F Y')."</td></tr>";
    }
     if($rental_list == '')
     {
       $error = '<div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> No Project at the moment<br/> <a href="createproject.php">Create Project</a></div>';
     }
   ?>


