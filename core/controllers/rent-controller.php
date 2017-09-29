<?php
   $sql =  mysqli_query($db, "SELECT * FROM inventories");
   $inventories = '';
   while($inv = mysqli_fetch_Assoc($inventories)):
     $query = mysqli_query($db, "SELECT product_name,product_image FROM product WHERE product_id = '$inv[product_id]'");
     $prod = mysqli_fetch_assoc($query);
     $inventories .= '	<div class="col-xs-3" id="event" style="border:1px #999 solid; max-height:340px; margin:1%; box-shadow:6px 6px 6px #eee;">
                 <div style="width:95%;  margin-left:-15px; height:150px;">
                     <img src="data:image/*;base64,'.$prod['product_image'].'" style="display:block; padding-left:-6px;" width="120%" height="100%"/>
                 </div>
                 <div style="padding-bottom:3px; min-heigh:150px;">
                     <h3 style="display: -webkit-box;
                     overflow : hidden;
                     text-overflow: ellipsis;
                     -webkit-line-clamp: 1;
                     -webkit-box-orient: vertical; ">'.$prod['product_name'].'</h3>
                     <p style="display: -webkit-box;
                     overflow : hidden;
                     text-overflow: ellipsis;
                     -webkit-line-clamp: 3;
                     -webkit-box-orient: vertical; ">BLANK</p>
                 </div>
             </div>';
   endwhile;