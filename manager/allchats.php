<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('../core/logic.php');  
  include('includes/head.php');
  include('../core/controllers/allchats-controller.php');
}
else
{
  header("Location:../login.php");
}
?>
<script src="//cdn.temasys.io/skylink/skylinkjs/0.6.x/skylink.complete.min.js"></script>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
             <?=  $feedback?>
            <div class="col-xs-6">
              <ol class="breadcrumb">
              <li>
               <a href="dashboard.php">
                <i class="fa fa-home"></i> Home
               </a>
              </li>		
              <li class="active">
                <i class="fa fa-users"></i> Labour
              </li>		  
             </ol>
            </div><!-- /col-xs-6-->
              <div class="col-xs-11 b" >
                <h2>Online users</h2><hr class="bhr">
                   <table class="table" id="online">
                    <thead>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Call</th>
                    </thead>
                    <tbody>
                     <?= $chatlist ?>
                    </tbody>
                   </table>
              </div>


              <!--Modal start-->
              <div id="myModal" class="modal fade" role="dialog">
               <div class="modal-dialog">
                 <!-- Modal content-->
                 <div class="modal-content">
                   <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"><i class="fa fa-phone"></i> Video Call</h4>
                   </div>
                   <div class="modal-body">
                    <div class="row">
                     <div class="col-xs-11 col-xs-offset-1" >
                       <div class="col-xs-12" id='vidcont'>
                         <video id="myvideo" style="transform: rotateY(-180deg);" autoplay></video>
                       </div>  
                     </div>
                    </div>
                   </div>
                   <div class="modal-footer">
                    <div class="col-xs-4">
                        <button class="btn btn-block btn-success"><i class="fa fa-phone"></i> Start</button>
                     </div>
                    <div class="col-xs-4">
                      <button class="btn btn-block btn-primary"><i class="fa fa-phone-square"></i> Hang</button>
                    </div>
                    <div class="col-xs-4">
                     <button type="button" class="btn btn-block btn-danger" data-dismiss="modal" onclick="end()">End</button>
                    </div>
                   </div>
                 </div>

               </div>
             </div>
 <!--Modal end-->
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script src="/ipheya/assets/js/stream.js"></script>