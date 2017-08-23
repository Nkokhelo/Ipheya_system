// $(document).ready(function() {
//     var line2 = $('#line2');
//     var myChart2 = new Chart(line2, {
//         type: 'line',
//         data: {
//             labels: ["Jan", "Feb", "March", "April", "May", "June"],
//             datasets: [{
//                 label: 'Expenses',
//                 lineTension: 0,
//                 fill: false,
//                 borderWidth: 2,
//                 data: [12, 19, 3, 5, 2, 3],
//                 borderColor: "rgba(188, 75, 75,0.5)",
//                 backgroundColor: "rgba(188, 75, 75,0.5)"
//             }, {
//                 label: 'Incomes',
//                 lineTension: 0,
//                 fill: false,
//                 borderWidth: 2,
//                 data: [10, 5],
//                 backgroundColor: "rgba(133, 219, 107,0.5)",
//                 borderColor: "rgba(133, 219, 107,0.5)",
//             }]
//         },
//         options: {
//             scales: {
//                 yAxes: [{
//                     ticks: {
//                         beginAtZero: true
//                     }
//                 }]
//             }
//         }
//     });
// });

$(document).ready(function() {
    var client = $('#client_id').val();
    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/finatialR.php",
        data: "expenses=exp",
        success: function(data) {
            var date = [];
            var amount = [];
            for (var i in data) {
                // RequestID.push(data[i].historyID);
                date.push(data[i].date);
                amount.push(data[i].amount);
            }
            var ctx = $('#barcanvas');
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