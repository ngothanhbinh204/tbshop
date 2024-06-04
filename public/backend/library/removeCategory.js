$(document).on('click', '.btn-remove-category', function(e) {
    e.preventDefault();
    let id = $(this).data("id");
    Swal.fire({
            title: 'Thông báo',
            text: ' Bạn có chắc chắn xoá danh mục này không?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tiếp tục xoá',
            cancelButtonText: 'Trở về'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#form-remove-category-${id}`).submit();
            }
        })
        .catch();
})
