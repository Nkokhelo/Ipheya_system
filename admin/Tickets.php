<?php
<<<<<<< HEAD

    session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('includes/head2.php');
        // include('includes/navigation.php');
        // include('includes/sidebar.php');
        include('../core/logic.php');
        require_once('../core/controllers/ticket-controller.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class="col-xs-10 b">
            <?php if($id == 0){ ?>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active" data-toggle="tab"><a href="#new" data-toggle="tab">New</a></li>
                    <li><a href="#common" data-toggle="tab">Common</a></li>
                    <li><a href="#acknowledged" data-toggle="tab">Acknowledged</a></li>
                    <!--<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Common
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Submenu 1-1</a></li>
                            <li><a href="#">Submenu 1-2</a></li>
                            <li><a href="#">Submenu 1-3</a></li>
                        </ul>
                    </li>-->
                    <li><a  href="#inProgress" data-toggle="tab">In progress</a></li>
                    <li><a  href="#Resolved" data-toggle="tab">Resolved</a></li>
                </ul>
                <?php } else{} ;?>
                <div class="col-md-12" style="padding:2%;">
                    <?php if(isset($id) && $id != 0){
                        echo '<div class="col-sm-12 " style="padding-bottom:15px"><h2>Ticket Information</h2><hr class="bhr" /><p style="font-size:1.2em">
                                    <table class="table">
                                        <tr>
                                            <td><strong>Client Name:</strong></td><td>'.$custresult['name'].' '.$custresult['surname'].'</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Subject:</strong></td><td>'.$tresult['Subject'].'</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Problem:</strong></td><td>'.$tresult['ProblemDescription'].'</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date Problem was repoted:</strong></td><td> '.$tresult['DatePlaced'].'</td>
                                        </tr>
                                    </table>
                            <hr class="bhr"/>
                            <a href="Tickets.php" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Go back</a></div>';
                        } else{ ?>
                        <div class="tab-content" >
                            <div role="tabpanel" class="tab-pane fade in active" id="new">
                                <?=$newtickets;?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="common">
                                <?=$common;?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="acknowledged">
                                <?=$acknowledged;?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="inProgress">
                                <?=$pending;?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Resolved">
                                <?=$resolved;?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

   <script>
        // //changes the tab navigation
        //  $('#myTab li').click(function(){
        //      $('.nav li').removeClass('active');
        //      $(this).addClass('active');
        //  });
        //    $(document).ready(function(){
        //        $('#myTab a').click(function(e){
        //            e.preventDefault()
        //            $(this).tab('show')
        //        });

        //        $('a[data-toggle="tab"]').on('shown.bs.tab', function(t){
        //            t.relatedTarget
        //        });
        //    });
   </script>
=======
    require_once('../core/init.php');
    include('includes/head.php');
    include('includes/navigation.php');
    include('includes/sidebar.php');
    include('../core/logic.php');
    require_once('../core/controllers/ticket-controller.php');
?>
   <div class="container-fluid">
     <div class="col-lg-8" style="margin:2%">
       <?php if($id == 0){ ?>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#new">New</a></li>
            <li><a href="#common">Common</a></li>
            <li><a href="#acknowledged">Acknowledged</a></li>
            <!--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Common
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Submenu 1-1</a></li>
                    <li><a href="#">Submenu 1-2</a></li>
                    <li><a href="#">Submenu 1-3</a></li>
                </ul>
            </li>-->
            <li><a  href="#inProgress">In progress</a></li>
            <li><a  href="#Resolved">Resolved</a></li>
        </ul>
        <?php } else{} ;?>
        <div class="container-fluid" style="background-color:#fff;border:1px solid #ccc;border-top:none;">
          <div class="col-md-12" style="padding:2%;">
            <?php if(isset($id) && $id != 0){
                echo '<p style="font-size:1.2em">
                         <strong>Client:</strong> '.$custresult['name'].' '.$custresult['surname'].'<br>
                         <strong>Subject:</strong> '.$tresult['Subject'].'<br>
                         <strong>Description:</strong> '.$tresult['ProblemDescription'].'<br>
                         <strong>Date:</strong> '.$tresult['DatePlaced'].'<br>
                      </p>
                      <a href="Tickets.php" class="btn btn-warning"><< Go back</a>';
                } else{ ?>
                  <div class="tab-content">
                       <div role="tabpanel" class="tab-pane fade in active" id="new">
                         <?=$newtickets;?>
                       </div>
                       <div role="tabpanel" class="tab-pane fade" id="common">
                          <?=$common;?>
                       </div>
                       <div role="tabpanel" class="tab-pane fade" id="acknowledged">
                          <?=$acknowledged;?>
                       </div>
                       <div role="tabpanel" class="tab-pane fade" id="inProgress">
                          <?=$pending;?>
                       </div>
                       <div role="tabpanel" class="tab-pane fade" id="Resolved">
                          <?=$resolved;?>
                       </div>
                 </div>
             <?php } ?>
           </div>
        </div>
     </div>
   </div>
   <script>
        //changes the tab navigation
         $('#myTab li').click(function(){
             $('.nav li').removeClass('active');
             $(this).addClass('active');
         });
         //changes tab content
         /*$(document).ready(function(){
             $('#1').click(function(){
                 $('#myTab a[href="#new"]').tab('show');
             });
              $('#2').click(function(){
                 $('#myTab a[href="#common"]').tab('show');
             });
             $('#3').click(function(){
                 $('#myTab a[href="#acknowledged"]').tab('show');
             });
              $('#5').click(function(){
                 $('#myTab a[href="#solved"]').tab('show');
             });
           });*/
           $(document).ready(function(){
               $('#myTab a').click(function(e){
                   e.preventDefault()
                   $(this).tab('show')
               });

               $('a[data-toggle="tab"]').on('shown.bs.tab', function(t){
                   t.relatedTarget
               });
           });
   </script>
</body>
>>>>>>> 3e1b0c896d9d12b3f76cfc6406b6bd3a9c50292a
