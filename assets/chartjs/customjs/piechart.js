$(document).ready(function() {
    var client_id = $('#client_id').val();
    var count = [];
    var servicename = [];
    $.ajax({
        type: "GET",
        url: "/ipheya/core/sub/servicehistorychart.php",
        data: "client=" + client_id,
        success: function(data) {
            for (var i in data) {
                count.push(data[i].req_count);
                servicename.push(data[i].service_name);
            }
        },
        error: function(data) {
            alert("WTF bro");
        }
    });
    var ctx1 = $('#piecanvas');
    var myChart = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: servicename,
            datasets: [{
                backgroundColor: [
                    "#2ecc71",
                    "#3498db",
                    "#95a5a6",
                    "#9b59b6",
                    "#f1c40f",
                    "#e74c3c",
                    "#34495e"
                ],
                data: count
            }]
        }
    });
});