$(document).ready(function() {
    var client = $('#client_id').val();
    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/finatialR.php",
        data: "expenses=exp",
        success: function(data) {

            var date = [];
            var amount_income = [];
            var amount_expense = [];
            for (var i in data) {
                date.push(data[i].date);
                if (data[i].type == 'e') {
                    amount_expense.push(data[i].amount);
                } else {
                    amount_income.push(data[i].amount);
                }
            }
            var line2 = $('#line2');
            var myChart2 = new Chart(line2, {
                type: 'line',
                data: {
                    labels: date,
                    datasets: [{
                        label: 'Expenses',
                        lineTension: 0,
                        fill: false,
                        borderWidth: 2,
                        data: amount_expense,
                        borderColor: "rgba(188, 75, 75,0.5)",
                        backgroundColor: "rgba(188, 75, 75,0.5)"
                    }, {
                        label: 'Incomes',
                        lineTension: 0,
                        fill: false,
                        borderWidth: 2,
                        data: amount_income,
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
        },
        error: function(data) {
            alert("TF bro");
        }
    });
});