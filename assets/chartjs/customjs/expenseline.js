$(document).ready(function() {
    // var line = $('#line');
    var line2 = $('#line2');
    // var line3 = $('#line3');
    var myChart = new Chart(line, {
        type: 'bar',
        data: {
            labels: ["Project 1", "Project 2", "Project 3", "Projct 4", "Project 5", "Project 6"],
            datasets: [{
                label: '# Projects',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
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
                data: [10, 11, 5, 2, 19, 3],
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

    var myChart3 = new Chart(line3, {
        type: 'pie',
        data: {
            datasets: [{
                data: [10, 20, 30]
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Red',
                'Yellow',
                'Blue'
            ]
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