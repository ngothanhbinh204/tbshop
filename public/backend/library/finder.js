(function ($) {
    "use strict";
    var TB = {};
    TB.inputImage = () => {
        $(document).on('click', '.input-image', function () {
            let fileUpload = $(this).attr('data-upload')
            TB.BrowseServerInput($(this), fileUpload);
        })
    }


    TB.BrowseServerInput = (object, type) => {

        if (typeof (type) == 'undefined') {
            type = 'Images';
        }

        var finder = new CKFinder();

        finder.resourceType = type;

        finder.selectActionFunction = function (fileUrl, data) {
            console.log(fileUrl);
            fileUrl = fileUrl.replace(BASE_URL, "/");

            object.val(fileUrl);
        };

        finder.popup();

    }

    $(document).ready(function () {
        TB.inputImage();
    });

})(jQuery);
