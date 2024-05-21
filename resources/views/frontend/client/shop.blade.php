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

@section('scripts')
    <script>
        var colorDisplayNone = document.getElementById('colorDisplay');
        colorDisplayNone.style.display = 'none';

        function updateColor() {
            var colorSelect = document.getElementById('colorSelect');
            var colorDisplay = document.getElementById('colorDisplay');
            var selectedColor = colorSelect.value;
            if (selectedColor) {
                colorDisplay.style.color = selectedColor;
                colorDisplay.style.display = 'block';
            } else {
                colorDisplay.style.display = 'none';
            }
        }

        function updatePriceRange() {
            var priceSelect = document.getElementById('priceSelect');
            var priceMinInput = document.getElementById('price_min');
            var priceMaxInput = document.getElementById('price_max');

            var selectedValue = priceSelect.value;
            var [priceMin, priceMax] = selectedValue.split('-');
            priceMinInput.value = priceMin;
            priceMaxInput.value = priceMax;

        }
    </script>
@endsection
