@include('backend.dashboard.components.heading', [
    'title' => config('apps.product.index.title'),
    'table' => config('apps.product.index.table'),
])

<div class="wrapper wrapper-content animated fadeInRight ecommerce">


   
    @include('backend.product.components.filter')
    @include('backend.product.components.table', ['table' => config('apps.product.index.table')])


</div>
