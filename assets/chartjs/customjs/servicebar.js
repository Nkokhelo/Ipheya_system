$(document).ready(function() {
    var client = $('#client_id').val();
    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/servicehistorychart.php",
        data: "client=" + client,
        success: function(data) {
            var count = [];
            var s_name = [];
            for (var i in data) {
                // RequestID.push(data[i].historyID);
                count.push(data[i].req_count);
                s_name.push(data[i].service_name);
            }
            // var chartdata = {
            //     labels: ['name', 'name2', 'name3', 'name4'],
            //     datasets: [{
            //         label: "Most wanted services",
            //         fill: false,
            //         lineTension: 0.1,
            //         backgroundColor: "rgba(59, 89, 152, 0.75)",
            //         borderColor: "rgba(59, 89, 152, 1)",
            //         pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
            //         pointHoverBorderColor: "rgba(59, 89, 152, 1)",
            //         data: [1, 3, 5, 8]
            //     }]
            // };

            var ctx = $('#barcanvas');
            // var cty = $('#hbarcanvas');

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: s_name,
                    datasets: [{
                        label: "requested service",
                        fill: false,
                        backgroundColor: "rgba(143, 198, 162,0.5)",
                        borderColor: "rgba(143, 198, 162,1)",
                        borderWidth: 2,
                        pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                        pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                        data: count
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                stepValue: 0.5,
                                max: 10
                            }
                        }]
                    }
                }
            });
        },
        error: function(data) {
            alert("TF bro");
        }
    });
});