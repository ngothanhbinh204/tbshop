$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function () {
    const labelArray = {
        'Đang xử lí': 'warning',
        'Chấp nhận đơn hàng': 'primary',
        'Đang vận chuyển': 'info',
        'Giao thành công': 'success',
        'Huỷ': 'danger'
    };
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
        let newStatus = $(this).val();
        let newLabelClass = labelArray[newStatus];
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

            var newStatusText = $(this).find('option:selected').text();
            var statusContainer = $(this).closest('.order-status');
            // statusContainer.find('.status-text').text(newStatusText).show();
            statusContainer.find('.update-status-btn').show();
            let statusTextElement = statusContainer.find('.status-text');
            statusTextElement.text(newStatusText).show(); // Đổi status
            statusTextElement.text(newStatusText).attr('class', `status-text label label-${newLabelClass}`).show(); // đổi mài label

            $(this).hide();
        })
        
    })


})
