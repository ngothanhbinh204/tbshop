@extends('frontend.client.layout')

@section('title', 'Trang Shop')

@section('content')
<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">

           @include('frontend.client.components.filterProductShop')

           @include('frontend.client.components.gridProductShop')

        </div>
    </div>
</section>

@endsection
<!-- Shop Section End -->
