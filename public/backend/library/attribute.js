
$('#inputAttribute').change(function (event) {
    var _ipAtrribute = $('#inputAttribute').val();
    if (_ipAtrribute == 'size') {
        $('.sizeClassname').show();
        $('#v2').attr({
            name: 'value',
        });
        $('.colorClassname').hide();
        $('#v1').attr({
            name: '',
        })
    } else {
        $('.sizeClassname').hide();
        $('#v1').attr({
            name: 'value',
        });
        $('.colorClassname').show();
        $('#v2').attr({
            name: '',
        })
    }
});


// $(document).ready(function () {
//     $('#priceInput').on('input', function () {
//         // Lấy giá trị nhập vào
//         let value = $(this).val();
//         // Loại bỏ tất cả các dấu chấm hiện có
//         value = value.replace(/\./g, '');
//         // Thêm dấu chấm phân cách hàng nghìn
//         value = addThousandSeparator(value);
//         // Cập nhật giá trị của trường input
//         $(this).val(value);
//     });
// });

// function addThousandSeparator(value) {
//     // Chuyển đổi giá trị thành chuỗi
//     let stringValue = value.toString();
//     // Tạo mảng từ chuỗi
//     let valueArray = stringValue.split('');
//     // Lặp qua từng ký tự của mảng và thêm dấu chấm phân cách hàng nghìn
//     for (let i = valueArray.length - 3; i > 0; i -= 3) {
//         valueArray.splice(i, 0, '.');
//     }
//     // Kết hợp các phần tử của mảng để tạo ra chuỗi mới
//     return valueArray.join('');
// }



