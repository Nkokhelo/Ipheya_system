<?php
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
