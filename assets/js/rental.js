var rentals = $('#rentals').DataTable({
    'ajax': '/ipheya/core/sub/php_action/fetchRental.php',
    'order': []
});