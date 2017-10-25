function loadevent(id) {
    $('#event-data').load('/ipheya/core/sub/finatialR.php?uevent_data=' + id);
}


var clientRent = new Object();
var rentlist = new Array();

$(document).ready(function() {
    $('#pdate').datepicker({
        minDate: 3,
        dateFormat: 'yy-mm-dd',
        onSelect: function(date) {
            var date2 = $('#pdate').datepicker('getDate');
            date2.setDate(date2.getDate() + 7);
            $('#rdate').datepicker('setDate', date2);
            $('#rdate').datepicker('option', 'minDate', date2);
            var r_id = $('#rentalID').val();
            totalCharge(r_id, 7);

        }
    });
    var diffDays = 0;

    $('#rdate').datepicker({
        minDate: +10,
        dateFormat: 'yy-mm-dd',
        onSelect: function(days) {
            var a = $("#pdate").datepicker('getDate').getTime();
            var b = $("#rdate").datepicker('getDate').getTime();
            var c = 24 * 60 * 60 * 1000;
            diffDays = Math.round(Math.abs((a - b) / (c)));
            var r_id = $('#rentalID').val();
            totalCharge(r_id, diffDays);

        }
    });
});

function rent(q) {
    var clientRent = null;
    var rental = new Object();
    for (var x = 0; x < rentlist.length; x++) {
        if (rentlist[x].rental_id == q) {
            clientRent = rentlist[x];
        }
    }

    if (clientRent != null) {
        $("#rentForm")[0].reset();

        var defaultRent = new Object();
        for (var x = 0; x < jsrentals.length; x++) {
            if (jsrentals[x].rental_id == clientRent.rental_id) {
                defaultRent = jsrentals[x];
            }
        }
        $("#pdate").val(clientRent.pickdate);
        $("#rdate").val(clientRent.returndate);
        $('#squantity').attr('max', defaultRent.quantity);
        $('#squantity').val(clientRent.quantity);
        $('#total_deposit').val(clientRent.totaldeposit);
        $('#total_deposit1').val(defaultRent.product_deposit);
        $('#total_amount').val(clientRent.totalamount);
        $('#total_charge').val(clientRent.totalcharge);
        $('#period').val(clientRent.period);
        $('#rentalID').val(clientRent.rental_id);
    } else {
        $("#rentForm")[0].reset();

        $('#squantity').val(1);
        var newRent = new Object();
        for (var x = 0; x < jsrentals.length; x++) {
            if (jsrentals[x].rental_id == q) {
                newRent = jsrentals[x];
            }
        }

        $('#squantity').attr('max', newRent.quantity);
        $('#total_deposit').val(newRent.product_deposit);
        $('#total_deposit1').val(newRent.product_deposit);
        $('#rentalID').val(newRent.rental_id);
    }
}

function closeModal() {
    $('#rentalModal').modal('hide');
    setTimeout(function() {
        $('#rentalModal').remove();
    }, 500);
}


