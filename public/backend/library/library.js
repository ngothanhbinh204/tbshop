(function ($) {
    "use strict";
    var TB = {};

    var _token = $('meta[name="csrf-token"').attr('content');

    TB.switchery = () => {
        $('.js-switch').each(function () {
            var switchery = new Switchery(this, { color: '#1AB394' });
        })
    }


    TB.select2 = () => {
        if ($('.setupSelect2').length) {
            $('.setupSelect2').select2();

        }
    }

    TB.changeStatus = () => {
        $(document).on('change', '.status', function (e) {
            let option = {
                'value': $(this).val(),
                'modelId': $(this).attr('data-modelId'),
                'model': $(this).attr('data-model'),
                'field': $(this).attr('data-field'),
                '_token': _token
            }
            $.ajax({

                url: 'ajax/dashboard/changeStatus',
                method: "POST",
                data: option,
                dataType: 'json',
                success: function (response) {
                   console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi khi gửi yêu cầu:", error);
                }
            });
            e.preventDefault();
        })

    }

    $(document).ready(function () {
        TB.switchery();
        TB.select2();
        TB.changeStatus();
    });




})(jQuery);
