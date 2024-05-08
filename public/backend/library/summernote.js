
$(document).ready(function () {

    $('#summernote').summernote();

});



$(document).ready(function () {

    $('.summernoteProduct').summernote();

    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

});
