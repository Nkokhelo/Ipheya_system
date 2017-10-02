$(document).ready(function(){
  var interval = setInterval(function () {
      $(function(){
        navigator.geolocation.getCurrentPosition(success, error);

        function success(position){
          //getting the coordinates
          var lat = position.coords.latitude;
          var long = position.coords.longitude;
            $.ajax({
                      type: "POST",
                      url: "insert.php",
                      data: "latitude=" + lat+ "&longitude=" + long,
                      success: function(data) {
                         alert("WTF");
                      }
                  });
        }
        function error(){
          $('body').html("Error");
        }
      });
  }, 1000);
});
