<?php
   $db = mysqli_connect('localhost','root','','ipheya');

   $sql = "CREATE TABLE suppliers
   (
     supplier_id int NOT NULL AUTO_INCREMENT,
     PRIMARY KEY(supplier_id),
     supplier_no varchar(50),
     company_name varchar(50),
     address varchar(50),
     line2 varchar(50),
     line3 varchar(50),
     line4 varchar(50),
     post_code varchar(10),
     contact_name varchar(50),
     telephone varchar(11),
     mobile varchar(11),
     fax varchar(11),
     email varchar(175),
     web varchar(175)
   )";
   if(mysqli_query($db,$sql))
   {
     echo '--Table suppliers has been created successfully--<br>';
   }
   else{
     echo 'Table supplier not created: '.mysqli_error($db).'<br>';
   }
   /*$sql = "CREATE TABLE supplier_contact
   (
     scontact_id int NOT NULL AUTO_INCREMENT,
     PRIMARY KEY(scontact_id),
     supplier_id int,
     FOREIGN KEY(supplier_id) REFERENCES suppliers(supplier_id),
     postal_address text,
     telephone varchar(10),
     mobile varchar(10),
     fax varchar(10),
     web varchar(75),
     email varchar(175)
   )";
   if(mysqli_query($db,$sql))
   {
    echo '--Table supplier_contact has been created successfully--<br>';
   }
   else{
     echo 'Table supplier_contact not created: '.mysqli_error($db).'<br>';
   }*/
   $sql = "CREATE TABLE supplier_agreement
   (
     sagreement_id int NOT NULL AUTO_INCREMENT,
     PRIMARY KEY(sagreement_id),
     supplier_no varchar(20),
     deposit varchar(10),
     liability_clause text,
     discount varchar(10),
     delivery_fee varchar(10),
     start_date date,
     end_date date,
     warranty varchar(50)
   )";
   if(mysqli_query($db,$sql))
   {
    echo '--Table supplier_agreement has been created successfully--<br>';
   }
   else{
     echo 'Table supplier_agreement not created: '.mysqli_error($db).'<br>';
   }
   mysqli_close($db);
 ?>
