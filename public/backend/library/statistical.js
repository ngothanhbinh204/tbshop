
$(document).ready(function() {
    // var _url_chartDefaul = "{{ route('dashboard_get60DaysOrder') }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    get60DaysOrder();

    
    $('#dateStart').datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        // dateFormat: "yy-mm-dd",
        format: 'yyyy-mm-dd',
        dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        duration: "slow"
    });
    $('#dateEnd').datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        format: 'yyyy-mm-dd',
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        duration: "slow"
    });

    var chart = new Morris.Bar({
        element: 'myfirstchart',
        //option chart :
        lineColors : ['#333333','#666666','#999999','#CCCCCC','#FFFFFF'],
        parseTime: false,
        hideHover: "auto",
        xkey: 'period',
        ykeys: ['order', 'sales', 'profit', 'quantity'],
        behaveLikeLine: true,
        labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
      });

      function get60DaysOrder() {
        var _url =  $('.actionUrlDefaul').data('action');
        $.ajax({
            url: _url,
            method: "POST",
            dataType: "JSON",
            data: {
            },
            success:function (data) {
                chart.setData(data)
            }

        })
      }

      // lọc by date
    $('#btn-dashboard-filter').on('click', function() {
        let _url = $(this).data('action');
        var dateStart = $('#dateStart').val();
        var dateEnd = $('#dateEnd').val();
        $.ajax({
            url: _url,
            method: "POST",
            dataType: "JSON",
            data: {
                dateStart: dateStart,
                dateEnd: dateEnd,
            },
            success:function (data) {
                chart.setData(data)
            }

        })
    });

    // lọc by select
    $('.dashboard-filter').on('change', function () {
        var dashboard_value = $(this).val();
        var _url_filter = $(this).data('action');
        // alert(dashboard_value);
        $.ajax({
            url: _url_filter,
            method: "POST",
            dataType: "JSON",
            data: {
                dashboard_value: dashboard_value
            },
            success:function (data) {
                chart.setData(data)
            }
        })
    });



});