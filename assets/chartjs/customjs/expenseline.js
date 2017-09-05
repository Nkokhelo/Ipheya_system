$(document).ready(function() {
    var amount_income = [];
    var amount_expense = [];
    var date = [];
    var project = [];
    var proj_income = [];
    var proj_expense = [];
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

    // var pie = document.getElementById("pieView").getContext('2d');
    var bar = $('#barView');

    var myChart = new Chart(bar, {
        type: 'bar',
        data: {
            labels: ["M", "T", "W", "T", "F", "S", "S"],
            datasets: [{
                label: 'servic',
                data: [12, 19, 3, 17, 28, 24, 7],
                backgroundColor: "rgba(153,255,51,1)"
            }, {
                label: 'service2',
                data: [59, 6, 5, 5, 20, 63, 56],
                backgroundColor: "rgba(0,153,0,1)"
            }, {
                label: 'service3',
                data: [6, 29, 5, 59, 56, 3, 10],
                backgroundColor: "rgba(255,53,0,1)"
            }, {
                label: 'service4',
                data: [30, 56, 5, 56, 59, 3, 10],
                backgroundColor: "rgba(62,33,255,1)"
            }]
        }
    });

    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/finatialR.php",
        data: "projects=i",
        success: function(data) {
            var project = [];
            for (var i in data) {
                project.push(data[i].projectname);
                proj_income.push(data[i].amount);
            }
            var ctx1 = $('#incomespie');
            var myChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: project,
                    datasets: [{
                        label: "Projects per income",
                        backgroundColor: [
                            "#2ecc71",
                            "#3498db",
                            "#95a5a6",
                            "#9b59b6",
                            "#f1c40f",
                            "#e74c3c",
                            "#34495e"
                        ],
                        data: proj_income
                    }]
                }
            });
        },
        error: function(data) {
            alert("Error while drawing graphs" + data);
        }
    });


    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/finatialR.php",
        data: "projects=e",
        success: function(data) {
            var project = [];
            for (var i in data) {
                project.push(data[i].projectname);
                proj_expense.push(data[i].amount);
            }
            var ctx1 = $('#expensespie');
            var myChart = new Chart(ctx1, {
                type: 'bar', //doughnut
                data: {
                    labels: project,
                    datasets: [{
                        label: 'project per expenses',
                        backgroundColor: [
                            "#2ecc71",
                            "#3498db",
                            "#9b59b6",
                            "#95a5a6",
                            "#f1c40f",
                            "#e74c3c",
                            "#34495e"
                        ],
                        data: proj_expense
                    }]
                }
            });
        },
        error: function(data) {
            alert("Error while drawing graphs" + data);
        }
    });

    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/finatialR.php",
        data: "services=any",
        success: function(data) {
            var service = [];
            var request = [];
            for (var i in data) {
                projects.push(data[i].projectname);
                budget.push(data[i].budget);
            }
            var ctx1 = $('#budgetpie');
            var myChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: projects,
                    datasets: [{
                        label: 'Project budgets in 2017',
                        backgroundColor: [
                            "#fcbc05",
                            "#3498db",
                            "#9b59b6",
                            "#00ffff",
                            "#fc809b",
                            "#2ecc71",
                            "#cfcb89",
                            "#f1c40f",
                            "#f12acb"
                        ],
                        data: budget
                    }]
                }
            });
        },
        error: function(data) {
            alert("Error while drawing graphs" + data);
        }
    });
    $.ajax({
        type: "get",
        url: "/ipheya/core/sub/finatialR.php",
        data: "budget=any",
        success: function(data) {
            var projects = [];
            var budget = [];
            for (var i in data) {
                projects.push(data[i].projectname);
                budget.push(data[i].budget);
            }
            var ctx1 = $('#budgetpie');
            var myChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: projects,
                    datasets: [{
                        label: 'Project budgets in 2017',
                        backgroundColor: [
                            "#fcbc05",
                            "#3498db",
                            "#9b59b6",
                            "#00ffff",
                            "#fc809b",
                            "#2ecc71",
                            "#cfcb89",
                            "#f1c40f",
                            "#f12acb"
                        ],
                        data: budget
                    }]
                }
            });
        },
        error: function(data) {
            alert("Error while drawing graphs" + data);
        }
    });
});