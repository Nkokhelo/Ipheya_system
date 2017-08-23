<?php
  $con = mysqli_connect('localhost','root','','ipheya');

  #comments table
  $sql = "CREATE TABLE comments
           (
             comment_id int AUTO_INCREMENT PRIMARY KEY,
             service_id int,
             FOREIGN KEY(service_id) REFERENCES services(service_id),
             comment_text text,
             comment_date datetime,
             likes int,
             visibility int
           )";
   if(mysqli_query($con,$sql))
   {
     echo '--tbl.comments creation successfull--<br>';
   }
   else{
     echo '--tbl.comments error: '.mysqli_error($con).'<br>';
   }

   #reply table
   $sql = "CREATE TABLE replies
            (
              reply_id int AUTO_INCREMENT PRIMARY KEY,
              comment_id int,
              FOREIGN KEY(comment_id) REFERENCES comments(comment_id),
              reply_text text,
              reply_date datetime,
              likes int,
              visibility int
            )";
    if(mysqli_query($con,$sql))
    {
      echo '--tbl.replies creation successfull--<br>';
    }
    else{
      echo '--tbl.replies error: '.mysqli_error($con).'<br>';
    }

    #FAQs
    $sql = "CREATE TABLE faqs
             (
               faq_id int AUTO_INCREMENT PRIMARY KEY,
               department_id int,
               FOREIGN KEY(department_id) REFERENCES departments(department_id),
               question text,
               answer text
             )";
     if(mysqli_query($con,$sql))
     {
       echo '--tbl.faqs creation successfull--<br>';
     }
     else{
       echo '--tbl.faqs error: '.mysqli_error($con).'<br>';
     }

     #service ratings
     $sql = "CREATE TABLE ratings
              (
                rating_id int AUTO_INCREMENT PRIMARY KEY,
                service_id int,
                FOREIGN KEY(service_id) REFERENCES services(service_id),
                rating varchar(50)
              )";
      if(mysqli_query($con,$sql))
      {
        echo '--tbl.ratings creation successfull--<br>';
      }
      else{
        echo '--tbl.ratings error: '.mysqli_error($con).'<br>';
      }
?>
