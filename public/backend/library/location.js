(function ($) {

    "use strict";
    var TB = {};

    TB.getLocation = () => {
        $(document).on('change', '.location', function () {
            let option = {
                'data': {
                    'location_id': $(this).val()
                },
                'target': $(this).attr('data-target')
            }

            console.log(option);

            TB.sendDataToGetLocation(option)
        })
    }

    TB.sendDataToGetLocation = (option) => {
        $.ajax({

            url: 'ajax/location/getLocation',
            method: "GET",
            data: option,
            dataType: 'json',
            success: function (response) {
                $('.' + option.target).html(response.html)
            },
            error: function (xhr, status, error) {
                console.error("Lỗi khi gửi yêu cầu:", error);
            }
        });
    }


    $(document).ready(function () {
        TB.getLocation();
    });

})(jQuery);
