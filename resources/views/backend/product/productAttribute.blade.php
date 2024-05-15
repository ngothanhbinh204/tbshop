@include('backend.dashboard.components.heading', [
    'title' => config('apps.product.index.title'),
    'table' => config('apps.product.index.table'),
])

<div class="wrapper wrapper-content animated fadeInRight ecommerce">



    @include('backend.product.components.filterAttribute')
    @include('backend.product.components.tableAttribute', ['table' => config('apps.product.index.table')])


</div>
