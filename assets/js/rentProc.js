var clientRent = new Object();
var rentlist = new Array();

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


};