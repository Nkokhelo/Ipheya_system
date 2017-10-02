var timelineRental = $('#timelineRental');

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
    var id = numDivs + 1;
    timelineRental.append('<div class="form-group" id="duration' + id + '"><div class="col-xs-4"><div class="col-xs-12"><select type="text" class="form-control" id="duration" name="duration[]"><option>--Select--</option><?= $alltimelines ?></select></div></div><div class="col-xs-4"><div class="col-xs-12"><input type="text" class="form-control" id="charge" name="charge[]"></div></div><div class="col-xs-4"><div class="col-xs-8"><input type="text" class="form-control" id="penalty" name="penalty[]"></div> <div class="col-xs-1"><button type="button" onclick="removeI(' + id + ')" class="btn btn-default"><i class="fa fa-trash-o"></i></button></div></div></div>');
    var button = $('#timelineRental>div>div>div>button.btn.btn-default').attr('disabled', 'false');
}

function removeI(id) {
    var numDivs = $('#timelineRental').children('div.form-group').length;
    if (numDivs > 1) {
        var button = $('.form-control>.col-xs-1>button').attr('disabled', 'false');
    }
    var duration = $('#duration' + id);
    duration.remove();
}


var inventoriesTable;
inventoriesTable = $("#inventoriesTable").DataTable({
    'ajax': '/ipheya/core/sub/php_action/fetchInventory.php',
    'order': []

});

function saveRental() {

}