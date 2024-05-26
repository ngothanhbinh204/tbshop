$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).on('click', '.btn-remove-order', function(e) {
    e.preventDefault();
    let id = $(this).data("id");
    Swal.fire({
            title: 'Thông báo',
            text: ' Bạn có chắc chắn xoá đơn hàng này không?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tiếp tục xoá',
            cancelButtonText: 'Trở về'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#form-remove-${id}`).submit();
            }
        })
        .catch();
})

