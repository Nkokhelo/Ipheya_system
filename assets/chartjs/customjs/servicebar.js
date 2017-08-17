$(document).ready(function(){
 alert("ready");
 $.ajax({
  url : "/ipheya/core/sub/servicehistorychart.php",
  type : "GET",
  success : function(data){
    alert(JSON.parse(data));
      var RequestID=[];
      var clientID=[];
      var serviceID=[];

      for(var i in data)
        {
          RequestID.push(data[i].historyID);
          clientID.push(data[i].clientID);
          serviceID.push(data[i].serviceID);
        }
        alert(serviceID[1]);
        var chartdata = {
            labels: serviceID,
            datasets: [
              {
                label: "Most wanted services",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(59, 89, 152, 0.75)",
                borderColor: "rgba(59, 89, 152, 1)",
                pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                data: RequestID
              }
            ]
         };

         var ctx = $('#barcanvas');
         var cty = $('#hbarcanvas');

         var barGraph = new Chart(ctx, {
            type: 'bar',
            data: chartdata
          });
          var HorizontalBarGraph = new Chart(cty, {
            type: 'horizontalBar',
            data: chartdata
          });
        },
        error : function(data){
          alert("TF bro");
        }
      });
 });
     


    