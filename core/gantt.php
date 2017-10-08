<?php
$db = mysqli_connect('localhost','root','','ipheya');

/*"CREATE TABLE Task
(
  task_id int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(task_id),
  Name varchar(30),
  Duration int(3),
  DurationType varchar(15),
  Location varchar(50),
  StartDate date,
  EndDate date,
  Description Text,
  DatePosted DateTime,
  request_id int(11) not null,
  foreign key(request_id) references serviceRequest(RequestID),
  foreign key(request_id) references RepairRequest(RequestID)
)"*/
$sql = "CREATE TABLE task
         (
           task_id INT PRIMARY KEY AUTO_INCREMENT,
           project_id INTEGER,
           FOREIGN KEY(project_id) REFERENCES projects(id),
           name TEXT,
           start DATETIME,
           end DATETIME,
           parent_id INTEGER,
           date_posted DATETIME,
           location varchar(100),
           milestone BOOLEAN  DEFAULT '0' NOT NULL,
           ordinal INTEGER,
           ordinal_priority DATETIME,
           complete INTEGER  DEFAULT '0' NOT NULL,
           status varchar(100)
         )
      ";
  if(mysqli_query($db,$sql))
  {
    echo '&#10004; Table task created<br>';
  }
  else{
    echo '&#10008; Table task not created: '.mysqli_error($db).'<br>';
  }

  $sql = "CREATE TABLE link (
      id      INTEGER       PRIMARY KEY AUTO_INCREMENT,
      from_id INTEGER       NOT NULL,
      to_id   INTEGER       NOT NULL,
      type    VARCHAR (100) NOT NULL
    )";
    if(mysqli_query($db,$sql))
    {
      echo '&#10004; Table link created<br>';
    }
    else{
      echo '&#10008; Table link not created: '.mysqli_error($db).'<br>';
    }
 ?>
