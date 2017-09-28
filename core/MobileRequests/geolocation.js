$(function(){
  navigator.geolocation.getCurrentPosition(success, error);

  function success(position){
    //getting the coordinates
    var lat = position.coords.latitude;
    var long = position.coords.longitude;

    
});
