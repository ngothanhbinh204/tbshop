$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $(document).on('click', '.btn-update-quantity-order', function(e) {
        let url = $(this).data('action');
        let id = $(this).data('id');
        let newQuantity = $(`#quantity_order-${id}`).val();
        let data = {
            product_quantity: newQuantity
        };
        // console.log(newQuantity);
        updateProductQuantityOrder(url, data, id);

    })
})
// $(document).on('click', '.btn-update-quantity', _.debounce(function(e) {
//     let url = $(this).data('action');
//     let id = $(this).data('id');
//     let newQuantity = $(`#productQuantityInput-${id}`).val();
//     let data = {
//         product_quantity: newQuantity
//     };
//     totals.priceCoupon = 0;
//     updateProductQuantity(url, data, id);
// }, TIME_TO_UPDATE));

function updateProductQuantityOrder(url, data, id) {
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function(res) {
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
