

$(document).ready(function () {
    var _token = $('meta[name="csrf-token"]').attr('content');

    $('.demo1').click(function(){
        swal({
            title: "Welcome in Alerts",
            text: "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
        });
    });

    $('.done').click(function(){
        swal({
            title: "Good job!",
            text: "You clicked the button!",
            type: "success"
        });
    });

    $('.deleteItem').click(function () {
        var productId = $(this).data('product-id');
        var _url = $(this).data('action');
        swal({
            title: "Bạn chắc chắn xoá không?",
            text: "Sản phẩm sau khi xoá sẽ không thể khôi phục!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Đúng, xoá nó !",
            closeOnConfirm: false
        }, function (isConfirmed) {
            if (isConfirmed) {
                // Gửi yêu cầu xóa sản phẩm bằng phương thức POST
                $.ajax({
                    url: _url , 
                    type: 'POST',
                    data: {
                        id: productId,
                        _method: 'DELETE', // Sử dụng phương thức DELETE thông qua _method
                        _token: _token 
                    },
                    success: function (response) {
                        swal("Xoá thành công!", "Sản phẩm đã xoá thành công.", "success");
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        swal("Lỗi!", "Đã xảy ra lỗi khi xoá sản phẩm.", "error");
                    }
                });
                
            }
        });
    });
    

    $('.demo4').click(function () {
        swal({
                    title: "Are you sure?",
                    text: "Your will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false },
                function (isConfirm) {
                    if (isConfirm) {
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
    });


});
