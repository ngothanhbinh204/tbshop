$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function () {
    $(document).on('click', '.update-status-btn', function () {
        var $popover = $(this).closest('.popover');
        var statusContainer = $(this).closest('.order-status');
        statusContainer.find('.status-text').hide();
        statusContainer.find('.update-status-btn').hide();
        statusContainer.find('.popover').hide();
        statusContainer.find('.select-status').show();
    });

    $(document).on('change', '.select-status', function (e) {
        e.preventDefault();
        let url = $(this).data('action');
        let data = {
            status: $(this).val()
        };
        $.post(url, data, res => {
            swal({
                title: "Thay đổi trạng thái thành công!",
                type: "success",
                timer: 1000
            });

            // Cập nhật trạng thái hiển thị
            var newStatusText = $(this).find('option:selected').text();
            var statusContainer = $(this).closest('.order-status');
            statusContainer.find('.status-text').text(newStatusText).show();
            statusContainer.find('.update-status-btn').show();
            $(this).hide();
        })
    })
})
