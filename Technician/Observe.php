<?php
# 21408789 Zulu NP
$con=mysqli_connect('localhost','root','');
if(!$con)
	die('Could not connect'.mysqli_error());
	
$data="Create Database Observe";
if(mysqli_query($con,$data))
	echo"Database created Successful <br/>";
else
	echo "Failed to create Database <br/>".mysqli_error($con);
	
	mysqli_select_DB($con,"Observe");
	$sql = "CREATE TABLE ServiceRequest
           (
             RequestID int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(RequestID),
             ClientID int(11),
             FOREIGN KEY(ClientID) REFERENCES clients(client_id),
             ServiceID int,
             FOREIGN KEY(ServiceID) REFERENCES services(service_id),
             Description text,
             RequestDate date,
             RequestStatus varchar(50),
             SurveyingDate date,
             Duration int,
             Warrant int,
             DueDate date,
             RequestType varchar(11)
           )";
    if(mysqli_query($con,$sql)){
      echo '<BR>{--TABLE ServiceRequest created--}';
    }
    else{
      echo '<BR><<[Failed TO CREATE ServiceRequest : '.mysqli_error($con).']>>';
    }
    $mvelo="Create Table Surveying
	(
		SurveyingID int NOT NULL AUTO_INCREMENT,
		Primary KEY(SurveyingID),
		RequestID int(11),
		FOREIGN KEY(RequestID) REFERENCES clients(RequestID),
		Description text,
		Image LongBlob
	)";
	if(mysqli_query($con,$mvelo)){
      echo '<BR>{--TABLE Surveying created--}';
    }
    else{
      echo '<BR><<[Failed TO CREATE Surveying : '.mysqli_error($con).']>>';
    }
    
	$ins="Insert into ServiceRequest Values
	(1,3434,5432,'wertfgh','20170510','sdf','20170511',4,4,'20170518','sdfg')";
	if(mysqli_query($con,$ins)){
      echo '<BR>{--Inserted Successful --}';
    }
    else{
      echo '<BR><<[Failed Insert : '.mysqli_error($con).']>>';
    }
	
	mysqli_close($con);
		
?>