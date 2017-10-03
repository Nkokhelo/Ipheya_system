<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('../core/logic.php');  
  include('includes/head.php');
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

            <div class="col-xs-6">
              <ol class="breadcrumb">
              <li>
               <a href="dashboard.php">
                <i class="fa fa-home"></i> Home
               </a>
              </li>		
              <li class="active">
                <i class="fa fa-video-camera"></i> Communication
              </li>		  
             </ol>
            </div><!-- /col-xs-6-->


              <div class="col-xs-11 b" >
                <h2>Communication</h2><hr class="bhr">
                <div class="col-xs-12" id='vidcont'>
                  <video id="myvideo" style="transform: rotateY(-180deg);" autoplay></video>
                </div> 
                <div class="col-xs-6 col-xs-offset-3">
                 <div class="col-xs-4">
                   <button class="btn btn-block btn-success"><i class="fa fa-phone"></i> Start</button>
                 </div>
                 <div class="col-xs-4">
                  <button class="btn btn-block btn-primary"><i class="fa fa-phone-square"></i> Hang</button>
                 </div>
                 <div class="col-xs-4">
                   <button class="btn btn-block btn-danger"><i class="fa fa-times-circle"></i> End</button>
                 </div>
               </div>  
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script>
   var skylink = new Skylink();
   var vidbody = document.getElementById('vidcont');

   skylink.on('peerJoined', function(peerId, peerInfo, isSelf) {
      if(isSelf) return; // We already have a video element for our video and don't need to create a new one.
      var vid = document.createElement('video');
      vid.autoplay = true;
      vid.muted = false; // Added to avoid feedback when testing locally
      vid.id = peerId;
      vidbody.appendChild(vid);
    });

    skylink.on('incomingStream', function(peerId, stream, isSelf) {
      if(isSelf) return;
      var vid = document.getElementById(peerId);
      attachMediaStream(vid, stream);
    });

   skylink.on('peerLeft', function(peerId, peerInfo, isSelf) {
     var vid = document.getElementById(peerId);
     console.log("peer has left");
     vidbody.removeChild(vid);
   });

   skylink.on('mediaAccessSuccess', function(stream) {
      var vid = document.getElementById('myvideo'); attachMediaStream(vid, stream);
       });


       skylink.init({
        apiKey: '6e8c68af-507f-4d71-856a-de3766df21e1',
        defaultRoom: 'room1'
      }, function() {
        skylink.joinRoom({
          audio: true,
          video: true
        });
      });
  </script>
</body>
