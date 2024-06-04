// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
$(document).ready(function () {
        // alert("âcsd");

    load_gallery();

    // Hàm load table gallery
   function load_gallery(){
   var pro_id =  $('.pro_id').val();
   var _token = $('input[name="_token"]').val();
    // alert(pro_id);
    $.ajax({
        url: '/gallery/select-gallery',
        method: "POST",
        data: {
            _token : _token,
            pro_id : pro_id,
        },
        success:function (data) {
            $('#gallery_load').html(data);
        },
        error: function (xhr, status, error) {
            console.log("lỗi", xhr);
            console.log("lỗi", status);
            console.log("lỗi", error);

            // swal("Lỗi!", "Đã xảy ra lỗi khi xoá sản phẩm.", "error");
        }
    });
   }

   // tạo ảnh cho product
   $('#file').change(function () {
    var error = '';

    var files = $('#file')[0].files;
    if(files.length > 5) {
        error = '<p>Tối đa chỉ được 5 ảnh</p>';
    } else if (files.length == ''){
        error = '<p>Bạn không đươc bỏ trống ảnh</p>';

    } else if (files.size > 2000000){
        error = '<p>File ảnh không được lớn hơn 2MB</p>';
    }
    if(error == ''){
        console.log("Không có lỗi");
    }else {
        $('#file').val('');
        $('#error_gallery').html('<span class="text-danger"> '+ error +' </span>');
        return false;
    }
    console.log(error);

   })

   // Đổi tên ảnh
   $(document).on('blur', '.edit_gal_name', function () {
        var gal_id = $(this).data('gal_id');
        var gal_text = $(this).text();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '/gallery/update-gallery-name',
            method: "POST",
            data: {
                _token : _token,
                gal_id : gal_id,
                gal_text : gal_text,
            },
            success:function (data) {
                load_gallery();
                $('#error_gallery').html('<span class="text-info"> Cập nhật tên ảnh thành công </span>');
            }
        });
   });

    // Xoá ảnh
    $(document).on('click', '.delete-gallery', function () {
         var gal_id = $(this).data('gal_id');
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Bạn có muốn xoá ảnh này không?",
            text: "Ảnh sau khi xoá sẽ không thể khôi phục!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Xoá!",
            closeOnConfirm: false
        }, function (isConfirmed) {
            if (isConfirmed) {
            $.ajax({
                url: '/gallery/delete-gallery',
                    method: "POST",
                    data: {
                        _token : _token,
                        gal_id : gal_id,
                    },
                success: function (response) {
                    load_gallery();
                    $('#error_gallery').html('<span class="text-info"> Cập nhật tên ảnh thành công </span>');
                    swal("Xoá thành công!", "Sản phẩm đã xoá thành công.", "success");
                },
                error: function (xhr, status, error) {
                    swal("Lỗi!", "Đã xảy ra lỗi khi xoá sản phẩm.", "error");
                }
            });
           }
        });
    });

    // update ảnh
    $(document).on('change', '.file_image', function () {
        var gal_id = $(this).data('gal_id');
        var image = document.getElementById('file-' + gal_id).files[0];

        var form_data = new FormData(); // tạo 1 form data mới bằng ajax
        form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
        form_data.append("gal_id", gal_id);
           $.ajax({
               url: '/gallery/update-gallery-image',
                   method: "POST",
                   headers: {
                    'X-CSRF-TOKEN' : $('.meta[name="csrf-token"]').attr('content')
                   },
                   data: form_data,
                   contentType: false,
                   cache: false,
                   processData: false,
                    success: function (response) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-info"> Cập nhật ảnh sản phẩm thành công </span>');
                        swal("Cập nhật ảnh thành công!", "Ảnh đã cập nhật thành công.", "success");
               },
               error: function (xhr, status, error) {
                   swal("Lỗi!", "Đã xảy ra lỗi khi thay đổi sản phẩm.", "error");
               }
           });
    });

});