var timelineRental = $('#timelineRental');
var button = $('button[id^="remove"]');

function lease(id) {
    $.ajax({
        url: '/ipheya/core/sub/php_action/rentalfetch.php',
        type: 'post',
        data: { inventory_id: id },
        dataType: 'json',
        success: function(response) {
                $('#productName').val(response.product_name);
                $('#quantity').attr('type', 'number');
                $('#quantity').attr('max', response.quantity);
                $('#inventoryId').val(response.inventry_id);
            } //success
    });
}

function addRentalI() {
    var numDivs = $('#timelineRental').children('div.form-group').length;
    var alltimelines = '';
    var id = numDivs + 1;
    $.ajax({
        url: '/ipheya/core/sub/php_action/timelines.php?timelines=1',
        success: function(response) {
                response = JSON.parse(response);
                timelineRental.append('<div class="form-group" id="duration' + id + '"><div class="col-xs-4"><div class="col-xs-12"><select type="text" class="form-control" id="timeline' + id + '" name="timeline[]"><option>--Select--</option>' + response + '</select></div></div><div class="col-xs-4"><div class="col-xs-12"><input type="text" class="form-control" id="charge' + id + '" name="charge[]"></div></div><div class="col-xs-4"><div class="col-xs-8"><input type="text" class="form-control" id="penalty' + id + '" name="penalty[]"></div> <div class="col-xs-1"><button id="remove' + id + '" type="button" onclick="removeI(' + id + ')" class="btn btn-default"><i class="fa fa-trash-o"></i></button></div></div></div>');
            } //success
    });

    button.removeAttr('disabled');

}



function removeI(id) {

    var duration = $('#duration' + id);
    duration.remove();
    var numDivs = $('#timelineRental').children('div.form-group').length;
    if (numDivs == 1) {
        $('button[id^="remove"]').attr('disabled', 'disabled');
    }
}


var inventoriesTable;
inventoriesTable = $("#inventoriesTable").DataTable({
    'ajax': '/ipheya/core/sub/php_action/fetchInventory.php',
    'order': []

});

// add product modal btn clicked
function addTorental() {
    // update the product data function
    $("#rentalForm").unbind('submit').bind('submit', function() {
        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();

        // form validation
        var inventoryId = $("#inventoryId").val();
        var quantity = $("#quantity").val();
        var depostiAmount = $("#depostiAmount").val();


        if (inventoryId == "") {
            $("#productName").after('<p class="text-danger">Please select product</p>');
            $('#productName').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#productName").find('.text-danger').remove();
            // success out for form
            $("#productName").closest('.form-group').addClass('has-success');
        } // /else
        if (quantity == "") {
            $("#quantity").after('<p class="text-danger">Quantity field is required</p>');
            $('#quantity').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#quantity").find('.text-danger').remove();
            // success out for form
            $("#quantity").closest('.form-group').addClass('has-success');
        } // /else

        if (depostiAmount == "") {
            $("#depostiAmount").after('<p class="text-danger">Deposit field is required</p>');
            $('#depostiAmount').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#depostiAmount").find('.text-danger').remove();
            // success out for form
            $("#depostiAmount").closest('.form-group').addClass('has-success');
        } // /else

        // time line validation
        var timelines = document.getElementsByName('timeline[]');
        var validateTimeline = false;
        for (var x = 0; x < timelines.length; x++) {
            var timelinesId = timelines[x].id;
            if (timelines[x].value == '') {
                $("#" + timelinesId + "").after('<p class="text-danger">Please select a timeline </p>');
                $("#" + timelinesId + "").closest('.form-group').addClass('has-error');
            } else {
                $("#" + timelinesId + "").closest('.form-group').addClass('has-success');
            }
        } // for
        for (var x = 0; x < timelines.length; x++) {
            if (timelines[x].value) {
                validateTimeline = true;
            } else {
                validateTimeline = false;
            }
        } // for

        //charge validation
        var charges = document.getElementsByName('charge[]');
        var validateCharge = false;
        for (var x = 0; x < charges.length; x++) {
            var chargesId = charges[x].id;
            if (charges[x].value == '') {
                $("#" + chargesId + "").after('<p class="text-danger">Please select a timeline </p>');
                $("#" + chargesId + "").closest('.form-group').addClass('has-error');
            } else {
                $("#" + chargesId + "").closest('.form-group').addClass('has-success');
            }
        } // for
        for (var x = 0; x < charges.length; x++) {
            if (charges[x].value) {
                validateCharge = true;
            } else {
                validateCharge = false;
            }
        } // for

        //penalty validation
        var penalties = document.getElementsByName('penalty[]');
        var validatePenaltie = false;
        for (var x = 0; x < penalties.length; x++) {
            var penaltyId = penalties[x].id;
            if (penalties[x].value == '') {
                $("#" + penaltyId + "").after('<p class="text-danger">Penalty is required </p>');
                $("#" + penaltyId + "").closest('.form-group').addClass('has-error');
            } else {
                $("#" + penaltyId + "").closest('.form-group').addClass('has-success');
            }
        } // for
        for (var x = 0; x < penalties.length; x++) {
            if (penalties[x].value) {
                validatePenaltie = true;
            } else {
                validatePenaltie = false;
            }
        } // for


        if (inventoryId != null && quantity != null && depostiAmount != null) {
            alert(inventoryId);
            // check if the product name is not empty
            if (validateTimeline == true && validatePenaltie == true && validateCharge == true) {
                // check if all arrays are valdated good
                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                            console.log(response);
                            if (response.success == true) {
                                $("html, body, div.modal, div.modal-content, div.modal-body").animate({ scrollTop: '0' }, 100);

                                // shows a successful message after operation
                                $('#edit-product-messages').html('<div class="alert alert-success">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                    '</div>');

                                // remove the mesages
                                $(".alert-success").delay(500).show(10, function() {
                                    $(this).delay(3000).hide(10, function() {
                                        $(this).remove();
                                    });
                                }); // /.alert

                                // reload the manage student table
                                manageProductTable.ajax.reload(null, true);

                                // remove text-error
                                $(".text-danger").remove();
                                // remove from-group error
                                $(".form-group").removeClass('has-error').removeClass('has-success');

                            } // /if response.success

                        } // /success function
                }); // /ajax function

                return false;

            }

        }
        return false;
    });
    return false;

}