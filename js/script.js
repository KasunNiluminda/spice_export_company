$(document).ready(function() {
    loadProducts();

    function loadProducts() {
        $.ajax({
            url: 'fetch_products.php',
            method: 'GET',
            success: function(response) {
                $('#product-list').html(response);
            }
        });
    }
});
