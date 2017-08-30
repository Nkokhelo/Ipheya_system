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

     $servicedata .= '<div class="card col-sm-6" style="">
                            <div class="col-xs-6"><img class="card-img-top" src="..." alt="Card image cap" width="200px" height="150px;"></div>
                            <div class="card-body">
                              <h3 class="card-title">'.$briefs['service'].'</h3>
                              <p class="card-text"><i>'.$briefs['description'].'</i></p>
                            </div>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">
                                <ul class=""
                              </li>
                              <li class="list-group-item">Rating: Comments: '.$commentdatacount.'</li>
                            </ul>
                            <div class="card-body">
                              <!--<a href="#" class="card-link">Card link</a>
                              <a href="#" class="card-link">Another link</a>-->
                              <form class="form" method="post" action="" style="margin-top:3%;">
                                    <div class="input-group">
                                        <input type="text" name="comment" class="form-control input-sm" placeholder="Type your comment here...">
                                        <input type="hidden" name="servid" value="'.$briefs['service_id'].'">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-sm" name="SendComment">Comment</button>
                                            <!--<input class="btn btn-warning btn-sm" type="submit" name="Send"value="Send Comment">-->
                                        </span>
                                    </div>
                                </form>
                            </div>
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
       $replysql = mysqli_query($db, "SELECT * FROM replies WHERE comment_id = '$comment[comment_id]' AND visibility = 1");
       $replycount = mysqli_num_rows($replysql);
       $servicedata .= '<p>'.$comment['comment_text'].'<br><span class="glyphicon glyphicon-time></span> "'.$comment['comment_date'].'<hr></p>
                        <div class="col-sm-3">
                           <a href="service-ratings.php?service='.$serviceid.'&likec='.$comment['comment_id'].'"><span class="glyphicon glyphicon-heart"></span> like</a>
                        </div>
                        <div class="col-sm-9">
                        <form class="form" method="post" action="">
                                          <div class="input-group">
                                              <input type="text" name="reply" class="form-control input-sm" placeholder="Type your reply here...">
                                              <input type="hidden" name="commid" value="'.$comment['comment_id'].'">
                                              <span class="input-group-btn">
                                                  <button class="btn btn-warning btn-sm" name="SendReply">Reply</button>
                                                  <!--<input class="btn btn-warning btn-sm" type="submit" name="Send"value="Send">-->
                                              </span>
                                          </div>
                                      </form>
                        </div>
                        <hr>
                        <span class="glyphicon glyphicon-heart"></span> ('.$comment['likes'].') <span class="glyphicon glyphicon-comment"></span> ('.$replycount.')<hr>
                        <i style="text-info">Replies</i><hr>
                        ';
        while($reply = mysqli_fetch_assoc($replysql)):
          $servicedata .= '<p>>> '.$reply['reply_text'].'<br><span class="glyphicon glyphicon-time></span> '.$reply['reply_date'].'</p><hr>
                            <span class="glyphicon glyphicon-heart"></span>('.$reply['likes'].') <a href="service-ratings.php?service='.$serviceid.'&liker='.$reply['reply_id'].'">Like</a>';
        endwhile;
        $servicedata .= '<br>===============================================================';
     endwhile;
     $servicedata .= '</div><a class="btn btn-success pull-right" href="service-ratings.php"><< Go back</a>';
   }

   #add new comment
   if(isset($_GET['new-comment']))
   {

   }

   #new reply
   if(isset($_POST['SendReply']))
   {
     $serviceid = mysqli_real_escape_string($db, $_GET['service']);
     $reply = mysqli_real_escape_string($db, $_POST['reply']);
     $commid = mysqli_real_escape_string($db, $_POST['commid']);
     if(mysqli_query($db,"INSERT INTO replies(comment_id,reply_text,reply_date,likes,visibility) VALUES('{$commid}','{$reply}',NOW(),0,1)"))
     {
       header('Location: service-ratings.php?service='.$serviceid);
     }
     else{
       echo '<script>alert("'.mysqli_error($db).'")</script>';
     }
   }
   #like reply
   if(isset($_GET['liker']))
   {
     $replyid = mysqli_real_escape_string($db, $_GET['liker']);
     $serviceid = mysqli_real_escape_string($db, $_GET['service']);

     $replyquery = mysqli_query($db, "SELECT likes FROM replies WHERE reply_id = '$replyid'");
     $likes = mysqli_fetch_assoc($replyquery);
     $totlikes = $likes['likes'];
     $totlikes+=1;

     if(mysqli_query($db, "UPDATE replies SET likes = '$totlikes' WHERE reply_id = '$replyid'"))
     {
       header('Location: service-ratings.php?service='.$serviceid);
     }
     else{
       echo '<script>alert("'.mysqli_error($db).'")</script>';
     }
   }

   #like comment
   if(isset($_GET['likec']))
   {
     $commentid = mysqli_real_escape_string($db, $_GET['likec']);
     $serviceid = mysqli_real_escape_string($db, $_GET['service']);

     $commentquery = mysqli_query($db, "SELECT likes FROM comments WHERE comment_id = '$commentid'");
     $likes = mysqli_fetch_assoc($commentquery);
     $totlikes = $likes['likes'];
     $totlikes+=1;

     if(mysqli_query($db, "UPDATE comments SET likes = '$totlikes' WHERE comment_id = '$commentid'"))
     {
       header('Location: service-ratings.php?service='.$serviceid);
     }
     else{
       echo '<script>alert("'.mysqli_error($db).'")</script>';
     }
   }

   #new comment
   if(isset($_POST['SendComment']))
   {
     $comment = mysqli_real_escape_string($db, $_POST['comment']);
     $serviceid = mysqli_real_escape_string($db, $_POST['servid']);

     if(!empty($comment))
     {
       if(mysqli_query($db, "INSERT INTO comments(service_id,comment_text,comment_date,likes,visibility) VALUES('{$serviceid}','{$comment}',NOW(),0,1)"))
       {
         header('Location: service-ratings.php');
       }
       else{
         echo '<script>alert("'.mysqli_error($db).'")</script>';
       }
     }
   }
 ?>
