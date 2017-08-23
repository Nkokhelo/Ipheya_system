<?php
   $db = mysqli_connect('localhost','root','','ipheya');
   $servicequery = mysqli_query($db, "SELECT * FROM services");
   $servicedata = '';
   while($briefs = mysqli_fetch_assoc($servicequery)):
     $serviceid = $briefs['service_id'];
     include('../core/sub/calculate-ratings-sub.php');
     #find number of comments
     $commentsql = mysqli_query($db, "SELECT comment_text FROM comments WHERE service_id = '$briefs[service_id]'");
     $commentdatacount = mysqli_num_rows($commentsql);

     $servicedata .= '<div class="col-md-8">
                        <h3 class="title">'.$briefs['service'].'</h3><hr>
                        <p>'.$briefs['description'].'</p>
                        <span>Rating: '.$rating.'</span> <span>Comments: '.$commentdatacount.'</span>
                        <a href="service-ratings.php?service='.$briefs['service_id'].'" class="btn btn-md btn-primary">View info</a>
                        <hr>
                      </div>';
   endwhile;

   #display information for single services
   if(isset($_GET['service']))
   {
     #find service name as title
     $serviceid = mysqli_real_escape_string($db, $_GET['service']);
     $titlesql = mysqli_query($db, "SELECT service FROM services WHERE service_id = '$serviceid'");
     $title = mysqli_fetch_assoc($titlesql);
     $servicedata = '<div class="col-md-8">
                        <h3 class="title">'.$title['service'].'</h3><hr>';
     #determine rating
     include('../core/sub/calculate-ratings-sub.php');
     #select all comments corresponding with service
     $commentsql = mysqli_query($db, "SELECT * FROM comments WHERE service_id = '$serviceid' AND visibility = 1");
     while($comment = mysqli_fetch_assoc($commentsql)):
       $servicedata .= '';
     endwhile;
     $servicedata .= '</div>';
   }

   #add new comment
   if(isset($_GET['new-comment']))
   {

   }

   #rate  sevice

 ?>
