<?php
    $logic = new Logic();
    if(isset($_POST['Submit']))
    { 
       $Subject = $_POST['Subject'];
       $RequestType =$_POST['RequestType'];
       $ProblemDescription = $_POST['ProblemDescription'];
       $date = date('Y-m-d');

       if(empty($Subject))
       {
            $error ="The Subject is requred";
       }
       if(empty($RequestType))
       {
            $error ="tyep of is requred";
       }
       if(empty($ProblemDescription))
       {
            $error ="The Subject is requred";
       }


          $Subject = mysqli_real_escape_string($db,$Subject);
          $Subject = sanitize($Subject);  
          $RequestType = mysqli_real_escape_string($db,$RequestType);
          $RequestType = sanitize($RequestType);  
          $ProblemDescription = mysqli_real_escape_string($db,$ProblemDescription);
          $ProblemDescription = sanitize($ProblemDescription);    

          $insert ="INSERT INTO ticket VALUES(NULL,'{$Subject}','{$RequestType}','{$ProblemDescription}','{$date}')";   
          if(!mysqli_query($db,$insert))
          {
            die('Error'.mysqli_error($db));
          }
          die("<h1>Thank you for reporting we will call you soon!</h1><br/>
            <div class='col-md-8 col-offset-2'> The Ticket<br/>Ticket No :0111<br/>Request Date:#0505</div>
          <a href='' class='btn btn-default' >Back to HomePage</a>");
    }
   
?>