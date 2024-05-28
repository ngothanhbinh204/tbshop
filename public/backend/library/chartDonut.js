
$(document).ready(function() {
    Morris.Donut({
        element: 'morris-donut-chart',
        resize: true,
        data: [
            { label: "Khách hàng", value: userCount },
            { label: "Sản phẩm", value: productCount },
            { label: "Bài viết", value: postCount },
            { label: "Đơn hàng", value: orderCount }
        ],
        colors: ['#EE320A', '#54cdb4', '#F32F76', '#F58F0D'],
    });
});