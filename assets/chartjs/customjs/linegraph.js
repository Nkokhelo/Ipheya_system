$(document).ready(function(){
  $.ajax({
    url : "/ipheya/core/sub/target-chart-sub.php",
    type : "GET",
    success : function(data){
      //console.log(data);
      var targetid = [];
      var ipaddress = [];
      var firstvisit = [];
      var lastvisit  = [];
      var totalvisits = [];

      for(var i in data)
      {
        ipaddress.push(data[i].ip_address);
        firstvisit.push(data[i].first_visit);
        lastvisit.push(data[i].last_visit);
        totalvisits.push(data[i].total_visits);
      }

      var chartdata = {
         labels: ipaddress,
         datasets: [
           {
             label: "total visits",
             fill: false,
             lineTension: 0.1,
             backgroundColor: "rgba(59, 89, 152, 0.75)",
             borderColor: "rgba(59, 89, 152, 1)",
             pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
             pointHoverBorderColor: "rgba(59, 89, 152, 1)",
             data: totalvisits
           }
         ]
      };

      //create chart objects
      var ctx = $('#barcanvas');
      var cty = $('#hbarcanvas');
      var ctz = $('#linecanvas');

      //bind data
      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
      var HorizontalBarGraph = new Chart(cty, {
        type: 'horizontalBar',
        data: chartdata
      });
      var lineGraph = new Chart(ctz, {
        type: 'line',
        data: chartdata
      });
    },
    error : function(data){
      alert("TF bro");
    }
  });
});
