<?php
#find and calculate service rating
$ratingsql = mysqli_query($db,"SELECT rating FROM ratings WHERE service_id = '$serviceid'");
$ratingdatacount = mysqli_num_rows($ratingsql);
$rating = 0;
foreach($ratingsql as $ratingdata)
{
  $rating += $ratingdata['rating'];
}
if($rating!=0 && $ratingdatacount!=0)
{
  $rating = $rating/$ratingdatacount;
}
 ?>
