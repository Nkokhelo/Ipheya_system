 var skylink = new Skylink();
   var vidbody = document.getElementById('vidcont');
function call()
{
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

   skylink.on('mediaAccessSuccess', function(stream) {
      var vid = document.getElementById('myvideo'); attachMediaStream(vid, stream);
       });


       skylink.init({apiKey: '6e8c68af-507f-4d71-856a-de3766df21e1', defaultRoom: 'room1' }, 
       function() 
       {
        skylink.joinRoom({ audio: true,video: true});
       });
}



function end (){
   skylink.stopStream();
   console.log('stop communication');
}
skylink.on('peerLeft', function(peerId, peerInfo, isSelf) {
     var vid = document.getElementById(peerId);
     console.log("peer has left");
     // modal.close(); we will test this later
     if(vid!=null){
      vidbody.removeChild(vid);
     }
   });
   