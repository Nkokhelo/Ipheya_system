$(document).ready(function() {
    var line2 = $('#line2');
    var myChart2 = new Chart(line2, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "March", "April", "May", "June"],
            datasets: [{
                label: 'Expenses',
                lineTension: 0,
                fill: false,
                borderWidth: 2,
                data: [12, 19, 3, 5, 2, 3],
                borderColor: "rgba(188, 75, 75,0.5)",
                backgroundColor: "rgba(188, 75, 75,0.5)"
            }, {
                label: 'Incomes',
                lineTension: 0,
                fill: false,
                borderWidth: 2,
                data: [10, 5],
                backgroundColor: "rgba(133, 219, 107,0.5)",
                borderColor: "rgba(133, 219, 107,0.5)",
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});