function totalCharge(rental_id, days) {

    var quantity = parseInt($('#squantity').val());
    var timeline = "";

    console.log(rental_id);

    $.ajax({
        type: "post",
        url: "/ipheya/core/sub/php_action/fetchTimeline.php",
        data: { rentId: rental_id },
        success: function(data) {
            data = JSON.parse(data);
            var timeList = data.timelines;
            var charge;
            var daily = 0;
            // console.log(timeList[0].timeline)
            //calculate a charge
            for (var x = 0; x < timeList.length; x++) {
                if (timeList[x].timeline == "Daily") {
                    daily = timeList[x].rental_charge;
                }
            }

            var calc = false;
            for (var x = 0; x < timeList.length; x++) {
                if (days < 7) {
                    if (timeList[x].timeline == "Daily") {
                        var charge = (timeList[x].rental_charge * days);

                        console.log("Charge: v" + charge + ", time: daily, No of Days " + days);
                        $('#period').val(days + " day(s)");
                        $("#total_charge").val(charge);
                    }
                } else if ((days < 30) && (days => 7)) {
                    if (timeList[x].timeline == "Weekly") {
                        var weeks;
                        if (days % 7 == 0) {
                            weeks = days / 7;
                            var charge = (timeList[x].rental_charge * weeks);
                            console.log("Charge: w" + charge + ", time: Weekly, No of Days " + days + "Weeks " + weeks);
                            $('#period').val(weeks + " week(s)");
                            $("#total_charge").val(charge);
                        } else {
                            weeks = parseInt((days / 7), 10);
                            var day = days % 7;
                            var charge = ((timeList[x].rental_charge * weeks) + (day * daily));

                            console.log("Charge: x" + charge + ", time: Weekly, No of Days " + days + "Weeks " + weeks + " and " + day + " days");
                            $('#period').val(weeks + " week(s) and " + day + " day(s)");
                            $("#total_charge").val(charge);

                        }
                    }
                } else {
                    if (timeList[x].timeline == "Monthly") {
                        var charge = (timeList[x].rental_charge * days);
                        var months;
                        if (days % 30 == 0) {
                            months = days / 30;
                            var charge = (timeList[x].rental_charge * months);

                            console.log("Charge: y" + charge + ", time: monthly, No of Days " + days + "months " + months);
                            $('#period').val("month(s) " + months);
                            $("#total_charge").val(charge);
                        } else {
                            months = parseInt((days / 30), 10);
                            var day = days % 30;
                            var charge = ((timeList[x].rental_charge * months) + (day * daily));

                            console.log("Charge: z" + charge + ", time: monthly, No of Days " + days + " months " + months + " and " + day + "days");
                            $('#period').val(months + "month(s) and " + day + "day(s)");
                            $("#total_charge").val(charge);
                        }
                    }
                }

            }
            var quan = $("#squantity").val();
            var deposit = $("#total_deposit1").val();
            var totalCharge = $('#total_charge').val();

            var total = parseInt(deposit) + parseInt(charge)
            $('#total_amount').val(total);
            if (quan < getRentalObject(rental_id).quantity) {
                $('#rentButton').removeAttr('disabled');
            } else {
                $('#rentButton').attr('disabled', 'disabled');
            }

        }
    });
}

var totalC = 0;

function totalAmount(deposit, charge) {

    var total = parseInt(deposit) + parseInt(charge)
    $('#total_amount').val(total);
    $('#total_deposit').val(deposit);

}

function calc() {
    var quan = $("#squantity").val();
    var deposit = $("#total_deposit1").val();
    var totalCharge = $('#total_charge').val();

    totalAmount((quan * deposit), totalCharge);
}

$("#squantity").on("keyup change", function(event) {
    calc();
    var quan = parseInt($(this).val());
    var r_id = parseInt($('#rentalID').val());
    var rentquant = parseInt(getRentalObject(r_id).quantity);
    if ((quan <= rentquant && quan > 0 && isNaN(quan) == false) && ($('#pdate').val() != '') && ($('#rdate').val() != '')) {
        console.log("it is lower than");
        $('#rentButton').removeAttr('disabled');
    } else {
        $('#rentButton').attr('disabled', 'disabled');
    }
});

function saveChanges() {
    var pickDate = $("#pdate").val();
    var returnDate = $("#rdate").val();
    var quantity = $("#squantity").val();
    var totalCharge = $("#total_charge").val();
    var totalDeposit = $("#total_deposit").val();
    var totalAmount = $("#total_amount").val();
    var rentID = $('#rentalID').val();
    var period = $('#period').val();
    clientRent = { rental_id: rentID, pickdate: pickDate, returndate: returnDate, quantity: quantity, totalcharge: totalCharge, totaldeposit: totalDeposit, totalamount: totalAmount, period: period };
    var exist = false;
    for (var x = 0; x < rentlist.length; x++) {
        if (rentlist[x].rental_id == rentID) {
            rentlist[x] = clientRent;
            exist = true;
        }
    }
    if (exist == false) {
        rentlist.push(clientRent);
    }
    var i = rentlist.length;
    console.log(rentlist);
    console.log(i);
    $("#rentForm")[0].reset();
    // $('#rentalModal').hide();
}

function getRentalObject(id) {
    var findObject = new Object();
    for (var x = 0; x < jsrentals.length; x++) {
        if (jsrentals[x].rental_id == id) {
            findObject = jsrentals[x];
        }
    }
    return findObject;
}

// post our list to php session
function Checkout() {
    $.ajax({
        type: "post",
        url: "/ipheya/core/sub/php_action/clientRentals.php",
        data: { clientRentals: rentlist },
        success: function(data) {
            console.log(data);
            window.location.href = "/ipheya/login.php";
        }
    })


}