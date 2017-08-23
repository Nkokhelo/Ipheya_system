$(document).ready(function() {
    var amount_income = [];
    var amount_expense = [];
    var date = [];
    var client = $('#client_id').val();
    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/finatialR.php",
        data: "expenses=exp",
        success: function(data) {
            var date = [];
            for (var i in data) {
                date.push(data[i].date);
                amount_expense.push(data[i].amount);
            }
            $.ajax({
                type: "get",
                url: "/ipheya/core/sub/finatialR.php",
                data: "incomes=exp",
                success: function(data) {
                    for (var i in data) {
                        amount_income.push(data[i].amount)
                    }
                    var line2 = $('#lineView');
                    var myChart2 = new Chart(line2, {
                        type: 'line',
                        data: {
                            labels: date,
                            datasets: [{
                                label: 'Expenses',
                                lineTension: 0,
                                fill: false,
                                borderWidth: 3,
                                data: amount_expense,
                                backgroundColor: "rgba(188, 75, 75,.6)",
                                borderColor: "rgba(188, 75, 75,0.5)"
                            }, {
                                label: 'Incomes',
                                lineTension: 0,
                                fill: false,
                                borderWidth: 3,
                                data: amount_income,
                                backgroundColor: "rgba(133, 219, 107,.6)",
                                borderColor: "rgba(133, 219, 107,0.5)"
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
                    alert("error");
                }
            });

        },
        error: function(data) {
            alert("TF bro");
        }
    });
});