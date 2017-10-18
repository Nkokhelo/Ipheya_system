<?php
 $date = date('y-m-d h:i');
 $date2 = date('2017-10-10 15:30');
 $diff = date_diff(date_create($date),date_create($date2));
 $moment ='';

 if($diff->y != 0)
 {
    $moment .=$diff->y."year(s) ago";
 }
 else if($diff->m != 0)
 {
    $moment .=$diff->m."month(s) ago";
 }
 else if($diff->d != 0)
 {
    if($diff->d >= 7 )
    {
        $moment .=number_format(($diff->d/7),0)."week(s) ago";
    }
    $moment .=$diff->d ."day(s) ago";
 }
 else if($diff->h != 0)
 {
    $moment .=$diff->h."hour(s) ago";
 }
 else if($diff->i != 0)
 {
    $moment .=$diff->i."minute(s) ago";    
 }else if($diff->s != 0)
 {
    $moment .=$diff->i."seconds(s) ago";    
 }
 else
 {
     $moment .="just now";
 }

    print_r($moment);
?>