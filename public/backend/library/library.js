(function ($) {
    "use strict";
    var TB = {};

    TB.switchery = () => {
        $('.js-switch').each(function () {
            var switchery = new Switchery(this, { color: '#1AB394' });
        })
    }


    TB.select2 = () => {
        $('.setupSelect2').select2();
    }

    $(document).ready(function () {
        TB.switchery();
    });
    $(document).ready(function () {
        TB.select2();
    });



})(jQuery);
