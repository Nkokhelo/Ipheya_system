var rentaOrderTable = $('#rentaOrderTable').DataTable({
    'ajax': '/ipheya/core/sub/php_action/fetchRentalOrder.php',
    'order': []
});