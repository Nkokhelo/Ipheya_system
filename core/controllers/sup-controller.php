<?php
 $logic = new Logic();
 $faqs='';
 $allf = $logic->getallfaqs();
 
 while($f = mysqli_fetch_assoc($allf))
 {
   if($f['department_id']!=null)
   {
     $faqs.="<dt>".$f['question']."?</dt><dd>".$f['answer']."</dd><br><br>";
   }
 }   
?>